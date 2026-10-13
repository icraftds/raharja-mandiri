<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UnggahBerkas;
use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman editor Hero & Homepage.
     */
    public function index(): Response
    {
        $heroForm = [
            'titleTop' => Pengaturan::ambil('hero_judul_atas', 'Bersama Berbagi Kasih,'),
            'titleBottom' => Pengaturan::ambil('hero_judul_bawah', 'Membangun Masa Depan'),
            'description' => Pengaturan::ambil('hero_deskripsi', 'Panti Sosial Raharja Mandiri (PSRM) berdedikasi...'),
            'badgeText' => Pengaturan::ambil('hero_lencana', 'Wujudkan Harapan Mereka'),
            'bgImage' => Pengaturan::ambil('hero_gambar', '/assets/images/sepatu-1.jpg'),
        ];

        return Inertia::render('admin/Dashboard', [
            'heroData' => $heroForm,
        ]);
    }

    /**
     * Simpan pembaruan teks & media Hero Section.
     */
    public function updateHero(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'titleTop' => ['required', 'string', 'max:255'],
            'titleBottom' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'badgeText' => ['nullable', 'string', 'max:100'],
            'bgImageFile' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'titleTop.required' => 'Baris pertama judul wajib diisi.',
            'titleBottom.required' => 'Baris kedua judul wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'bgImageFile.image' => 'Berkas harus berupa gambar.',
            'bgImageFile.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        Pengaturan::atur('hero_judul_atas', $validated['titleTop'], 'hero');
        Pengaturan::atur('hero_judul_bawah', $validated['titleBottom'], 'hero');
        Pengaturan::atur('hero_deskripsi', $validated['description'], 'hero');

        if (!empty($validated['badgeText'])) {
            Pengaturan::atur('hero_lencana', $validated['badgeText'], 'hero');
        }

        if ($request->hasFile('bgImageFile')) {
            $gambarLama = Pengaturan::ambil('hero_gambar');
            $urlGambar = UnggahBerkas::simpan($request->file('bgImageFile'), 'hero', $gambarLama);
            Pengaturan::atur('hero_gambar', $urlGambar, 'hero');
        }

        return back()->with('success', 'Hero Section berhasil diperbarui!');
    }
}
