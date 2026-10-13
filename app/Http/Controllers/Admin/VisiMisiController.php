<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Misi;
use App\Models\Pengaturan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class VisiMisiController extends Controller
{
    /**
     * Tampilkan halaman editor Visi & Misi.
     */
    public function index(): Response
    {
        $visiText = Pengaturan::ambil('visi_utama', 'Menjadi lembaga yang mencetak generasi Mandiri, Cerdas, & Berakhlak Mulia...');
        $misiList = Misi::orderBy('urutan')->get();

        return Inertia::render('admin/VisiMisi', [
            'visiAwal' => $visiText,
            'misiAwal' => $misiList,
        ]);
    }

    /**
     * Simpan pembaruan teks Visi dan daftar Misi.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'visi' => ['required', 'string'],
            'misi' => ['required', 'array', 'min:1'],
            'misi.*.id' => ['nullable', 'integer'],
            'misi.*.judul' => ['required', 'string', 'max:255'],
            'misi.*.deskripsi' => ['required', 'string'],
        ], [
            'visi.required' => 'Teks visi yayasan wajib diisi.',
            'misi.required' => 'Daftar misi wajib diisi minimal 1.',
        ]);

        // Simpan visi
        Pengaturan::atur('visi_utama', $validated['visi'], 'visi');

        // Simpan / perbarui misi
        $idTerpakai = [];
        $warnaList = ['blue', 'teal', 'pink', 'amber'];

        foreach ($validated['misi'] as $index => $item) {
            $warnaIndex = $index % count($warnaList);
            $warnaName = $warnaList[$warnaIndex];

            if (!empty($item['id'])) {
                $misi = Misi::find($item['id']);
                if ($misi) {
                    $misi->update([
                        'judul' => $item['judul'],
                        'deskripsi' => $item['deskripsi'],
                        'urutan' => $index + 1,
                    ]);
                    $idTerpakai[] = $misi->id;
                    continue;
                }
            }

            $misiBaru = Misi::create([
                'judul' => $item['judul'],
                'deskripsi' => $item['deskripsi'],
                'warna_teks' => "text-{$warnaName}-600",
                'warna_latar' => "bg-{$warnaName}-600",
                'urutan' => $index + 1,
            ]);
            $idTerpakai[] = $misiBaru->id;
        }

        // Hapus misi yang dihapus dari form
        Misi::whereNotIn('id', $idTerpakai)->delete();

        return back()->with('success', 'Visi & Misi yayasan berhasil diperbarui!');
    }
}
