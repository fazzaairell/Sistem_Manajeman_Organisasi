<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $announcements = [
            [
                'date' => Carbon::now()->format('Y-m-d'),
                'content' => 'Pendaftaran anggota baru gelombang kedua telah dibuka! Segera daftarkan dirimu sebelum tanggal 20 Januari 2026. Jangan lewatkan kesempatan untuk bergabung dengan komunitas kami yang dinamis.',
                'image' => '', // Placeholder image handled by frontend or factory if needed
            ],
            [
                'date' => Carbon::now()->subDays(3)->format('Y-m-d'),
                'content' => 'Pengumuman perubahan jadwal Ujian Tulis Berbasis Komputer (UTBK) untuk seleksi beasiswa internal. Harap semua peserta memeriksa jadwal terbaru di dashboard masing-masing.',
                'image' => '',
            ],
            [
                'date' => Carbon::now()->subWeek()->format('Y-m-d'),
                'content' => 'Selamat kepada Tim "Garuda Muda" yang berhasil meraih Juara 1 dalam Hackathon Nasional 2025. Teruslah berkarya dan membanggakan nama organisasi!',
                'image' => '',
            ],
            [
                'date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'content' => 'Akan dilaksanakan pemeliharaan sistem pada hari Sabtu, 10 Januari 2026 pukul 23:00 - 02:00 WIB. Mohon maaf atas ketidaknyamanan yang ditimbulkan.',
                'image' => '',
            ],
            [
                'date' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'content' => 'Pengambilan sertifikat peserta Workshop "AI for Beginners" dapat dilakukan di sekretariat mulai hari ini jam 09:00 - 15:00 WIB.',
                'image' => '',
            ],
        ];

        foreach ($announcements as $announcement) {
            Announcement::create($announcement);
        }
    }
}
