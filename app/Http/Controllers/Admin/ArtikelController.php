<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UnggahBerkas;
use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class ArtikelController extends Controller
{
    /**
     * Tampilkan daftar seluruh artikel.
     */
    public function index(): Response
    {
        $artikel = Artikel::latest('tanggal_publikasi')->get();

        return Inertia::render('admin/Artikel', [
            'articleList' => $artikel,
        ]);
    }

    /**
     * Tampilkan formulir tulis artikel baru.
     */
    public function create(): Response
    {
        return Inertia::render('admin/DetailArtikel', [
            'isEdit' => false,
            'articleData' => null,
        ]);
    }

    /**
     * Simpan artikel baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'ringkasan' => ['nullable', 'string'],
            'konten' => ['required', 'string'],
            'tanggal_publikasi' => ['required', 'date'],
            'gambar_sampul' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'kutipan' => ['nullable', 'string'],
            'penulis_kutipan' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'in:published,draft'],
        ], [
            'judul.required' => 'Judul artikel wajib diisi.',
            'kategori.required' => 'Kategori artikel wajib dipilih.',
            'konten.required' => 'Isi konten berita wajib ditulis.',
            'tanggal_publikasi.required' => 'Tanggal publikasi wajib ditentukan.',
        ]);

        // Buat slug unik
        $slug = Str::slug($validated['judul']);
        if (Artikel::where('slug', $slug)->exists()) {
            $slug .= '-' . Str::lower(Str::random(5));
        }

        $urlCover = null;
        if ($request->hasFile('gambar_sampul')) {
            $urlCover = UnggahBerkas::simpan($request->file('gambar_sampul'), 'artikel');
        }

        Artikel::create([
            'judul' => $validated['judul'],
            'slug' => $slug,
            'kategori' => $validated['kategori'],
            'ringkasan' => $validated['ringkasan'],
            'konten' => $validated['konten'],
            'gambar_sampul' => $urlCover ?? '/assets/images/sepatu-2.jpg',
            'kutipan' => $validated['kutipan'],
            'penulis_kutipan' => $validated['penulis_kutipan'],
            'status' => $validated['status'] ?? 'published',
            'tanggal_publikasi' => $validated['tanggal_publikasi'],
        ]);

        return redirect()->route('admin.artikel')->with('success', 'Artikel berhasil diterbitkan!');
    }

    /**
     * Tampilkan formulir edit artikel.
     */
    public function edit(int $id): Response
    {
        $artikel = Artikel::findOrFail($id);

        return Inertia::render('admin/DetailArtikel', [
            'isEdit' => true,
            'articleData' => $artikel,
        ]);
    }

    /**
     * Perbarui artikel yang ada.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $artikel = Artikel::findOrFail($id);

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:100'],
            'ringkasan' => ['nullable', 'string'],
            'konten' => ['required', 'string'],
            'tanggal_publikasi' => ['required', 'date'],
            'gambar_sampul' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'kutipan' => ['nullable', 'string'],
            'penulis_kutipan' => ['nullable', 'string'],
            'status' => ['nullable', 'string', 'in:published,draft'],
        ]);

        // Perbarui slug jika judul berubah
        if ($validated['judul'] !== $artikel->judul) {
            $slug = Str::slug($validated['judul']);
            if (Artikel::where('slug', $slug)->where('id', '!=', $artikel->id)->exists()) {
                $slug .= '-' . Str::lower(Str::random(5));
            }
            $validated['slug'] = $slug;
        }

        if ($request->hasFile('gambar_sampul')) {
            $validated['gambar_sampul'] = UnggahBerkas::simpan($request->file('gambar_sampul'), 'artikel', $artikel->gambar_sampul);
        }

        $artikel->update($validated);

        return redirect()->route('admin.artikel')->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Hapus artikel.
     */
    public function destroy(int $id): RedirectResponse
    {
        $artikel = Artikel::findOrFail($id);
        UnggahBerkas::hapus($artikel->gambar_sampul);
        $artikel->delete();

        return back()->with('success', 'Artikel berhasil dihapus.');
    }
}
