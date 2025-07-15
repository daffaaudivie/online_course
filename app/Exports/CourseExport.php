<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class CourseExport implements FromArray, WithHeadings, WithStyles, WithColumnWidths, WithCustomStartCell
{
    public function array(): array
    {
        return [
            [
                'Introduction to Data Science Specialization',
                'Launch your career in data science. Gain foundational data science skills to prepare for a career or further advanced learning in data science. ',
                'Data Science',
                '635179',
                '4.5',
                '15000',
                'English',
                'Specialization',
                '5 Months',
                'Beginner',
                'Coursera',
                'https://www.coursera.org/specializations/introduction-data-science'
            ],
            [
                'Data Engineering Foundations Specialization',
                'Build the Foundation for a Data Engineering Career. Develop hands-on experience with Python, SQL, and Relational Databases and master the fundamentals of the Data Engineering ecosystem. ',
                'Information Technology',
                '798045',
                '4.7',
                '922',
                'English',
                'Specialization',
                '5 Months',
                'Intermediate',
                'Coursera',
                'https://www.coursera.org/specializations/data-engineering-foundations'
            ]
        ];
    }

    public function headings(): array
    {
        return [
            'Judul',
            'Deskripsi',
            'Kategori',
            'Harga',
            'Rating',
            'Jumlah Viewers',
            'Bahasa',
            'Tipe Course',
            'Durasi',
            'Tingkat Kesulitan',
            'Platform',
            'Link Course'
        ];
    }

    public function startCell(): string
    {
        return 'A3';
    }

    public function styles(Worksheet $sheet)
    {
        // Judul dan Petunjuk
        $sheet->setCellValue('A1', 'TEMPLATE IMPORT DATA COURSE');
        $sheet->mergeCells('A1:L1');
        $sheet->setCellValue('A2', 'Petunjuk: Isi data course sesuai dengan kolom yang tersedia. Hapus baris contoh ini sebelum mengupload.');
        $sheet->mergeCells('A2:L2');

        return [
            // Style Judul
            'A1' => [
                'font' => [
                    'bold' => true,
                    'size' => 16,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2563EB'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],

            // Style Instruksi
            'A2' => [
                'font' => [
                    'italic' => true,
                    'size' => 10,
                    'color' => ['rgb' => '7C2D12'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'FEF3C7'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],

            // Style Header
            '3' => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '059669'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],

            // Style Baris Data
            '4:6' => [
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'D1D5DB'],
                    ],
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30, // Judul
            'B' => 40, // Deskripsi  
            'C' => 20, // Kategori
            'D' => 15, // Harga
            'E' => 10, // Rating
            'F' => 15, // Jumlah Viewers
            'G' => 12, // Bahasa
            'H' => 25, // Tipe Course
            'I' => 15, // Durasi
            'J' => 18, // Tingkat Kesulitan
            'K' => 12, // Platform
            'L' => 50, // Link Course
        ];
    }
}
