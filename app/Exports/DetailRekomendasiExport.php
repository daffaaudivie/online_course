<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Illuminate\Support\Collection;

class DetailRekomendasiExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithEvents, ShouldAutoSize
{
    protected $courses;

    public function __construct($courses)
    {
        $this->courses = $courses;
    }

    public function collection(): Collection
    {
        return collect($this->courses)->map(function ($course, $index) {
            return [
                'no'            => $index + 1,
                'judul'         => $course->judul,
                'deskripsi'     => $course->deskripsi,
                'kategori'      => $course->kategori,
                'tipe'          => $course->tipe,
                'harga'         => $this->formatHarga($course->harga),
                'bahasa'        => $course->bahasa,
                'level'         => $course->level,
                'rating'        => $course->rating ? $course->rating . '/5' : '-',
                'jumlah_viewers'=> $this->formatNumber($course->jumlah_viewers),
                'durasi'        => $course->durasi,
                'platform'      => $course->platform,
                'link'          => $course->link,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Judul Course',
            'Deskripsi',
            'Kategori',
            'Tipe',
            'Harga',
            'Bahasa',
            'Level',
            'Rating',
            'Jumlah Viewers',
            'Durasi',
            'Platform',
            'Link Course',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style untuk header
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['argb' => Color::COLOR_WHITE],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => '4472C4'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => Color::COLOR_BLACK],
                    ],
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,   // No
            'B' => 35,  // Judul
            'C' => 50,  // Deskripsi
            'D' => 15,  // Kategori
            'E' => 12,  // Tipe
            'F' => 15,  // Harga
            'G' => 12,  // Bahasa
            'H' => 12,  // Level
            'I' => 12,  // Rating
            'J' => 18,  // Jumlah Viewers
            'K' => 15,  // Durasi
            'L' => 15,  // Platform
            'M' => 30,  // Link
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                // Style untuk seluruh data
                $dataRange = 'A2:' . $highestColumn . $highestRow;
                $sheet->getStyle($dataRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'CCCCCC'],
                        ],
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_TOP,
                        'wrapText' => true,
                    ],
                ]);

                // Style untuk kolom nomor
                $sheet->getStyle('A2:A' . $highestRow)->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Style untuk kolom harga
                $sheet->getStyle('F2:F' . $highestRow)->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_RIGHT,
                    ],
                ]);

                // Style untuk kolom rating
                $sheet->getStyle('I2:I' . $highestRow)->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Style untuk kolom viewers
                $sheet->getStyle('J2:J' . $highestRow)->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_RIGHT,
                    ],
                ]);

                // Freeze panes untuk header
                $sheet->freezePane('A2');

                // Set row height untuk header
                $sheet->getRowDimension('1')->setRowHeight(25);

                // Set minimum row height untuk data
                for ($row = 2; $row <= $highestRow; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(-1); // Auto height
                }

                // Style alternating rows (zebra striping)
                for ($row = 2; $row <= $highestRow; $row++) {
                    if ($row % 2 == 0) {
                        $sheet->getStyle('A' . $row . ':' . $highestColumn . $row)->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['argb' => 'F8F9FA'],
                            ],
                        ]);
                    }
                }

                // Auto-filter untuk header
                $sheet->setAutoFilter('A1:' . $highestColumn . '1');
            },
        ];
    }

    private function formatHarga($harga)
    {
        if ($harga == 0 || $harga === null) {
            return 'Gratis';
        }
        
        if (is_numeric($harga)) {
            return 'Rp ' . number_format($harga, 0, ',', '.');
        }
        
        return $harga;
    }

    private function formatNumber($number)
    {
        if ($number === null || $number === '') {
            return '-';
        }
        
        if (is_numeric($number)) {
            if ($number >= 1000000) {
                return number_format($number / 1000000, 1) . 'M';
            } elseif ($number >= 1000) {
                return number_format($number / 1000, 1) . 'K';
            }
            return number_format($number);
        }
        
        return $number;
    }
}