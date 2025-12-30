<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    use DownloadsImages;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $announcements = [
            [
                'title' => 'Pembukaan Pendaftaran Anggota Baru 2026',
                'category' => 'Pendaftaran',
                'priority' => 'penting',
                'status' => 'published',
                'date' => Carbon::now()->format('Y-m-d'),
                'expires_at' => Carbon::now()->addMonth()->format('Y-m-d'),
                'description' => 'Pendaftaran anggota baru gelombang kedua periode 2026 telah resmi dibuka! Buruan daftar sebelum kuota penuh.',
                'content' => 'Pendaftaran anggota baru gelombang kedua telah dibuka! Segera daftarkan dirimu sebelum tanggal 20 Januari 2026. Jangan lewatkan kesempatan untuk bergabung dengan komunitas kami yang dinamis dan berkembang bersama ratusan anggota lainnya. Dapatkan berbagai benefit menarik dan kesempatan networking yang luas.',
                'author' => 'Tim Rekrutmen',
                'image_url' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=800&q=80',
            ],
            [
                'title' => 'Perubahan Jadwal UTBK Beasiswa Internal',
                'category' => 'Akademik',
                'priority' => 'urgent',
                'status' => 'published',
                'date' => Carbon::now()->subDays(3)->format('Y-m-d'),
                'expires_at' => Carbon::now()->addWeeks(2)->format('Y-m-d'),
                'description' => 'PENTING! Perubahan jadwal pelaksanaan UTBK untuk seleksi beasiswa internal. Harap cek jadwal baru Anda.',
                'content' => 'Pengumuman perubahan jadwal Ujian Tulis Berbasis Komputer (UTBK) untuk seleksi beasiswa internal. Harap semua peserta memeriksa jadwal terbaru di dashboard masing-masing. Ujian akan dilaksanakan pada tanggal 15 Januari 2026 pukul 08:00 WIB. Pastikan Anda datang 30 menit sebelum ujian dimulai.',
                'author' => 'Panitia Beasiswa',
                'image_url' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800&q=80',
            ],
            [
                'title' => 'Tim Garuda Muda Juara 1 Hackathon Nasional 2025',
                'category' => 'Prestasi',
                'priority' => 'normal',
                'status' => 'published',
                'date' => Carbon::now()->subWeek()->format('Y-m-d'),
                'expires_at' => null,
                'description' => 'Selamat! Tim Garuda Muda berhasil meraih juara pertama dalam kompetisi hackathon bergengsi tingkat nasional.',
                'content' => 'Selamat kepada Tim "Garuda Muda" yang berhasil meraih Juara 1 dalam Hackathon Nasional 2025 dengan proyek inovatif mereka di bidang AI untuk pendidikan. Tim berhasil mengalahkan 150 tim dari seluruh Indonesia. Teruslah berkarya dan membanggakan nama organisasi! Apresiasi untuk semua tim yang telah berpartisipasi.',
                'author' => 'Humas Organisasi',
                'image_url' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=800&q=80',
            ],
            [
                'title' => 'Pemeliharaan Sistem - Maintenance Schedule',
                'category' => 'Teknis',
                'priority' => 'penting',
                'status' => 'published',
                'date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'expires_at' => Carbon::now()->addWeeks(1)->format('Y-m-d'),
                'description' => 'Jadwal pemeliharaan sistem yang akan dilaksanakan pada akhir pekan ini. Sistem tidak dapat diakses sementara.',
                'content' => 'Akan dilaksanakan pemeliharaan sistem pada hari Sabtu, 10 Januari 2026 pukul 23:00 - 02:00 WIB. Selama periode ini, sistem mungkin tidak dapat diakses. Mohon maaf atas ketidaknyamanan yang ditimbulkan. Pastikan untuk menyimpan pekerjaan Anda sebelum waktu maintenance.',
                'author' => 'Tim IT',
                'image_url' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&q=80',
            ],
            [
                'title' => 'Pengambilan Sertifikat Workshop AI for Beginners',
                'category' => 'Sertifikat',
                'priority' => 'normal',
                'status' => 'published',
                'date' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'expires_at' => Carbon::now()->addMonth()->format('Y-m-d'),
                'description' => 'Sertifikat peserta Workshop AI telah siap dan dapat diambil di sekretariat pada jam kerja.',
                'content' => 'Pengambilan sertifikat peserta Workshop "AI for Beginners" dapat dilakukan di sekretariat mulai hari ini jam 09:00 - 15:00 WIB hari Senin-Jumat. Jangan lupa membawa KTP dan bukti pendaftaran. Untuk yang tidak bisa hadir, sertifikat dapat diambil oleh kuasa dengan membawa surat kuasa dan fotokopi KTP.',
                'author' => 'Panitia Workshop',
                'image_url' => 'https://images.unsplash.com/photo-1591115765373-5207764f72e7?w=800&q=80',
            ],
            [
                'title' => 'Webinar Gratis: Digital Marketing Strategy 2026',
                'category' => 'Event',
                'priority' => 'penting',
                'status' => 'published',
                'date' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'expires_at' => Carbon::now()->addWeeks(2)->format('Y-m-d'),
                'description' => 'Ikuti webinar gratis tentang strategi digital marketing terkini. Daftar sekarang, tempat terbatas!',
                'content' => 'Kami mengundang seluruh anggota untuk mengikuti webinar gratis tentang Digital Marketing Strategy 2026 yang akan dilaksanakan pada tanggal 12 Januari 2026 pukul 19:00 WIB via Zoom. Pembicara: praktisi digital marketing berpengalaman 10+ tahun. Daftar sekarang karena tempat terbatas hanya 100 peserta!',
                'author' => 'Divisi Pelatihan',
                'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&q=80',
            ],
            [
                'title' => 'Rapat Koordinasi Pengurus - Agenda Penting',
                'category' => 'Umum',
                'priority' => 'urgent',
                'status' => 'published',
                'date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'expires_at' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'description' => 'Rapat koordinasi untuk seluruh pengurus. Kehadiran wajib, agenda penting terkait program kerja 2026.',
                'content' => 'Kepada seluruh pengurus organisasi, dimohon untuk hadir dalam rapat koordinasi pada Kamis, 2 Januari 2026 pukul 16:00 WIB di ruang rapat. Agenda: evaluasi program 2025 dan perencanaan program kerja 2026. Kehadiran WAJIB. Konfirmasi kehadiran ke sekretaris paling lambat H-1.',
                'author' => 'Ketua Organisasi',
                'image_url' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=800&q=80',
            ],
            [
                'title' => 'Lomba Fotografi Tema "Kampus Kita"',
                'category' => 'Event',
                'priority' => 'normal',
                'status' => 'published',
                'date' => Carbon::now()->format('Y-m-d'),
                'expires_at' => Carbon::now()->addMonth()->format('Y-m-d'),
                'description' => 'Ikuti lomba fotografi dengan hadiah total 10 juta rupiah! Tunjukkan kreativitasmu.',
                'content' => 'Lomba Fotografi bertema "Kampus Kita" dibuka untuk seluruh mahasiswa. Hadiah: Juara 1 (5jt), Juara 2 (3jt), Juara 3 (2jt). Pendaftaran hingga 30 Januari 2026. Kirim karya terbaikmu maksimal 3 foto. Detail lengkap dan cara pendaftaran cek di website kami.',
                'author' => 'Divisi Seni & Budaya',
                'image_url' => 'https://images.unsplash.com/photo-1452587925148-ce544e77e70d?w=800&q=80',
            ],
        ];

        $this->command->info('Downloading images untuk Announcements...');

        foreach ($announcements as $announcementData) {
            // Download gambar dan dapatkan path lokal
            $imageUrl = $announcementData['image_url'];
            $imagePath = $this->downloadImage($imageUrl, 'announcements');

            // Skip jika download gagal
            if (!$imagePath) {
                $this->command->warn("Skip announcement: {$announcementData['title']} (gagal download gambar)");
                continue;
            }

            // Ganti image_url dengan image path lokal
            unset($announcementData['image_url']);
            $announcementData['image'] = $imagePath;

            // Simpan ke database
            Announcement::create($announcementData);
        }

        $this->command->info('Seeding Announcements selesai!');
    }
}
