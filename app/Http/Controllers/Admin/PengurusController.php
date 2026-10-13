<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UnggahBerkas;
use App\Http\Controllers\Controller;
use App\Models\Pengurus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PengurusController extends Controller
{
    /**
     * Tampilkan susunan kepengurusan yayasan.
     */
    public function index(): Response
    {
        $pengurusList = Pengurus::orderBy('urutan')->get();

        return Inertia::render('admin/Kepengurusan', [
            'teamList' => $pengurusList,
        ]);
    }

    /**
     * Tambah anggota pengurus baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'nama.required' => 'Nama pengurus wajib diisi.',
            'jabatan.required' => 'Jabatan/posisi wajib diisi.',
        ]);

        $urlFoto = null;
        if ($request->hasFile('foto')) {
            $urlFoto = UnggahBerkas::simpan($request->file('foto'), 'pengurus');
        }

        $urutanMaks = Pengurus::max('urutan') ?? 0;

        Pengurus::create([
            'nama' => $validated['nama'],
            'jabatan' => $validated['jabatan'],
            'foto' => $urlFoto ?? 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=800&q=80',
            'urutan' => $urutanMaks + 1,
            'aktif' => true,
        ]);

        return back()->with('success', 'Pengurus baru berhasil ditambahkan!');
    }

    /**
     * Perbarui data pengurus.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $pengurus = Pengurus::findOrFail($id);

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = UnggahBerkas::simpan($request->file('foto'), 'pengurus', $pengurus->foto);
        }

        $pengurus->update($validated);

        return back()->with('success', 'Data pengurus berhasil diperbarui!');
    }

    /**
     * Hapus pengurus.
     */
    public function destroy(int $id): RedirectResponse
    {
        $pengurus = Pengurus::findOrFail($id);
        UnggahBerkas::hapus($pengurus->foto);
        $pengurus->delete();

        return back()->with('success', 'Pengurus berhasil dihapus.');
    }
}
