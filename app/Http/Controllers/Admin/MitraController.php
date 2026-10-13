<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UnggahBerkas;
use App\Http\Controllers\Controller;
use App\Models\Mitra;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MitraController extends Controller
{
    /**
     * Tampilkan daftar mitra kerja & kolaborasi.
     */
    public function index(): Response
    {
        $mitraList = Mitra::orderBy('urutan')->get();

        return Inertia::render('admin/Mitra', [
            'mitraList' => $mitraList,
        ]);
    }

    /**
     * Tambah mitra kerja baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'tipe_ikon' => ['nullable', 'string', 'max:50'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'aktif' => ['nullable', 'boolean'],
        ], [
            'nama.required' => 'Nama mitra/instansi wajib diisi.',
            'kategori.required' => 'Kategori atau peran mitra wajib diisi.',
        ]);

        $urlLogo = null;
        if ($request->hasFile('logo')) {
            $urlLogo = UnggahBerkas::simpan($request->file('logo'), 'mitra');
        }

        $urutanMaks = Mitra::max('urutan') ?? 0;

        Mitra::create([
            'nama' => $validated['nama'],
            'kategori' => $validated['kategori'],
            'tipe_ikon' => $validated['tipe_ikon'] ?? 'community',
            'logo' => $urlLogo,
            'urutan' => $urutanMaks + 1,
            'aktif' => $request->boolean('aktif', true),
        ]);

        return back()->with('success', 'Mitra kerja baru berhasil ditambahkan!');
    }

    /**
     * Perbarui data mitra kerja.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $mitra = Mitra::findOrFail($id);

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'tipe_ikon' => ['nullable', 'string', 'max:50'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'aktif' => ['nullable', 'boolean'],
            'urutan' => ['nullable', 'integer'],
        ], [
            'nama.required' => 'Nama mitra/instansi wajib diisi.',
            'kategori.required' => 'Kategori atau peran mitra wajib diisi.',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = UnggahBerkas::simpan($request->file('logo'), 'mitra', $mitra->logo);
        }

        $mitra->update($validated);

        return back()->with('success', 'Data mitra kerja berhasil diperbarui!');
    }

    /**
     * Hapus mitra kerja.
     */
    public function destroy(int $id): RedirectResponse
    {
        $mitra = Mitra::findOrFail($id);
        if ($mitra->logo) {
            UnggahBerkas::hapus($mitra->logo);
        }
        $mitra->delete();

        return back()->with('success', 'Mitra kerja berhasil dihapus.');
    }
}
