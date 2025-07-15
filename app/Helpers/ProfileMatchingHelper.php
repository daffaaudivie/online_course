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
     * Konversi tipe course ke nilai aktual sesuai preferensi.
     */
    public static function convertTipe($tipe, $preferensi): int
    {
        // Jika tidak ada preferensi (default), return 3 (nilai ideal)
        if (empty($preferensi)) {
            return 3;
        }

        // Jika tipe sama dengan preferensi, return 3 (sesuai nilai ideal)
        return strtolower($tipe) === strtolower($preferensi) ? 3 : 1;
    }

    /**
     * Konversi bahasa ke nilai aktual (3 ideal).
     */
    public static function convertBahasa($bahasa, $preferensi): int
    {
        return strtolower($bahasa) === strtolower($preferensi) ? 3 : 1;
    }

    /**
     * Konversi level kesulitan ke nilai aktual sesuai preferensi.
     */
    public static function convertLevel($level, $preferensi): int
    {
        // Jika tidak ada preferensi (default), return 3 (nilai ideal)
        if (empty($preferensi)) {
            return 3;
        }

        // Jika level sama dengan preferensi, return 3 (sesuai nilai ideal)
        return strtolower($level) === strtolower($preferensi) ? 3 : 1;
    }

    /**
     * Konversi platform ke nilai aktual sesuai preferensi.
     */
    public static function convertPlatform($platform, $preferensi): int
    {
        // Jika tidak ada preferensi (default), return 3 (nilai ideal)
        if (empty($preferensi)) {
            return 3;
        }

        // Jika platform sama dengan preferensi, return 3 (sesuai nilai ideal)
        return strtolower($platform) === strtolower($preferensi) ? 3 : 1;
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
                return 5; // sesuai dengan nilai ideal
            } elseif (abs($ratingCourse - $min) <= 0.2 || abs($ratingCourse - $max) <= 0.2) {
                return 4; // mendekati
            } else {
                return 1; // tidak cocok
            }
        }

        return 3; // default jika format tidak dikenali
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
                return 3; // sesuai dengan nilai ideal
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
        // Jika tidak ada preferensi (default), return 4 (nilai ideal)
        if (empty($preferensiHarga)) {
            return 4;
        }

        $preferensi = (int) $preferensiHarga;

        // Logika berdasarkan kategori harga dari form
        switch ($preferensi) {
            case 0:
                // Course Gratis - hanya cocok jika harga course = 0
                return $hargaCourse == 0 ? 4 : 1;
                
            case 100000:
                // < Rp 100.000 - cocok jika harga course < 100.000
                if ($hargaCourse < 100000) {
                    return 4;
                } elseif ($hargaCourse <= 150000) {
                    return 2; // sedikit di atas range
                } else {
                    return 1;
                }
                
            case 500000:
                // < Rp 500.000 - cocok jika harga course < 500.000
                if ($hargaCourse < 500000) {
                    return 4;
                } elseif ($hargaCourse <= 700000) {
                    return 2; // sedikit di atas range
                } else {
                    return 1;
                }
                
            case 1000000:
                // < Rp 1.000.000 - cocok jika harga course < 1.000.000
                if ($hargaCourse < 1000000) {
                    return 4;
                } elseif ($hargaCourse <= 1200000) {
                    return 2; // sedikit di atas range
                } else {
                    return 1;
                }
                
            case 1000001:
                // > Rp 1.000.000
                if ($hargaCourse > 1000000) {
                    return 4; // sesuai preferensi premium
                } elseif ($hargaCourse >= 750000) {
                    return 2; // mendekati range premium
                } else {
                    return 1; // terlalu murah untuk preferensi premium
                }
                
            default:
                return 1;
        }
    }

    public static function normalizeDurasi($durasi): string
    {
        $durasi = strtolower(trim($durasi));
        
        // Ekstrak angka dari string
        $angka = (int) filter_var($durasi, FILTER_SANITIZE_NUMBER_INT);

        // Jika mengandung "week" atau "hour", langsung kategorikan sebagai < 1 bulan
        if (str_contains($durasi, 'weeks') || str_contains($durasi, 'hours') || 
            str_contains($durasi, 'minggu') || str_contains($durasi, 'jam')) {
            return '< 1 bulan';
        }

        // Jika mengandung "month" atau "bulan"
        if (str_contains($durasi, 'month') || str_contains($durasi, 'bulan')) {
            if ($angka === 0 || $angka === 1) {
                return '< 1 bulan';
            } elseif ($angka <= 6) {
                return '1-6 bulan';
            } else {
                return '> 6 bulan';
            }
        }

        // Fallback untuk angka tanpa unit (asumsi bulan)
        if ($angka === 0) {
            return '< 1 bulan';
        } elseif ($angka <= 6) {
            return '1-6 bulan';
        } else {
            return '> 6 bulan';
        }
    }

    public static function convertDurasi($durasi, $preferensi = null): int
    {
        // Jika tidak ada preferensi (default), return 3 (nilai ideal)
        if (empty($preferensi)) {
            return 3;
        }

        // Jika durasi sama dengan preferensi, return 3 (sesuai nilai ideal)
        return strtolower(trim($durasi)) === strtolower(trim($preferensi)) ? 3 : 1;
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
            -4 => 1.0, // jika gap lebih dari ±4
        };
    }

    /**
     * Method untuk menghitung skor Profile Matching
     * Menghindari double interpolation
     */
    public static function hitungSkor($nilaiAktual, $nilaiIdeal): float
    {
        $bobotInterpolasi = [];
        
        foreach ($nilaiAktual as $i => $nilai) {
            $gap = $nilai - $nilaiIdeal[$i];
            $bobot = self::convertGapToBobot($gap);
            $bobotInterpolasi[] = $bobot;
        }
        
        // CF (Core Factor) - 5 kriteria pertama
        $cf = array_sum(array_slice($bobotInterpolasi, 0, 5)) / 5;
        
        // SF (Secondary Factor) - 4 kriteria terakhir  
        $sf = array_sum(array_slice($bobotInterpolasi, 5, 4)) / 4;
        
        // Total skor dengan bobot 70% CF dan 30% SF
        return (0.7 * $cf) + (0.3 * $sf);
    }
}