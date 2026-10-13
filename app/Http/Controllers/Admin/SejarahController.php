<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UnggahBerkas;
use App\Http\Controllers\Controller;
use App\Models\Sejarah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SejarahController extends Controller
{
    /**
     * Tampilkan linimasa sejarah yayasan.
     */
    public function index(): Response
    {
        $sejarahData = Sejarah::orderBy('urutan')->orderBy('tahun')->get();

        return Inertia::render('admin/Sejarah', [
            'sejarahList' => $sejarahData,
        ]);
    }

    /**
     * Tambah tahun/peristiwa baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tahun' => ['required', 'string', 'max:50'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'tahun.required' => 'Tahun wajib diisi.',
            'judul.required' => 'Judul peristiwa wajib diisi.',
            'deskripsi.required' => 'Deskripsi peristiwa wajib diisi.',
        ]);

        $urlGambar = null;
        if ($request->hasFile('gambar')) {
            $urlGambar = UnggahBerkas::simpan($request->file('gambar'), 'sejarah');
        }

        $urutanMaks = Sejarah::max('urutan') ?? 0;

        Sejarah::create([
            'tahun' => $validated['tahun'],
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'gambar' => $urlGambar ?? '/assets/images/tanam-2.jpg',
            'urutan' => $urutanMaks + 1,
        ]);

        return back()->with('success', 'Momentum sejarah baru berhasil ditambahkan!');
    }

    /**
     * Perbarui data linimasa sejarah secara massal atau per item.
     */
    public function update(Request $request, ?int $id = null): RedirectResponse
    {
        if ($id) {
            $sejarah = Sejarah::findOrFail($id);
            $validated = $request->validate([
                'tahun' => ['required', 'string', 'max:50'],
                'judul' => ['required', 'string', 'max:255'],
                'deskripsi' => ['required', 'string'],
                'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            ]);

            if ($request->hasFile('gambar')) {
                $validated['gambar'] = UnggahBerkas::simpan($request->file('gambar'), 'sejarah', $sejarah->gambar);
            }

            $sejarah->update($validated);
        } else {
            // Update massal dari form daftar sejarah
            $data = $request->validate([
                'sejarah' => ['required', 'array'],
                'sejarah.*.id' => ['nullable', 'integer'],
                'sejarah.*.tahun' => ['required', 'string'],
                'sejarah.*.judul' => ['required', 'string'],
                'sejarah.*.deskripsi' => ['required', 'string'],
            ]);

            foreach ($data['sejarah'] as $index => $item) {
                if (!empty($item['id'])) {
                    Sejarah::where('id', $item['id'])->update([
                        'tahun' => $item['tahun'],
                        'judul' => $item['judul'],
                        'deskripsi' => $item['deskripsi'],
                        'urutan' => $index + 1,
                    ]);
                } else {
                    Sejarah::create([
                        'tahun' => $item['tahun'],
                        'judul' => $item['judul'],
                        'deskripsi' => $item['deskripsi'],
                        'urutan' => $index + 1,
                    ]);
                }
            }
        }

        return back()->with('success', 'Perubahan sejarah berhasil disimpan!');
    }

    /**
     * Hapus satu data linimasa sejarah.
     */
    public function destroy(int $id): RedirectResponse
    {
        $sejarah = Sejarah::findOrFail($id);
        UnggahBerkas::hapus($sejarah->gambar);
        $sejarah->delete();

        return back()->with('success', 'Data linimasa sejarah berhasil dihapus.');
    }
}
