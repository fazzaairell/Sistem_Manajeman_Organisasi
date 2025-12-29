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
                'description' => 'Pembukaan pendaftaran anggota baru untuk periode 2026.',
                'content' => 'Pendaftaran anggota baru gelombang kedua telah dibuka! Segera daftarkan dirimu sebelum tanggal 20 Januari 2026. Jangan lewatkan kesempatan untuk bergabung dengan komunitas kami yang dinamis.',
                'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'date' => Carbon::now()->subDays(3)->format('Y-m-d'),
                'description' => 'Perubahan jadwal UTBK seleksi beasiswa internal.',
                'content' => 'Pengumuman perubahan jadwal Ujian Tulis Berbasis Komputer (UTBK) untuk seleksi beasiswa internal. Harap semua peserta memeriksa jadwal terbaru di dashboard masing-masing.',
                'image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'date' => Carbon::now()->subWeek()->format('Y-m-d'),
                'description' => 'Tim Garuda Muda meraih Juara 1 Hackathon Nasional.',
                'content' => 'Selamat kepada Tim "Garuda Muda" yang berhasil meraih Juara 1 dalam Hackathon Nasional 2025. Teruslah berkarya dan membanggakan nama organisasi!',
                'image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'description' => 'Jadwal pemeliharaan sistem akhir pekan ini.',
                'content' => 'Akan dilaksanakan pemeliharaan sistem pada hari Sabtu, 10 Januari 2026 pukul 23:00 - 02:00 WIB. Mohon maaf atas ketidaknyamanan yang ditimbulkan.',
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=800',
            ],
            [
                'date' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'description' => 'Pengambilan sertifikat workshop AI telah dibuka.',
                'content' => 'Pengambilan sertifikat peserta Workshop "AI for Beginners" dapat dilakukan di sekretariat mulai hari ini jam 09:00 - 15:00 WIB.',
                'image' => 'https://images.unsplash.com/photo-1591115765373-5207764f72e7?auto=format&fit=crop&q=80&w=800',
            ],
        ];

        foreach ($announcements as $announcement) {
            Announcement::create($announcement);
        }
    }
}
