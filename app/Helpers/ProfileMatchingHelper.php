<?php

namespace App\Helpers;

class ProfileMatchingHelper
{
    /**
     * Konversi kategori course ke nilai aktual (5 = sesuai preferensi).
     */
    public static function convertKategori($kategori, $preferensi): int
    {
        return strtolower($kategori) === strtolower($preferensi) ? 5 : 1;
    }

    /**
     * Konversi tipe course ke nilai aktual sesuai jarak preferensi.
     */
    public static function convertTipe($tipe, $preferensi): int
    {
        $urutan = [
            'specialization',
            'professional certificate',
            'project',
            'free',
        ];

        return self::preferensiToNilai($tipe, $preferensi, $urutan, 3);
    }

    /**
     * Konversi bahasa ke nilai aktual (3 ideal).
     */
    public static function convertBahasa($bahasa, $preferensi): int
    {
        return strtolower($bahasa) === strtolower($preferensi) ? 3 : 2;
    }

    /**
     * Konversi level kesulitan ke nilai aktual sesuai preferensi.
     */
    public static function convertLevel($level, $preferensi): int
    {
        $urutan = ['pemula', 'menengah', 'lanjutan'];
        return self::preferensiToNilai($level, $preferensi, $urutan, 3);
    }

    /**
     * Konversi platform ke nilai aktual sesuai preferensi.
     */
    public static function convertPlatform($platform, $preferensi): int
    {
        $urutan = ['coursera', 'udemy', 'edx', 'dicoding'];
        return self::preferensiToNilai($platform, $preferensi, $urutan, 3);
    }

    /**
     * Generalized preferensi -> nilai aktual (skala ideal: 3).
     */
    private static function preferensiToNilai($value, $preferensi, $urutan, int $idealSkor = 3): int
    {
        $v = strtolower($value);
        $p = strtolower($preferensi);

        $vi = array_search($v, $urutan);
        $pi = array_search($p, $urutan);

        if ($vi === false || $pi === false) return 1;

        $selisih = abs($vi - $pi);

        return match (true) {
            $selisih === 0 => $idealSkor,
            $selisih === 1 => $idealSkor - 1,
            default => $idealSkor - 2
        };
    }

    /**
     * Interpolasi linear dari nilai numerik.
     */
    public static function interpolate($x, $min, $max, $targetMin = 3, $targetMax = 5): float
    {
        if ($max == $min) return $targetMin;
        return (($x - $min) / ($max - $min)) * ($targetMax - $targetMin) + $targetMin;
    }

    /**
     * Konversi rating (1–5) ke bobot interpolasi.
     */
    public static function convertRatingToActual($ratingCourse, $preferensiRange): int
    {
    if (str_contains($preferensiRange, '-')) {
        [$min, $max] = explode('-', $preferensiRange);
        $min = (float) $min;
        $max = (float) $max;

        if ($ratingCourse >= $min && $ratingCourse <= $max) {
            return 5; // sesuai
        } elseif (abs($ratingCourse - $min) <= 0.2 || abs($ratingCourse - $max) <= 0.2) {
            return 4; // mendekati
        } else {
            return 3; // tidak cocok
        }
    }

    return 3;
    }


    /**
     * Konversi jumlah viewers ke bobot.
     */
    public static function convertViewersToActual($viewersCourse, $preferensiRange): int
    {
        if (str_contains($preferensiRange, '-')) {
            [$min, $max] = explode('-', $preferensiRange);
            $min = (int) $min;
            $max = (int) $max;

            if ($viewersCourse >= $min && $viewersCourse <= $max) {
                return 3; // sesuai preferensi
            } elseif (abs($viewersCourse - $min) <= 5000 || abs($viewersCourse - $max) <= 5000) {
                return 2; // agak dekat
            } else {
                return 1; // jauh
            }
        } else {
            // misal preferensi = 50001
            $preferensi = (int) $preferensiRange;

            if ($viewersCourse >= $preferensi) {
                return 3;
            } elseif ($viewersCourse >= $preferensi - 10000) {
                return 2;
            } else {
                return 1;
            }
        }
    }


    public static function convertHargaToActual($hargaCourse, $preferensiHarga): int
    {
        $selisih = abs($hargaCourse - $preferensiHarga);

        if ($selisih == 0) {
            return 4; // sesuai nilai ideal
        } elseif ($selisih <= 250000) {
            return 3;
        } elseif ($selisih <= 750000) {
            return 2;
        } else {
            return 1;
        }
}

    public static function normalizeDurasi($durasi): string
{
    $angka = (int) filter_var($durasi, FILTER_SANITIZE_NUMBER_INT);

    if ($angka === 0) {
        return '< 1 bulan';
    } elseif ($angka <= 6) {
        return '1-6 bulan';
    } else {
        return '> 6 bulan';
    }
}


    public static function convertDurasi($durasi): int
        {
            return match (strtolower(trim($durasi))) {
            '< 1 bulan' => 2,
            '1-6 bulan' => 3,
            '> 6 bulan' => 4,
            default => 3,
        };
    }
    public static function convertGapToBobot($gap): float
    {
        return match ($gap) {
            0 => 5.0,
            1 => 4.5,
            -1 => 4.0,
            2 => 3.5,
            -2 => 3.0,
            3 => 2.5,
            -3 => 2.0,
            4 => 1.5,
            -4 => 1.0,
            default => 1.0 // jika gap lebih dari ±4
        };
    }
}