<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Log;

class ProfileMatchingHelper
{
    // ... semua fungsi convert tetap sama ...

    public static function convertGapToBobot($gap): float
    {
        $originalGap = $gap;
        $gap = (int) $gap; // casting ke integer
        
        // Log untuk debugging
        Log::info("Gap conversion: original={$originalGap}, casted={$gap}");
        
        $bobot = match ($gap) {
            0 => 5.0,
            1 => 4.5,
            -1 => 4.0,
            2 => 3.5,
            -2 => 3.0,
            3 => 2.5,
            -3 => 2.0,
            4 => 1.5,
            -4 => 1.0,
            default => 1.0, 
        };
        
        Log::info("Gap {$gap} -> Bobot {$bobot}");
        
        return $bobot;
    }
     public static function interpolateBobot(float $bobot): float
    {
        $x0 = 1;   $x1 = 5;
        $min = 3;  $max = 5;
        return (($bobot - $x0) / ($x1 - $x0)) * ($max - $min) + $min;
    }

    /* ----------------------------------------------------------------
     |  3.  HITUNG SKOR PROFILE MATCHING  (NCF, NSF, Total)
     * ---------------------------------------------------------------- */
    public static function hitungSkor(array $nilaiAktual, array $nilaiIdeal): float
    {
        $bobotInterpolasi = [];

        foreach ($nilaiAktual as $i => $nilaiAkt)
        {
            $gap   = $nilaiAkt - $nilaiIdeal[$i];
            $bobot = self::convertGapToBobot($gap);
            $bobotInterpolasi[] = self::interpolateBobot($bobot);   // ⬅️ interpolasi di sini
        }

        /* Core Factor  = indeks 0‑4 (Kategori, Harga, Rating, Viewers, Bahasa)
           Secondary    = indeks 5‑8 (Tipe, Level, Durasi, Platform)           */
        $cf = array_sum(array_slice($bobotInterpolasi, 0, 5)) / 5;
        $sf = array_sum(array_slice($bobotInterpolasi, 5, 4)) / 4;

        return (0.7 * $cf) + (0.3 * $sf);
    }
 
    public static function convertKategori($kategori, $preferensi): int
    {
        return strtolower($kategori) === strtolower($preferensi) ? 5 : 1;
    }

  
    public static function convertTipe($tipe, $preferensi): int
    {
        if (empty($preferensi)) {
            return 3;
        }
        return strtolower($tipe) === strtolower($preferensi) ? 3 : 1;
    }

    public static function convertBahasa($bahasa, $preferensi): int
    {
        return strtolower($bahasa) === strtolower($preferensi) ? 3 : 1;
    }

    public static function convertLevel($levelCourse, $preferensi): int
{
    if (empty($preferensi)) return 1;

    return strtolower($levelCourse) === strtolower($preferensi) ? 3 : 1;
}

    public static function convertPlatform($platform, $preferensi): int
    {
        if (empty($preferensi)) {
            return 3;
        }
        return strtolower($platform) === strtolower($preferensi) ? 3 : 1;
    }

    public static function convertRatingToActual($ratingCourse, $preferensiRange): int
    {
        if (str_contains($preferensiRange, '-')) {
            [$min, $max] = explode('-', $preferensiRange);
            $min = (float) $min;
            $max = (float) $max;

            if ($ratingCourse >= $min && $ratingCourse <= $max) {
                return 5;
            } elseif (abs($ratingCourse - $min) <= 0.2 || abs($ratingCourse - $max) <= 0.2) {
                return 3;
            } else {
                return 1;
            }
        }
        return 3;
    }

    public static function convertViewersToActual($viewersCourse, $preferensiRange): int
    {
        if (str_contains($preferensiRange, '-')) {
            [$min, $max] = explode('-', $preferensiRange);
            $min = (int) $min;
            $max = (int) $max;

            if ($viewersCourse >= $min && $viewersCourse <= $max) {
                return 3;
            } elseif (abs($viewersCourse - $min) <= 5000 || abs($viewersCourse - $max) <= 5000) {
                return 2;
            } else {
                return 1;
            }
        } else {
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
        if (empty($preferensiHarga)) {
            return 1;
        }

        $preferensi = (int) $preferensiHarga;

        switch ($preferensi) {
            case 0:
                return $hargaCourse == 0 ? 4 : 1;
                
            case 100000:
                if ($hargaCourse < 100000) {
                    return 4;
                } elseif ($hargaCourse <= 150000) {
                    return 2;
                } else {
                    return 1;
                }
                
            case 500000:
                if ($hargaCourse < 500000) {
                    return 4;
                } elseif ($hargaCourse <= 700000) {
                    return 2;
                } else {
                    return 1;
                }
                
            case 1000000:
                if ($hargaCourse < 1000000) {
                    return 4;
                } elseif ($hargaCourse <= 1200000) {
                    return 2;
                } else {
                    return 1;
                }
                
            case 1000001:
                if ($hargaCourse > 1000000) {
                    return 4;
                } elseif ($hargaCourse >= 750000) {
                    return 2;
                } else {
                    return 1;
                }
                
            default:
                return 1;
        }
    }

    public static function normalizeDurasi($durasi): string
    {
        $durasi = strtolower(trim($durasi));
        $angka = (int) filter_var($durasi, FILTER_SANITIZE_NUMBER_INT);

        if (str_contains($durasi, 'weeks') || str_contains($durasi, 'hours') || 
            str_contains($durasi, 'minggu') || str_contains($durasi, 'jam')) {
            return '< 1 bulan';
        }

        if (str_contains($durasi, 'month') || str_contains($durasi, 'bulan')) {
            if ($angka === 0 || $angka === 1) {
                return '< 1 bulan';
            } elseif ($angka <= 6) {
                return '1-6 bulan';
            } else {
                return '> 6 bulan';
            }
        }

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
        if (empty($preferensi)) {
            return 1;
        }
        return strtolower(trim($durasi)) === strtolower(trim($preferensi)) ? 3 : 1;
    }
}