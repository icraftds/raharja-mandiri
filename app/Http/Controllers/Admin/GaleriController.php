<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UnggahBerkas;
use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class GaleriController extends Controller
{
    /**
     * Tampilkan galeri foto di CMS admin.
     */
    public function index(): Response
    {
        $photos = Galeri::orderBy('urutan')->latest()->get();

        return Inertia::render('admin/Galeri', [
            'photoList' => $photos,
        ]);
    }

    /**
     * Simpan unggahan foto baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'gambar' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'judul.required' => 'Judul foto wajib diisi.',
            'kategori.required' => 'Kategori foto wajib dipilih.',
            'gambar.required' => 'Berkas gambar wajib diunggah.',
            'gambar.image' => 'Berkas harus berupa gambar (JPG, PNG, WebP).',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $urlGambar = UnggahBerkas::simpan($request->file('gambar'), 'galeri');

        // Pengaturan tinggi masonry random/default
        $heights = ['h-72', 'h-80', 'h-96'];
        $randomHeight = $heights[array_rand($heights)];

        Galeri::create([
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'gambar' => $urlGambar,
            'tinggi_tampilan' => $randomHeight,
            'tanggal_kegiatan' => now()->toDateString(),
        ]);

        return back()->with('success', 'Foto galeri berhasil diunggah!');
    }

    /**
     * Hapus foto dari galeri.
     */
    public function destroy(int $id): RedirectResponse
    {
        $galeri = Galeri::findOrFail($id);
        UnggahBerkas::hapus($galeri->gambar);
        $galeri->delete();

        return back()->with('success', 'Foto berhasil dihapus dari galeri.');
    }
}
