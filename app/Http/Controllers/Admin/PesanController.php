<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PesanKontak;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PesanController extends Controller
{
    /**
     * Tampilkan kotak masuk pesan dari formulir kontak.
     */
    public function index(): Response
    {
        $pesanList = PesanKontak::latest()->get();

        return Inertia::render('admin/Pesan', [
            'messageList' => $pesanList,
        ]);
    }

    /**
     * Tandai pesan sebagai sudah dibaca.
     */
    public function markAsRead(int $id): RedirectResponse
    {
        $pesan = PesanKontak::findOrFail($id);
        $pesan->update(['sudah_dibaca' => true]);

        return back()->with('success', 'Pesan telah ditandai sudah dibaca.');
    }

    /**
     * Hapus pesan masuk.
     */
    public function destroy(int $id): RedirectResponse
    {
        $pesan = PesanKontak::findOrFail($id);
        $pesan->delete();

        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}
