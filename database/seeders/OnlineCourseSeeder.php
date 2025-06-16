<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OnlineCourseSeeder extends Seeder
{
    public function run()
    {
        DB::table('online_course')->insert([
            [
                'judul' => 'Machine Learning Specialization',
                'link' => 'https://www.coursera.org/specializations/machine-learning-introduction',
                'deskripsi' => 'Master fundamental AI concepts and develop practical machine learning skills.',
                'kategori' => 'Data Science',
                'tipe' => 'Specialization',
                'harga' => 0,
                'bahasa' => 'English',
                'level' => 'Pemula',
                'rating' => 4.9,
                'jumlah_viewers' => 10438,
                'durasi' => '3 bulan',
                'platform' => 'Coursera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Introduction to Data Science Specialization',
                'link' => 'https://www.coursera.org/specializations/introduction-data-science',
                'deskripsi' => 'Gain foundational data science skills to prepare for a career or further advanced learning.',
                'kategori' => 'Data Science',
                'tipe' => 'Specialization',
                'harga' => 0,
                'bahasa' => 'English',
                'level' => 'Pemula',
                'rating' => 4.7,
                'jumlah_viewers' => 11927,
                'durasi' => '5 bulan',
                'platform' => 'Coursera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Data Science Fundamentals with Python and SQL',
                'link' => 'https://www.coursera.org/specializations/data-science-fundamentals-python-sql',
                'deskripsi' => 'Develop hands-on experience with Jupyter, Python, SQL.',
                'kategori' => 'Data Science',
                'tipe' => 'Specialization',
                'harga' => 0,
                'bahasa' => 'English',
                'level' => 'Menengah',
                'rating' => 4.6,
                'jumlah_viewers' => 2295,
                'durasi' => '7 bulan',
                'platform' => 'Coursera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Key Technologies for Business Specialization',
                'link' => 'https://www.coursera.org/specializations/key-technologies-for-business',
                'deskripsi' => 'Gain Foundational Understanding of Key Technologies Driving Modern Businesses.',
                'kategori' => 'Business',
                'tipe' => 'Specialization',
                'harga' => 0,
                'bahasa' => 'English',
                'level' => 'Menengah',
                'rating' => 4.7,
                'jumlah_viewers' => 1232,
                'durasi' => '3 bulan',
                'platform' => 'Coursera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Deep Learning Specialization',
                'link' => 'https://www.coursera.org/specializations/deep-learning',
                'deskripsi' => 'Master the fundamentals of deep learning and break into AI.',
                'kategori' => 'Data Science',
                'tipe' => 'Specialization',
                'harga' => 0,
                'bahasa' => 'English',
                'level' => 'Lanjut',
                'rating' => 4.9,
                'jumlah_viewers' => 129253,
                'durasi' => '5 bulan',
                'platform' => 'Coursera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
