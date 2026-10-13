<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UnggahBerkas;
use App\Http\Controllers\Controller;
use App\Models\Rekening;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RekeningController extends Controller
{
    /**
     * Tampilkan daftar rekening donasi di CMS admin.
     */
    public function index(): Response
    {
        $rekeningList = Rekening::orderBy('urutan')->get();

        return Inertia::render('admin/Rekening', [
            'bankList' => $rekeningList,
        ]);
    }

    /**
     * Tambah rekening baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_bank' => ['required', 'string', 'max:255'],
            'nomor_rekening' => ['required', 'string', 'max:100'],
            'atas_nama' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
        ], [
            'nama_bank.required' => 'Nama bank/instansi wajib diisi.',
            'nomor_rekening.required' => 'Nomor rekening wajib diisi.',
            'atas_nama.required' => 'Nama pemilik rekening wajib diisi.',
        ]);

        $urlLogo = null;
        if ($request->hasFile('logo')) {
            $urlLogo = UnggahBerkas::simpan($request->file('logo'), 'bank');
        }

        $urutanMaks = Rekening::max('urutan') ?? 0;

        Rekening::create([
            'nama_bank' => $validated['nama_bank'],
            'nomor_rekening' => $validated['nomor_rekening'],
            'atas_nama' => $validated['atas_nama'],
            'logo' => $urlLogo,
            'warna_teks' => 'text-teal-600',
            'warna_latar' => 'bg-teal-600',
            'warna_latar_muda' => 'bg-teal-50',
            'aktif' => true,
            'urutan' => $urutanMaks + 1,
        ]);

        return back()->with('success', 'Rekening baru berhasil ditambahkan!');
    }

    /**
     * Simpan pembaruan rekening (baik per item atau massal).
     */
    public function update(Request $request, ?int $id = null): RedirectResponse
    {
        if ($id) {
            $rekening = Rekening::findOrFail($id);
            $validated = $request->validate([
                'nama_bank' => ['required', 'string', 'max:255'],
                'nomor_rekening' => ['required', 'string', 'max:100'],
                'atas_nama' => ['required', 'string', 'max:255'],
                'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            ]);

            if ($request->hasFile('logo')) {
                $validated['logo'] = UnggahBerkas::simpan($request->file('logo'), 'bank', $rekening->logo);
            }

            $rekening->update($validated);
        } else {
            $data = $request->validate([
                'banks' => ['required', 'array'],
                'banks.*.id' => ['required', 'integer'],
                'banks.*.name' => ['required', 'string'],
                'banks.*.account' => ['required', 'string'],
                'banks.*.owner' => ['required', 'string'],
            ]);

            foreach ($data['banks'] as $item) {
                Rekening::where('id', $item['id'])->update([
                    'nama_bank' => $item['name'],
                    'nomor_rekening' => $item['account'],
                    'atas_nama' => $item['owner'],
                ]);
            }
        }

        return back()->with('success', 'Perubahan rekening donasi berhasil disimpan!');
    }

    /**
     * Hapus rekening donasi.
     */
    public function destroy(int $id): RedirectResponse
    {
        $rekening = Rekening::findOrFail($id);
        UnggahBerkas::hapus($rekening->logo);
        $rekening->delete();

        return back()->with('success', 'Rekening berhasil dihapus.');
    }
}
