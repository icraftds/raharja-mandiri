<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Galeri;
use App\Models\Mitra;
use App\Models\Pengaturan;
use App\Models\Program;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman utama / beranda website.
     */
    public function index(): Response
    {
        $heroData = [
            'badge' => Pengaturan::ambil('hero_lencana', 'Wujudkan Harapan Mereka'),
            'titleTop' => Pengaturan::ambil('hero_judul_atas', 'Bersama Berbagi Kasih,'),
            'titleBottom' => Pengaturan::ambil('hero_judul_bawah', 'Membangun Masa Depan'),
            'description' => Pengaturan::ambil('hero_deskripsi', 'Panti Sosial Raharja Mandiri (PSRM) berdedikasi untuk memberikan kehidupan yang lebih baik, pendidikan yang layak, dan lingkungan penuh kasih bagi anak-anak di Tanjungsari, Sumedang.'),
            'image' => Pengaturan::ambil('hero_gambar', '/assets/images/sepatu-1.jpg'),
        ];

        $aboutData = [
            'badge' => Pengaturan::ambil('profil_lencana', 'Tentang Kami'),
            'title' => Pengaturan::ambil('profil_judul', 'Rumah Kedua yang Penuh dengan Kehangatan'),
            'image' => Pengaturan::ambil('profil_gambar', '/assets/images/tanam-3.jpg'),
            'paragraph1' => Pengaturan::ambil('profil_paragraf_1', 'Panti Sosial Raharja Mandiri hadir di Tanjungsari, Sumedang sebagai wadah untuk merangkul anak-anak yatim piatu dan dhuafa.'),
            'paragraph2' => Pengaturan::ambil('profil_paragraf_2', 'Visi kami adalah membentuk generasi yang mandiri, cerdas, dan berakhlak mulia.'),
            'countChildren' => Pengaturan::ambil('profil_angka_anak', '120+'),
            'labelChildren' => Pengaturan::ambil('profil_label_anak', 'Anak Asuh'),
            'countYears' => Pengaturan::ambil('profil_angka_tahun', '15'),
            'labelYears' => Pengaturan::ambil('profil_label_tahun', 'Tahun Berdiri'),
        ];

        $programs = Program::where('aktif', true)->orderBy('urutan')->get();
        $partners = Mitra::where('aktif', true)->orderBy('urutan')->get();
        $galleryHighlights = Galeri::orderBy('urutan')->latest()->take(4)->get();

        $latestNews = Artikel::where('status', 'published')
            ->latest('tanggal_publikasi')
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->judul,
                    'slug' => $item->slug,
                    'date' => $item->tanggal_publikasi ? $item->tanggal_publikasi->translatedFormat('d M Y') : $item->created_at->translatedFormat('d M Y'),
                    'summary' => $item->ringkasan,
                    'image' => $item->gambar_sampul,
                ];
            });

        return Inertia::render('Hero', [
            'hero' => $heroData,
            'about' => $aboutData,
            'programs' => $programs,
            'partners' => $partners,
            'galleryHighlights' => $galleryHighlights,
            'latestNews' => $latestNews,
        ]);
    }
}
