<?php

namespace App\Imports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Illuminate\Support\Facades\Log;

class CourseImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError, SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;

    private $successCount = 0;
    private $errorCount = 0;
    private $errors = [];

    public function model(array $row)
    {
        try {
            // Skip empty rows
            if (empty($row['judul']) && empty($row['link_course'])) {
                return null;
            }

            $course = new Course([
                'judul' => $row['judul'] ?? '',
                'deskripsi' => $row['deskripsi'] ?? '',
                'kategori' => $row['kategori'] ?? '',
                'harga' => $row['harga'] ?? '',
                'rating' => !empty($row['rating']) ? (float) $row['rating'] : null,
                'jumlah_viewers' => !empty($row['jumlah_viewers']) ? (int) $row['jumlah_viewers'] : null,
                'bahasa' => $row['bahasa'] ?? 'Indonesia',
                'tipe' => $row['tipe_course'] ?? '',
                'durasi' => $row['durasi'] ?? '',
                'level' => $row['tingkat_kesulitan'] ?? 'Pemula',
                'platform' => $row['platform'] ?? '',
                'link' => $row['link_course'] ?? '',
            ]);

            $this->successCount++;
            return $course;

        } catch (\Exception $e) {
            $this->errorCount++;
            $this->errors[] = "Baris dengan judul '{$row['judul']}': " . $e->getMessage();
            Log::error('Import error: ' . $e->getMessage(), ['row' => $row]);
            return null;
        }
    }

    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255',
            'link_course' => 'required|url',
            'rating' => 'nullable|numeric|min:0|max:5',
            'jumlah_viewers' => 'nullable|integer|min:0',
        ];
    }

    public function customValidationMessages()
    {
        return [
            'judul.required' => 'Kolom Judul wajib diisi',
            'judul.max' => 'Judul maksimal 255 karakter',
            'link_course.required' => 'Kolom Link Course wajib diisi',
            'link_course.url' => 'Link Course harus berupa URL yang valid',  
            'rating.numeric' => 'Rating harus berupa angka',
            'rating.min' => 'Rating minimal 0',
            'rating.max' => 'Rating maksimal 5',
            'jumlah_viewers.integer' => 'Jumlah Viewers harus berupa angka bulat',
            'jumlah_viewers.min' => 'Jumlah Viewers tidak boleh negatif',
        ];
    }

    public function onError(\Throwable $e)
    {
        $this->errorCount++;
        $this->errors[] = "Error: " . $e->getMessage();
    }

    public function onFailure(\Maatwebsite\Excel\Validators\Failure ...$failures)
    {
        foreach ($failures as $failure) {
            $this->errorCount++;
            $this->errors[] = "Baris {$failure->row()}: " . implode(', ', $failure->errors());
        }
    }

    public function getSuccessCount()
    {
        return $this->successCount;
    }

    public function getErrorCount()
    {
        return count($this->failures()) + count($this->errors()) + $this->errorCount;
    }

    public function getErrors()
    {
        $allErrors = $this->errors;
        
        // Add validation failures
        foreach ($this->failures() as $failure) {
            $allErrors[] = "Baris {$failure->row()}: " . implode(', ', $failure->errors());
        }

        return $allErrors;
    }
}