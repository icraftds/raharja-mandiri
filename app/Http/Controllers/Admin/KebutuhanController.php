<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KebutuhanDonasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class KebutuhanController extends Controller
{
    /**
     * Tampilkan daftar kebutuhan logistik anak panti.
     */
    public function index(): Response
    {
        $kebutuhan = KebutuhanDonasi::orderBy('urutan')->get();

        return Inertia::render('admin/Kebutuhan', [
            'kebutuhanList' => $kebutuhan,
        ]);
    }

    /**
     * Tambah kebutuhan baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_barang' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'target_jumlah' => ['required', 'string', 'max:100'],
            'urgensi' => ['required', 'string', 'in:Mendesak,Rutin,Terpenuhi'],
        ], [
            'nama_barang.required' => 'Nama kebutuhan barang wajib diisi.',
            'target_jumlah.required' => 'Target jumlah yang dibutuhkan wajib diisi.',
            'urgensi.required' => 'Status urgensi wajib dipilih.',
        ]);

        $temaWarna = match ($validated['urgensi']) {
            'Mendesak' => ['pink', 'text-pink-600', 'bg-pink-600', 'bg-pink-50'],
            'Rutin' => ['blue', 'text-blue-600', 'bg-blue-600', 'bg-blue-50'],
            default => ['teal', 'text-teal-600', 'bg-teal-600', 'bg-teal-50'],
        };

        $urutanMaks = KebutuhanDonasi::max('urutan') ?? 0;

        KebutuhanDonasi::create([
            'nama_barang' => $validated['nama_barang'],
            'deskripsi' => $validated['deskripsi'],
            'target_jumlah' => $validated['target_jumlah'],
            'urgensi' => $validated['urgensi'],
            'warna_teks' => $temaWarna[1],
            'warna_latar' => $temaWarna[2],
            'warna_latar_muda' => $temaWarna[3],
            'aktif' => true,
            'urutan' => $urutanMaks + 1,
        ]);

        return back()->with('success', 'Kebutuhan baru berhasil ditambahkan!');
    }

    /**
     * Perbarui data kebutuhan.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $kebutuhan = KebutuhanDonasi::findOrFail($id);

        $validated = $request->validate([
            'nama_barang' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'target_jumlah' => ['required', 'string', 'max:100'],
            'urgensi' => ['required', 'string', 'in:Mendesak,Rutin,Terpenuhi'],
        ]);

        $temaWarna = match ($validated['urgensi']) {
            'Mendesak' => ['pink', 'text-pink-600', 'bg-pink-600', 'bg-pink-50'],
            'Rutin' => ['blue', 'text-blue-600', 'bg-blue-600', 'bg-blue-50'],
            default => ['teal', 'text-teal-600', 'bg-teal-600', 'bg-teal-50'],
        };

        $kebutuhan->update([
            'nama_barang' => $validated['nama_barang'],
            'deskripsi' => $validated['deskripsi'],
            'target_jumlah' => $validated['target_jumlah'],
            'urgensi' => $validated['urgensi'],
            'warna_teks' => $temaWarna[1],
            'warna_latar' => $temaWarna[2],
            'warna_latar_muda' => $temaWarna[3],
        ]);

        return back()->with('success', 'Data kebutuhan berhasil diperbarui!');
    }

    /**
     * Hapus kebutuhan.
     */
    public function destroy(int $id): RedirectResponse
    {
        $kebutuhan = KebutuhanDonasi::findOrFail($id);
        $kebutuhan->delete();

        return back()->with('success', 'Kebutuhan berhasil dihapus.');
    }
}
