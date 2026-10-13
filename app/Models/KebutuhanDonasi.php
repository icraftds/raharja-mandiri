<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KebutuhanDonasi extends Model
{
    use HasFactory;

    protected $table = 'kebutuhan_donasi';

    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'target_jumlah',
        'urgensi',
        'warna_teks',
        'warna_latar',
        'warna_latar_muda',
        'aktif',
        'urutan',
    ];

    protected $casts = [
        'aktif' => 'boolean',
        'urutan' => 'integer',
    ];
}
