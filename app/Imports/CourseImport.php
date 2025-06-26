<?php

namespace App\Imports;

use App\Models\Online_course;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\DB;

class CourseImport implements
    ToModel,
    WithHeadingRow,
    WithStartRow,
    SkipsOnFailure,
    SkipsOnError,
    WithBatchInserts,
    WithChunkReading
{
    use Importable, SkipsFailures, SkipsErrors;

    private int $successCount = 0;
    private int $processedRows = 0;
    private array $debugInfo = [];
    private array $allHeaders = [];
    private bool $headerLogged = false;

    public function __construct()
    {
        // Debug: Cek koneksi database dan tabel
        try {
            $model = new Online_course();
            Log::info("=== IMPORT INITIALIZATION ===");
            Log::info("Table name from Model: " . $model->getTable());
            Log::info("Database connection: " . DB::connection()->getName());
            
            // Test query ke tabel
            $testCount = Online_course::count();
            Log::info("Test query berhasil. Total records: " . $testCount);
            
        } catch (\Exception $e) {
            Log::error("Database/Table issue: " . $e->getMessage());
        }
    }

    /**
     * Mulai dari baris ke-4 (setelah heading di baris 3)
     */
    public function startRow(): int
    {
        return 4;
    }

    /**
     * Baris heading (baris 3)
     */
    public function headingRow(): int
    {
        return 3;
    }

    public function model(array $row)
    {
        $this->processedRows++;

        // Log headers sekali saja
        if (!$this->headerLogged) {
            $this->allHeaders = array_keys($row);
            Log::info("=== EXCEL HEADERS DETECTED ===", [
                'headers' => $this->allHeaders,
                'total_columns' => count($this->allHeaders)
            ]);
            $this->headerLogged = true;
        }

        // Log setiap row untuk debug
        Log::info("=== PROCESSING ROW {$this->processedRows} ===", [
            'raw_row' => $row,
            'row_count' => count($row),
            'non_empty_values' => array_filter($row, function($value) {
                return !empty($value) && $value !== null;
            })
        ]);

        // Cek apakah row kosong
        $nonEmptyValues = array_filter($row, function($value) {
            return !empty($value) && $value !== null && trim($value) !== '';
        });

        if (empty($nonEmptyValues)) {
            Log::info("Row {$this->processedRows} is empty, skipping...");
            return null;
        }

        // Mapping kolom dengan berbagai kemungkinan nama
        $judul = $this->getColumnValue($row, ['judul', 'title', 'course_title', 'nama_course']);
        $link = $this->getColumnValue($row, ['link_course', 'link', 'url', 'course_link']);
        $deskripsi = $this->getColumnValue($row, ['deskripsi', 'description', 'desc']);
        $kategori = $this->getColumnValue($row, ['kategori', 'category', 'cat']);
        $harga = $this->getColumnValue($row, ['harga', 'price', 'cost']);
        $rating = $this->getColumnValue($row, ['rating', 'rate', 'score']);
        $viewers = $this->getColumnValue($row, ['jumlah_viewers', 'viewers', 'students', 'enrolled']);
        $bahasa = $this->getColumnValue($row, ['bahasa', 'language', 'lang']);
        $tipe = $this->getColumnValue($row, ['tipe_course', 'tipe', 'type', 'course_type']);
        $durasi = $this->getColumnValue($row, ['durasi', 'duration', 'length']);
        $level = $this->getColumnValue($row, ['tingkat_kesulitan', 'level', 'difficulty']);
        $platform = $this->getColumnValue($row, ['platform', 'provider', 'source']);

        Log::info("Mapped values:", [
            'judul' => $judul,
            'link' => $link,
            'deskripsi' => $deskripsi,
            'kategori' => $kategori,
            'harga' => $harga,
            'rating' => $rating,
            'viewers' => $viewers,
            'bahasa' => $bahasa,
            'tipe' => $tipe,
            'durasi' => $durasi,
            'level' => $level,
            'platform' => $platform
        ]);

        // Validasi data required
        if (empty($judul)) {
            $this->debugInfo[] = "❌ Row {$this->processedRows} - Judul kosong";
            Log::warning("Row {$this->processedRows} skipped: Judul kosong");
            return null;
        }

        if (empty($link)) {
            $this->debugInfo[] = "❌ Row {$this->processedRows} - Link kosong";
            Log::warning("Row {$this->processedRows} skipped: Link kosong");
            return null;
        }

        try {
            // Data yang akan disimpan
            $courseData = [
                'judul' => trim($judul),
                'deskripsi' => trim($deskripsi ?? ''),
                'kategori' => trim($kategori ?? ''),
                'harga' => trim($harga ?? ''),
                'rating' => $this->parseFloat($rating),
                'jumlah_viewers' => $this->parseInt($viewers),
                'bahasa' => trim($bahasa ?? 'Indonesia'),
                'tipe' => trim($tipe ?? ''),
                'durasi' => trim($durasi ?? ''),
                'level' => trim($level ?? 'Pemula'),
                'platform' => trim($platform ?? ''),
                'link' => trim($link),
            ];

            Log::info("Creating course with data:", $courseData);

            // Buat course baru
            $course = Online_course::create($courseData);
            
            if ($course) {
                $this->successCount++;
                $this->debugInfo[] = "✅ Row {$this->processedRows} - Course created: {$judul}";
                Log::info("✅ Course created successfully with ID: " . $course->id);
                return $course;
            } else {
                $this->debugInfo[] = "❌ Row {$this->processedRows} - Failed to create course";
                Log::error("❌ Failed to create course - create() returned null");
                return null;
            }

        } catch (\Exception $e) {
            $this->debugInfo[] = "❌ Row {$this->processedRows} - Exception: " . $e->getMessage();
            Log::error("❌ Exception creating course row {$this->processedRows}: " . $e->getMessage(), [
                'data' => $courseData ?? [],
                'exception_line' => $e->getLine(),
                'exception_file' => $e->getFile()
            ]);
            return null;
        }
    }

    /**
     * Helper function untuk mencari nilai kolom dengan berbagai nama
     */
    private function getColumnValue(array $row, array $possibleKeys): ?string
    {
        foreach ($possibleKeys as $key) {
            // Cek exact match
            if (isset($row[$key]) && !empty($row[$key])) {
                return $row[$key];
            }
            
            // Cek case insensitive
            foreach ($row as $rowKey => $value) {
                if (strtolower($rowKey) === strtolower($key) && !empty($value)) {
                    return $value;
                }
            }
        }
        return null;
    }

    public function batchSize(): int
    {
        return 5; // Kurangi untuk debug
    }

    public function chunkSize(): int
    {
        return 5; // Kurangi untuk debug
    }

    private function parseFloat($value): ?float
    {
        if (is_null($value) || $value === '' || trim($value) === '') return null;
        $value = str_replace(',', '.', trim($value));
        return is_numeric($value) ? (float) $value : null;
    }

    private function parseInt($value): ?int
    {
        if (is_null($value) || $value === '' || trim($value) === '') return null;
        $value = preg_replace('/[^0-9]/', '', trim($value));
        return is_numeric($value) ? (int) $value : null;
    }

    public function getSuccessCount(): int
    {
        return $this->successCount;
    }

    public function getProcessedRows(): int
    {
        return $this->processedRows;
    }

    public function getErrorCount(): int
    {
        return count($this->failures());
    }

    public function getDebugInfo(): array
    {
        return $this->debugInfo;
    }

    public function getAllHeaders(): array
    {
        return $this->allHeaders;
    }
}