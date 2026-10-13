<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ArtikelController extends Controller
{
    /**
     * Tampilkan indeks artikel dan berita yayasan.
     */
    public function index(): Response
    {
        $allArticles = Artikel::where('status', 'published')
            ->latest('tanggal_publikasi')
            ->get();

        // Cari artikel unggulan atau ambil artikel pertama
        $featured = $allArticles->firstWhere('unggulan', true) ?? $allArticles->first();

        $featuredFormatted = $featured ? [
            'id' => $featured->id,
            'title' => $featured->judul,
            'slug' => $featured->slug,
            'date' => $featured->tanggal_publikasi ? $featured->tanggal_publikasi->translatedFormat('d M Y') : '',
            'category' => $featured->kategori,
            'summary' => $featured->ringkasan,
            'image' => $featured->gambar_sampul,
        ] : null;

        $articlesList = $allArticles
            ->filter(fn ($item) => !$featured || $item->id !== $featured->id)
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->judul,
                    'slug' => $item->slug,
                    'date' => $item->tanggal_publikasi ? $item->tanggal_publikasi->translatedFormat('d M Y') : '',
                    'category' => $item->kategori,
                    'summary' => $item->ringkasan,
                    'image' => $item->gambar_sampul,
                ];
            })
            ->values();

        return Inertia::render('Artikel', [
            'featuredArticle' => $featuredFormatted,
            'articles' => $articlesList,
        ]);
    }

    /**
     * Tampilkan detail artikel berdasarkan slug.
     */
    public function show(string $slug): Response
    {
        $article = Artikel::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Tingkatkan jumlah pembaca
        $article->increment('jumlah_pembaca');

        // Rekomendasi 2 artikel lain
        $recommended = Artikel::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->latest('tanggal_publikasi')
            ->take(2)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->judul,
                    'slug' => $item->slug,
                    'category' => $item->kategori,
                    'summary' => $item->ringkasan,
                    'image' => $item->gambar_sampul,
                ];
            });

        return Inertia::render('BacaArtikel', [
            'article' => [
                'id' => $article->id,
                'title' => $article->judul,
                'slug' => $article->slug,
                'category' => $article->kategori,
                'summary' => $article->ringkasan,
                'content' => $article->konten,
                'image' => $article->gambar_sampul,
                'quote' => $article->kutipan,
                'quoteAuthor' => $article->penulis_kutipan,
                'additionalImages' => $article->gambar_tambahan ?? [],
                'date' => $article->tanggal_publikasi ? $article->tanggal_publikasi->translatedFormat('d M Y') : '',
            ],
            'recommended' => $recommended,
        ]);
    }

    /**
     * Penanganan kompatibilitas mundur rute lama /artikel/baca
     */
    public function showLegacy(Request $request)
    {
        $title = $request->query('title');
        if ($title) {
            $article = Artikel::where('judul', $title)->first();
            if ($article) {
                return redirect()->route('artikel.show', ['slug' => $article->slug]);
            }
        }

        $first = Artikel::where('status', 'published')->first();
        if ($first) {
            return redirect()->route('artikel.show', ['slug' => $first->slug]);
        }

        return redirect()->route('artikel.index');
    }
}
