<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Inertia\Inertia;
use Inertia\Response;

class GaleriController extends Controller
{
    /**
     * Tampilkan galeri momen foto yayasan.
     */
    public function index(): Response
    {
        $photos = Galeri::orderBy('urutan')->latest()->get()->map(function ($item) {
            return [
                'id' => $item->id,
                'url' => $item->gambar,
                'title' => $item->judul,
                'category' => $item->kategori,
                'height' => $item->tinggi_tampilan ?? 'h-80',
            ];
        });

        // Ambil kategori unik yang ada di database
        $kategoriDB = Galeri::select('kategori')->distinct()->pluck('kategori')->toArray();
        $categories = array_values(array_unique(array_merge(['Semua Momen'], $kategoriDB)));

        return Inertia::render('Galeri', [
            'photos' => $photos,
            'categories' => $categories,
        ]);
    }
}
