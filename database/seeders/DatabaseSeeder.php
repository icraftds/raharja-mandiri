<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pengaturan;
use App\Models\Sejarah;
use App\Models\Misi;
use App\Models\Pengurus;
use App\Models\Galeri;
use App\Models\Artikel;
use App\Models\Rekening;
use App\Models\KebutuhanDonasi;
use App\Models\Program;
use App\Models\Mitra;
use App\Models\PengunjungWebsite;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin Utama
        User::updateOrCreate(
            ['email' => 'admin@raharjamandiri.org'],
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('rahasia123'),
            ]
        );

        // 2. Pengaturan Website
        $pengaturanData = [
            // Hero
            ['kunci' => 'hero_lencana', 'nilai' => 'Wujudkan Harapan Mereka', 'grup' => 'hero'],
            ['kunci' => 'hero_judul_atas', 'nilai' => 'Bersama Berbagi Kasih,', 'grup' => 'hero'],
            ['kunci' => 'hero_judul_bawah', 'nilai' => 'Membangun Masa Depan', 'grup' => 'hero'],
            ['kunci' => 'hero_deskripsi', 'nilai' => 'Panti Sosial Raharja Mandiri (PSRM) berdedikasi untuk memberikan kehidupan yang lebih baik, pendidikan yang layak, dan lingkungan penuh kasih bagi anak-anak di Tanjungsari, Sumedang.', 'grup' => 'hero'],
            ['kunci' => 'hero_gambar', 'nilai' => '/assets/images/sepatu-1.jpg', 'grup' => 'hero'],
            
            // Profil Singkat
            ['kunci' => 'profil_lencana', 'nilai' => 'Tentang Kami', 'grup' => 'profil'],
            ['kunci' => 'profil_judul', 'nilai' => 'Rumah Kedua yang Penuh dengan Kehangatan', 'grup' => 'profil'],
            ['kunci' => 'profil_gambar', 'nilai' => '/assets/images/tanam-3.jpg', 'grup' => 'profil'],
            ['kunci' => 'profil_paragraf_1', 'nilai' => 'Panti Sosial Raharja Mandiri hadir di Tanjungsari, Sumedang sebagai wadah untuk merangkul anak-anak yatim piatu dan dhuafa. Kami berkomitmen memberikan lingkungan yang aman, mendidik, dan penuh kasih sayang.', 'grup' => 'profil'],
            ['kunci' => 'profil_paragraf_2', 'nilai' => 'Visi kami adalah membentuk generasi yang mandiri, cerdas, dan berakhlak mulia. Bersama kita bisa memberikan mereka kesempatan yang setara untuk meraih cita-cita.', 'grup' => 'profil'],
            ['kunci' => 'profil_angka_anak', 'nilai' => '120+', 'grup' => 'profil'],
            ['kunci' => 'profil_label_anak', 'nilai' => 'Anak Asuh', 'grup' => 'profil'],
            ['kunci' => 'profil_angka_tahun', 'nilai' => '15', 'grup' => 'profil'],
            ['kunci' => 'profil_label_tahun', 'nilai' => 'Tahun Berdiri', 'grup' => 'profil'],

            // Visi
            ['kunci' => 'visi_utama', 'nilai' => 'Menjadi lembaga yang mencetak generasi Mandiri, Cerdas, & Berakhlak Mulia serta memberikan dampak nyata bagi masyarakat luas.', 'grup' => 'visi'],

            // Kontak
            ['kunci' => 'kontak_alamat', 'nilai' => 'Tanjungsari, Kabupaten Sumedang, Jawa Barat, 45362', 'grup' => 'kontak'],
            ['kunci' => 'kontak_telepon', 'nilai' => '+62 813-2210-1618', 'grup' => 'kontak'],
            ['kunci' => 'kontak_email', 'nilai' => 'psrm@raharjamandiri.org', 'grup' => 'kontak'],
            ['kunci' => 'kontak_jam_kerja', 'nilai' => 'Senin - Minggu (08:00 - 17:00)', 'grup' => 'kontak'],
            ['kunci' => 'kontak_instagram', 'nilai' => '@psrm_raharja_mandiri', 'grup' => 'kontak'],
            ['kunci' => 'kontak_instagram_url', 'nilai' => 'https://www.instagram.com/psrm_raharja_mandiri/', 'grup' => 'kontak'],
            ['kunci' => 'kontak_maps_url', 'nilai' => 'https://maps.google.com/?q=Tanjungsari+Sumedang', 'grup' => 'kontak'],
            ['kunci' => 'whatsapp_nomor', 'nilai' => '6281322101618', 'grup' => 'kontak'],
            ['kunci' => 'whatsapp_pesan', 'nilai' => 'Halo Pengurus Panti Sosial Raharja Mandiri, saya ingin bertanya seputar donasi.', 'grup' => 'kontak'],

            // Legalitas & Footer
            ['kunci' => 'legalitas_akta', 'nilai' => 'C-1051.HT.01.02.TH 2004', 'grup' => 'legalitas'],
            ['kunci' => 'legalitas_izin', 'nilai' => '02/27.1BY.1/31.74/2019', 'grup' => 'legalitas'],
            ['kunci' => 'teks_hak_cipta', 'nilai' => '© 2026 Panti Sosial Raharja Mandiri. All rights reserved.', 'grup' => 'footer'],
        ];

        foreach ($pengaturanData as $row) {
            Pengaturan::updateOrCreate(['kunci' => $row['kunci']], $row);
        }

        // 3. Sejarah
        $sejarahData = [
            [
                'tahun' => '2009',
                'judul' => 'Awal Mula Pendirian',
                'deskripsi' => 'Panti Sosial Raharja Mandiri bermula dari sebuah rumah kecil di Tanjungsari, Sumedang. Berawal dari kepedulian terhadap anak-anak yatim piatu di lingkungan sekitar, sekelompok relawan memutuskan untuk menyewa tempat sederhana guna memberikan mereka perlindungan, pendidikan, dan kasih sayang awal.',
                'gambar' => '/assets/images/tanam-2.jpg',
                'warna_teks' => 'text-blue-600',
                'warna_latar' => 'bg-blue-600',
                'urutan' => 1,
            ],
            [
                'tahun' => '2015',
                'judul' => 'Langkah Pertama Ekspansi',
                'deskripsi' => 'Seiring berjalannya waktu dan meningkatnya kepercayaan donatur, yayasan berhasil membebaskan lahan sendiri. Pembangunan asrama permanen pertama dimulai, memungkinkan kami untuk menampung hingga 50 anak dan memberikan fasilitas hidup yang jauh lebih layak.',
                'gambar' => '/assets/images/bukber-2.jpg',
                'warna_teks' => 'text-teal-600',
                'warna_latar' => 'bg-teal-600',
                'urutan' => 2,
            ],
            [
                'tahun' => '2020',
                'judul' => 'Pengembangan Fasilitas Pendidikan',
                'deskripsi' => 'Tahun bersejarah di mana kami meresmikan ruang belajar mandiri dan perpustakaan, serta mendapatkan legalitas penuh dari kementerian. Kurikulum pembinaan karakter mulai distandarisasi secara profesional untuk menjamin masa depan cerah anak-anak.',
                'gambar' => '/assets/images/relawan-3.jpg',
                'warna_teks' => 'text-pink-600',
                'warna_latar' => 'bg-pink-600',
                'urutan' => 3,
            ],
            [
                'tahun' => 'Sekarang',
                'judul' => 'Membangun Generasi Masa Depan',
                'deskripsi' => 'Kini, dengan lebih dari ratusan anak asuh, Raharja Mandiri telah bertransformasi menjadi pusat pembinaan terpadu. Dukungan komunitas, relawan, dan mitra kerja terus mengalir tanpa henti, menjadikan yayasan ini sebuah rumah kedua yang kokoh bagi mereka.',
                'gambar' => '/assets/images/sepatu-2.jpg',
                'warna_teks' => 'text-amber-600',
                'warna_latar' => 'bg-amber-600',
                'urutan' => 4,
            ],
        ];

        foreach ($sejarahData as $row) {
            Sejarah::updateOrCreate(['tahun' => $row['tahun']], $row);
        }

        // 4. Misi
        $misiData = [
            [
                'judul' => 'Pendidikan Berkualitas',
                'deskripsi' => 'Memberikan akses pendidikan formal dan non-formal yang komprehensif untuk membekali masa depan.',
                'warna_teks' => 'text-blue-600',
                'warna_latar' => 'bg-blue-600',
                'urutan' => 1,
            ],
            [
                'judul' => 'Pembinaan Karakter & Akhlak',
                'deskripsi' => 'Membentuk kepribadian yang beriman, bertakwa, dan berlandaskan nilai moral yang kuat.',
                'warna_teks' => 'text-teal-600',
                'warna_latar' => 'bg-teal-600',
                'urutan' => 2,
            ],
            [
                'judul' => 'Kemandirian Berkelanjutan',
                'deskripsi' => 'Mengembangkan life-skill agar anak asuh tangguh dan mandiri saat terjun ke masyarakat.',
                'warna_teks' => 'text-pink-600',
                'warna_latar' => 'bg-pink-600',
                'urutan' => 3,
            ],
            [
                'judul' => 'Kesejahteraan Holistik',
                'deskripsi' => 'Menjamin kebutuhan gizi, fisik, dan kesehatan mental dalam lingkungan yang suportif.',
                'warna_teks' => 'text-amber-600',
                'warna_latar' => 'bg-amber-600',
                'urutan' => 4,
            ],
        ];

        foreach ($misiData as $row) {
            Misi::updateOrCreate(['judul' => $row['judul']], $row);
        }

        // 5. Pengurus
        $pengurusData = [
            [
                'nama' => 'H. Ahmad Sudirman, M.Ag',
                'jabatan' => 'Ketua Yayasan',
                'foto' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'urutan' => 1,
                'aktif' => true,
            ],
            [
                'nama' => 'Hj. Siti Aminah, S.Pd',
                'jabatan' => 'Sekretaris',
                'foto' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'urutan' => 2,
                'aktif' => true,
            ],
            [
                'nama' => 'Budi Santoso, S.E',
                'jabatan' => 'Bendahara',
                'foto' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'urutan' => 3,
                'aktif' => true,
            ],
            [
                'nama' => 'Ust. Rahman Hakim',
                'jabatan' => 'Kepala Pengasuh',
                'foto' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'urutan' => 4,
                'aktif' => true,
            ],
            [
                'nama' => 'Rina Marlina, Amd.Kep',
                'jabatan' => 'Divisi Kesehatan',
                'foto' => 'https://images.unsplash.com/photo-1594824432258-293674682054?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'urutan' => 5,
                'aktif' => true,
            ],
            [
                'nama' => 'Arief Hidayat, S.Kom',
                'jabatan' => 'Humas & Kemitraan',
                'foto' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                'urutan' => 6,
                'aktif' => true,
            ],
        ];

        foreach ($pengurusData as $row) {
            Pengurus::updateOrCreate(['nama' => $row['nama']], $row);
        }

        // 6. Galeri
        $galeriData = [
            ['judul' => 'Kegiatan Belajar Mengajar', 'kategori' => 'Pendidikan', 'gambar' => '/assets/images/bukber-1.jpg', 'tinggi_tampilan' => 'h-96', 'urutan' => 1],
            ['judul' => 'Kunjungan Donatur', 'kategori' => 'Kunjungan', 'gambar' => '/assets/images/relawan-1.jpg', 'tinggi_tampilan' => 'h-72', 'urutan' => 2],
            ['judul' => 'Pemeriksaan Kesehatan', 'kategori' => 'Kesehatan', 'gambar' => '/assets/images/sepatu-1.jpg', 'tinggi_tampilan' => 'h-80', 'urutan' => 3],
            ['judul' => 'Pengajian Rutin', 'kategori' => 'Keagamaan', 'gambar' => '/assets/images/tanam-1.jpg', 'tinggi_tampilan' => 'h-96', 'urutan' => 4],
            ['judul' => 'Pembagian Sembako', 'kategori' => 'Kunjungan', 'gambar' => '/assets/images/bukber-2.jpg', 'tinggi_tampilan' => 'h-72', 'urutan' => 5],
            ['judul' => 'Belajar Komputer', 'kategori' => 'Pendidikan', 'gambar' => '/assets/images/relawan-2.jpg', 'tinggi_tampilan' => 'h-80', 'urutan' => 6],
        ];

        foreach ($galeriData as $row) {
            Galeri::updateOrCreate(['judul' => $row['judul']], $row);
        }

        // 7. Artikel
        $artikelData = [
            [
                'judul' => 'Bantuan Pendidikan Semester Ganjil 2026 Telah Berhasil Disalurkan',
                'slug' => 'bantuan-pendidikan-semester-ganjil-2026',
                'kategori' => 'Pendidikan',
                'ringkasan' => 'Penyaluran dana bantuan pendidikan untuk 50 anak asuh di tingkat SD dan SMP telah berhasil dilakukan berkat partisipasi seluruh donatur. Semangat belajar mereka kini semakin menyala terang dan menjadi bekal kuat untuk menyongsong masa depan.',
                'konten' => "Perjalanan panjang Yayasan Raharja Mandiri dalam memberikan pendidikan yang layak tidaklah mudah. Banyak rintangan yang dihadapi, mulai dari keterbatasan fasilitas hingga akses lokasi yang menantang.\n\nBulan ini, kami berhasil mendistribusikan ratusan paket pendidikan berupa seragam, buku tulis, dan perlengkapan sekolah kepada lebih dari 50 anak asuh. Bantuan ini merupakan hasil kolektif dari para donatur yang dermawan.\n\nKami tidak hanya memberikan bantuan materi. Setiap akhir pekan, relawan kami terjun langsung memberikan bimbingan belajar ekstra.\n\nDengan adanya program rutin ini, kami berharap tidak ada lagi anak yang putus sekolah hanya karena alasan biaya. Mari terus bergandengan tangan membangun masa depan mereka.",
                'gambar_sampul' => '/assets/images/sepatu-2.jpg',
                'kutipan' => 'Mereka tidak meminta untuk dilahirkan dalam keterbatasan, tapi kita bisa memilih untuk memberi mereka ketidakterbatasan.',
                'penulis_kutipan' => 'H. Ahmad Sunaryo, Ketua Yayasan',
                'gambar_tambahan' => ['/assets/images/sepatu-1.jpg', '/assets/images/sepatu-3.jpg'],
                'status' => 'published',
                'unggulan' => true,
                'tanggal_publikasi' => '2026-10-10',
            ],
            [
                'judul' => 'Kunjungan Komunitas Berbagi Kasih',
                'slug' => 'kunjungan-komunitas-berbagi-kasih',
                'kategori' => 'Kunjungan',
                'ringkasan' => 'Kegiatan bermain dan belajar bersama kakak-kakak dari komunitas di hari Minggu yang ceria dan penuh makna kebersamaan.',
                'konten' => "Hari Minggu kemarin menjadi momen yang sangat membahagiakan bagi anak-anak asuh kami. Kehadiran kakak-kakak relawan dari Komunitas Berbagi Kasih membawa keceriaan yang tak ternilai harganya.\n\nAcara dimulai dengan sesi permainan edukatif yang dirancang untuk melatih kerja sama tim dan kreativitas. Tawa canda memenuhi seluruh ruangan aula.\n\nSelain bermain, komunitas ini juga membagikan bingkisan berupa alat tulis dan makanan ringan bergizi. Kehadiran figur-figur inspiratif ini memberikan motivasi tersendiri.\n\nKami sangat terbuka dengan kunjungan dari berbagai pihak yang ingin berbagi inspirasi dan kebahagiaan. Terima kasih Komunitas Berbagi Kasih!",
                'gambar_sampul' => '/assets/images/relawan-3.jpg',
                'kutipan' => 'Melihat senyum mereka adalah bayaran termahal yang pernah kami terima. Energi mereka sungguh luar biasa.',
                'penulis_kutipan' => 'Sarah, Koordinator Komunitas',
                'gambar_tambahan' => ['/assets/images/relawan-1.jpg', '/assets/images/relawan-2.jpg'],
                'status' => 'published',
                'unggulan' => false,
                'tanggal_publikasi' => '2026-10-05',
            ],
            [
                'judul' => 'Pembangunan Ruang Belajar Baru',
                'slug' => 'pembangunan-ruang-belajar-baru',
                'kategori' => 'Infrastruktur',
                'ringkasan' => 'Proses peletakan batu pertama untuk ruang belajar tambahan bagi anak-anak panti yang ditargetkan selesai akhir bulan depan.',
                'konten' => "Sejalan dengan bertambahnya jumlah anak asuh, kebutuhan akan fasilitas ruang belajar yang memadai menjadi sebuah urgensi. Kami bersyukur, mimpi itu kini mulai terwujud.\n\nPagi ini, telah dilaksanakan prosesi peletakan batu pertama untuk pembangunan dua kelas baru. Ruangan ini nantinya akan dilengkapi dengan perpustakaan mini dan fasilitas komputer dasar.\n\nProses pembangunan diperkirakan akan memakan waktu sekitar tiga bulan. Kami bekerja sama dengan kontraktor lokal yang juga memberdayakan warga sekitar panti.\n\nDukungan doa dan materi dari para dermawan masih sangat kami harapkan agar proyek ini dapat selesai tepat waktu. Mari wujudkan ruang belajar impian mereka.",
                'gambar_sampul' => '/assets/images/tanam-2.jpg',
                'kutipan' => 'Pendidikan yang baik membutuhkan lingkungan yang mendukung. Ruang baru ini adalah fondasi masa depan mereka.',
                'penulis_kutipan' => 'Ir. Budi Santoso, Donatur Utama',
                'gambar_tambahan' => ['/assets/images/tanam-1.jpg', '/assets/images/tanam-3.jpg'],
                'status' => 'published',
                'unggulan' => false,
                'tanggal_publikasi' => '2026-09-28',
            ],
            [
                'judul' => 'Cek Kesehatan Gratis Bersama RSUD',
                'slug' => 'cek-kesehatan-gratis-bersama-rsud',
                'kategori' => 'Kesehatan',
                'ringkasan' => 'Seluruh anak asuh mendapatkan pemeriksaan kesehatan komprehensif secara gratis dari tim dokter relawan.',
                'konten' => "Kesehatan adalah aspek fundamental yang seringkali terabaikan di lingkungan panti. Menyadari hal ini, kami berkolaborasi dengan RSUD setempat mengadakan cek kesehatan rutin.\n\nSebanyak 70 anak asuh mengikuti serangkaian pemeriksaan yang meliputi cek gigi, mata, THT, hingga status gizi. Beberapa anak yang membutuhkan penanganan lebih lanjut telah dirujuk.\n\nSelain pemeriksaan medis, tim dokter juga memberikan edukasi mengenai pentingnya cuci tangan dan menjaga kebersihan diri kepada anak-anak.\n\nProgram ini direncanakan akan menjadi agenda rutin setiap enam bulan sekali. Terima kasih kepada seluruh tim medis RSUD yang telah meluangkan waktunya.",
                'gambar_sampul' => '/assets/images/bukber-2.jpg',
                'kutipan' => 'Tindakan preventif jauh lebih baik. Kami senang bisa memastikan anak-anak ini tumbuh dalam kondisi fisik yang prima.',
                'penulis_kutipan' => 'Dr. Andi Pratama, Ketua Tim Medis',
                'gambar_tambahan' => ['/assets/images/bukber-1.jpg', '/assets/images/relawan-4.jpg'],
                'status' => 'published',
                'unggulan' => false,
                'tanggal_publikasi' => '2026-09-15',
            ],
        ];

        foreach ($artikelData as $row) {
            Artikel::updateOrCreate(['slug' => $row['slug']], $row);
        }

        // 8. Rekening
        $rekeningData = [
            [
                'nama_bank' => 'Bank Syariah Indonesia (BSI)',
                'nomor_rekening' => '712 345 6789',
                'atas_nama' => 'Yayasan Raharja Mandiri',
                'warna_teks' => 'text-teal-600',
                'warna_latar' => 'bg-teal-600',
                'warna_latar_muda' => 'bg-teal-50',
                'aktif' => true,
                'urutan' => 1,
            ],
            [
                'nama_bank' => 'Bank Mandiri',
                'nomor_rekening' => '130 00 1234567 8',
                'atas_nama' => 'Yayasan Raharja Mandiri',
                'warna_teks' => 'text-blue-600',
                'warna_latar' => 'bg-blue-600',
                'warna_latar_muda' => 'bg-blue-50',
                'aktif' => true,
                'urutan' => 2,
            ],
            [
                'nama_bank' => 'Bank Central Asia (BCA)',
                'nomor_rekening' => '081 234 5678',
                'atas_nama' => 'Yayasan Raharja Mandiri',
                'warna_teks' => 'text-blue-800',
                'warna_latar' => 'bg-blue-800',
                'warna_latar_muda' => 'bg-blue-100',
                'aktif' => true,
                'urutan' => 3,
            ],
        ];

        foreach ($rekeningData as $row) {
            Rekening::updateOrCreate(['nomor_rekening' => $row['nomor_rekening']], $row);
        }

        // 9. Kebutuhan Donasi
        $kebutuhanData = [
            [
                'nama_barang' => 'Sembako Utama',
                'deskripsi' => 'Beras, Minyak Goreng, Gula, dan Susu',
                'target_jumlah' => '50 Paket',
                'urgensi' => 'Mendesak',
                'warna_teks' => 'text-pink-600',
                'warna_latar' => 'bg-pink-600',
                'warna_latar_muda' => 'bg-pink-50',
                'aktif' => true,
                'urutan' => 1,
            ],
            [
                'nama_barang' => 'Pakaian Sekolah',
                'deskripsi' => 'Seragam lengkap untuk anak SD & SMP',
                'target_jumlah' => '30 Set',
                'urgensi' => 'Mendesak',
                'warna_teks' => 'text-amber-600',
                'warna_latar' => 'bg-amber-600',
                'warna_latar_muda' => 'bg-amber-50',
                'aktif' => true,
                'urutan' => 2,
            ],
            [
                'nama_barang' => 'Alat Tulis & Buku',
                'deskripsi' => 'Buku tulis, pensil, pulpen, dan alat peraga',
                'target_jumlah' => '100 Paket',
                'urgensi' => 'Rutin',
                'warna_teks' => 'text-blue-600',
                'warna_latar' => 'bg-blue-600',
                'warna_latar_muda' => 'bg-blue-50',
                'aktif' => true,
                'urutan' => 3,
            ],
            [
                'nama_barang' => 'Kebutuhan Harian',
                'deskripsi' => 'Perlengkapan mandi, sabun cuci, & kebersihan',
                'target_jumlah' => 'Bebas',
                'urgensi' => 'Rutin',
                'warna_teks' => 'text-teal-600',
                'warna_latar' => 'bg-teal-600',
                'warna_latar_muda' => 'bg-teal-50',
                'aktif' => true,
                'urutan' => 4,
            ],
        ];

        foreach ($kebutuhanData as $row) {
            KebutuhanDonasi::updateOrCreate(['nama_barang' => $row['nama_barang']], $row);
        }

        // 10. Program Unggulan
        $programData = [
            [
                'judul' => 'Pendidikan',
                'deskripsi' => 'Pembiayaan sekolah formal dan bimbingan belajar tambahan untuk memastikan masa depan cerah.',
                'warna_tema' => 'blue',
                'urutan' => 1,
                'aktif' => true,
            ],
            [
                'judul' => 'Kesehatan & Gizi',
                'deskripsi' => 'Pemenuhan kebutuhan makanan bergizi, vitamin, dan pemeriksaan kesehatan secara berkala.',
                'warna_tema' => 'teal',
                'urutan' => 2,
                'aktif' => true,
            ],
            [
                'judul' => 'Pembinaan Karakter',
                'deskripsi' => 'Kegiatan keagamaan, pelatihan soft skill, dan pengembangan bakat untuk kemandirian.',
                'warna_tema' => 'pink',
                'urutan' => 3,
                'aktif' => true,
            ],
            [
                'judul' => 'Anak Asuh & Relawan',
                'deskripsi' => 'Memberi ruang bagi masyarakat menjadi orang tua asuh atau relawan pendidik.',
                'warna_tema' => 'amber',
                'urutan' => 4,
                'aktif' => true,
            ],
        ];

        foreach ($programData as $row) {
            Program::updateOrCreate(['judul' => $row['judul']], $row);
        }

        // 11. Mitra Kerja
        $mitraData = [
            ['nama' => 'Pemerintah Daerah', 'kategori' => 'Kabupaten Sumedang', 'tipe_ikon' => 'pemda', 'urutan' => 1],
            ['nama' => 'Dinas Sosial', 'kategori' => 'Provinsi Jawa Barat', 'tipe_ikon' => 'dinsos', 'urutan' => 2],
            ['nama' => 'RS Mitra Keluarga', 'kategori' => 'Layanan Medis & Anak', 'tipe_ikon' => 'hospital', 'urutan' => 3],
            ['nama' => 'Komunitas Peduli', 'kategori' => 'Relawan & Sahabat Kasih', 'tipe_ikon' => 'community', 'urutan' => 4],
            ['nama' => 'Donatur Perusahaan', 'kategori' => 'Program CSR Mitra', 'tipe_ikon' => 'csr', 'urutan' => 5],
            ['nama' => 'BAZNAS', 'kategori' => 'Badan Amil Zakat', 'tipe_ikon' => 'baznas', 'urutan' => 6],
            ['nama' => 'Kitabisa', 'kategori' => 'Platform Solidaritas', 'tipe_ikon' => 'kitabisa', 'urutan' => 7],
            ['nama' => 'PMI Sumedang', 'kategori' => 'Palang Merah Indonesia', 'tipe_ikon' => 'pmi', 'urutan' => 8],
        ];

        foreach ($mitraData as $row) {
            Mitra::updateOrCreate(['nama' => $row['nama']], $row);
        }

        // 12. Pengunjung Website (Data Awal Analitik)
        if (PengunjungWebsite::count() === 0) {
            $halamanSampel = [
                ['halaman' => '/', 'judul' => 'Beranda Utama'],
                ['halaman' => '/tentang/visi-misi', 'judul' => 'Visi & Misi'],
                ['halaman' => '/tentang/sejarah', 'judul' => 'Sejarah Panti'],
                ['halaman' => '/tentang/kepengurusan', 'judul' => 'Struktur Kepengurusan'],
                ['halaman' => '/galeri', 'judul' => 'Galeri Kegiatan'],
                ['halaman' => '/artikel', 'judul' => 'Artikel & Berita'],
                ['halaman' => '/donasi/rekening', 'judul' => 'Rekening Donasi'],
                ['halaman' => '/donasi/kebutuhan', 'judul' => 'Kebutuhan Donasi'],
                ['halaman' => '/kontak', 'judul' => 'Hubungi Kami'],
            ];

            $perangkatList = ['Mobile', 'Desktop', 'Tablet'];
            $browserList = ['Chrome', 'Safari', 'Firefox', 'Microsoft Edge'];
            $osList = ['Android', 'iOS', 'Windows', 'macOS'];

            $dataKunjungan = [];
            // Buat sekitar 180 catatan kunjungan realistis dalam 14 hari terakhir
            for ($hari = 13; $hari >= 0; $hari--) {
                $jumlahHariIni = rand(8, 25);
                for ($k = 0; $k < $jumlahHariIni; $k++) {
                    $itemHalaman = $halamanSampel[array_rand($halamanSampel)];
                    $perangkat = $perangkatList[rand(0, 10) > 4 ? 0 : (rand(0, 5) > 4 ? 2 : 1)];
                    $browser = $browserList[array_rand($browserList)];
                    $os = $perangkat === 'Mobile' ? ($browser === 'Safari' ? 'iOS' : 'Android') : ($browser === 'Safari' ? 'macOS' : 'Windows');
                    $ip = '182.' . rand(1, 254) . '.' . rand(1, 254) . '.' . rand(1, 254);

                    $jam = rand(7, 22);
                    $menit = rand(0, 59);
                    $waktu = \Carbon\Carbon::today()->subDays($hari)->setHour($jam)->setMinute($menit);

                    $dataKunjungan[] = [
                        'alamat_ip' => $ip,
                        'halaman' => $itemHalaman['halaman'],
                        'judul_halaman' => $itemHalaman['judul'],
                        'perangkat' => $perangkat,
                        'browser' => $browser,
                        'sistem_operasi' => $os,
                        'perujuk' => rand(0, 3) > 1 ? 'https://google.com' : 'Direct',
                        'user_agent' => 'Mozilla/5.0 Sampel Seeder',
                        'created_at' => $waktu,
                        'updated_at' => $waktu,
                    ];
                }
            }

            PengunjungWebsite::insert($dataKunjungan);
        }
    }
}
