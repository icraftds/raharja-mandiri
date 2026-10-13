<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengunjungWebsite;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PengunjungController extends Controller
{
    /**
     * Tampilkan dasbor analitik pengunjung website.
     */
    public function index(Request $request): Response
    {
        $rentang = $request->query('rentang', '7'); // 7, 30, atau semua
        $hari = in_array($rentang, ['7', '14', '30']) ? (int) $rentang : 7;

        // 1. Statistik Kartu Utama
        $sekarang = Carbon::now();
        $totalPengunjung = PengunjungWebsite::count();
        $pengunjungHariIni = PengunjungWebsite::whereDate('created_at', Carbon::today())->count();
        $pengunjungMingguIni = PengunjungWebsite::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $pengunjungBulanIni = PengunjungWebsite::where('created_at', '>=', Carbon::now()->subDays(30))->count();
        $pengunjungUnik = PengunjungWebsite::distinct('alamat_ip')->count('alamat_ip');

        // 2. Data Grafik Kunjungan Harian
        $grafikHarian = [];
        for ($i = $hari - 1; $i >= 0; $i--) {
            $tgl = Carbon::today()->subDays($i);
            $jumlah = PengunjungWebsite::whereDate('created_at', $tgl)->count();
            $grafikHarian[] = [
                'tanggal' => $tgl->format('d M'),
                'tanggal_lengkap' => $tgl->translatedFormat('l, d F Y'),
                'jumlah' => $jumlah,
            ];
        }

        // 3. Distribusi Perangkat
        $distribusiPerangkat = PengunjungWebsite::selectRaw('perangkat, count(*) as total')
            ->groupBy('perangkat')
            ->orderByDesc('total')
            ->get()
            ->map(function ($item) use ($totalPengunjung) {
                return [
                    'nama' => $item->perangkat ?: 'Desktop',
                    'total' => $item->total,
                    'persen' => $totalPengunjung > 0 ? round(($item->total / $totalPengunjung) * 100, 1) : 0,
                ];
            });

        // 4. Distribusi Browser
        $distribusiBrowser = PengunjungWebsite::selectRaw('browser, count(*) as total')
            ->groupBy('browser')
            ->orderByDesc('total')
            ->limit(5)
            ->get()
            ->map(function ($item) use ($totalPengunjung) {
                return [
                    'nama' => $item->browser ?: 'Lainnya',
                    'total' => $item->total,
                    'persen' => $totalPengunjung > 0 ? round(($item->total / $totalPengunjung) * 100, 1) : 0,
                ];
            });

        // 5. Halaman Paling Sering Dikunjungi (Top 7)
        $halamanPopuler = PengunjungWebsite::selectRaw('halaman, judul_halaman, count(*) as total')
            ->groupBy('halaman', 'judul_halaman')
            ->orderByDesc('total')
            ->limit(7)
            ->get();

        // 6. Log Kunjungan Terbaru (50 baris terbaru)
        $logKunjungan = PengunjungWebsite::latest()
            ->limit(50)
            ->get()
            ->map(function ($log) {
                return [
                    'id' => $log->id,
                    'alamat_ip' => $log->alamat_ip ? preg_replace('/\.\d+$/', '.xxx', $log->alamat_ip) : '127.0.0.1',
                    'halaman' => $log->halaman,
                    'judul_halaman' => $log->judul_halaman ?: 'Halaman Publik',
                    'perangkat' => $log->perangkat,
                    'browser' => $log->browser,
                    'sistem_operasi' => $log->sistem_operasi,
                    'waktu' => $log->created_at ? $log->created_at->translatedFormat('d M Y, H:i') : '-',
                    'waktu_relatif' => $log->created_at ? $log->created_at->diffForHumans() : '-',
                ];
            });

        return Inertia::render('admin/Pengunjung', [
            'statistik' => [
                'total' => $totalPengunjung,
                'hari_ini' => $pengunjungHariIni,
                'minggu_ini' => $pengunjungMingguIni,
                'bulan_ini' => $pengunjungBulanIni,
                'unik' => $pengunjungUnik,
            ],
            'grafik_harian' => $grafikHarian,
            'distribusi_perangkat' => $distribusiPerangkat,
            'distribusi_browser' => $distribusiBrowser,
            'halaman_populer' => $halamanPopuler,
            'log_kunjungan' => $logKunjungan,
            'filter_rentang' => $hari,
        ]);
    }

    /**
     * Bersihkan log kunjungan lama (opsional untuk pemeliharaan).
     */
    public function cleanOldLogs(Request $request)
    {
        $batasHari = 60;
        PengunjungWebsite::where('created_at', '<', Carbon::now()->subDays($batasHari))->delete();

        return back()->with('success', "Log kunjungan berusia lebih dari {$batasHari} hari berhasil dibersihkan.");
    }
}
