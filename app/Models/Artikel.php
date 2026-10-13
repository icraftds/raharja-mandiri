<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'ringkasan',
        'konten',
        'gambar_sampul',
        'kutipan',
        'penulis_kutipan',
        'gambar_tambahan',
        'status',
        'unggulan',
        'jumlah_pembaca',
        'tanggal_publikasi',
    ];

    protected $casts = [
        'gambar_tambahan' => 'array',
        'unggulan' => 'boolean',
        'tanggal_publikasi' => 'date',
        'jumlah_pembaca' => 'integer',
    ];
}
