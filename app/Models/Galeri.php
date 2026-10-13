<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = [
        'judul',
        'kategori',
        'gambar',
        'tinggi_tampilan',
        'tanggal_kegiatan',
        'urutan',
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
    ];
}
