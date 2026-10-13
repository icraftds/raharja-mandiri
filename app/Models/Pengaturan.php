<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasFactory;

    protected $table = 'pengaturan';

    protected $fillable = [
        'kunci',
        'nilai',
        'tipe',
        'grup',
    ];

    /**
     * Ambil nilai pengaturan berdasarkan kunci.
     */
    public static function ambil(string $kunci, mixed $bawaan = null): mixed
    {
        $item = static::where('kunci', $kunci)->first();
        return $item ? $item->nilai : $bawaan;
    }

    /**
     * Simpan atau perbarui nilai pengaturan.
     */
    public static function atur(string $kunci, mixed $nilai, string $grup = 'umum', string $tipe = 'text'): static
    {
        return static::updateOrCreate(
            ['kunci' => $kunci],
            ['nilai' => $nilai, 'grup' => $grup, 'tipe' => $tipe]
        );
    }
}
