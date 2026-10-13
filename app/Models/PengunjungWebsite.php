<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengunjungWebsite extends Model
{
    use HasFactory;

    protected $table = 'pengunjung_website';

    protected $fillable = [
        'alamat_ip',
        'halaman',
        'judul_halaman',
        'perangkat',
        'browser',
        'sistem_operasi',
        'perujuk',
        'user_agent',
    ];

    /**
     * Helper untuk membedah User Agent menjadi perangkat, browser, dan OS secara akurat.
     */
    public static function uraikanUserAgent(?string $userAgent): array
    {
        $ua = $userAgent ?? '';
        
        // Deteksi Perangkat
        $perangkat = 'Desktop';
        if (preg_match('/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i', $ua)) {
            $perangkat = 'Tablet';
        } elseif (preg_match('/(mobi|iphone|ipod|blackberry|opera mini|iemobile|mobile)/i', $ua)) {
            $perangkat = 'Mobile';
        }

        // Deteksi Sistem Operasi
        $sistemOperasi = 'Lainnya';
        if (preg_match('/windows nt/i', $ua)) {
            $sistemOperasi = 'Windows';
        } elseif (preg_match('/macintosh|mac os x/i', $ua)) {
            $sistemOperasi = 'macOS';
        } elseif (preg_match('/iphone|ipad|ipod/i', $ua)) {
            $sistemOperasi = 'iOS';
        } elseif (preg_match('/android/i', $ua)) {
            $sistemOperasi = 'Android';
        } elseif (preg_match('/linux/i', $ua)) {
            $sistemOperasi = 'Linux';
        }

        // Deteksi Browser
        $browser = 'Lainnya';
        if (preg_match('/edg/i', $ua)) {
            $browser = 'Microsoft Edge';
        } elseif (preg_match('/opr|opera/i', $ua)) {
            $browser = 'Opera';
        } elseif (preg_match('/chrome|crios/i', $ua)) {
            $browser = 'Chrome';
        } elseif (preg_match('/firefox|fxios/i', $ua)) {
            $browser = 'Firefox';
        } elseif (preg_match('/safari/i', $ua) && !preg_match('/chrome/i', $ua)) {
            $browser = 'Safari';
        }

        return [
            'perangkat' => $perangkat,
            'browser' => $browser,
            'sistem_operasi' => $sistemOperasi,
        ];
    }
}
