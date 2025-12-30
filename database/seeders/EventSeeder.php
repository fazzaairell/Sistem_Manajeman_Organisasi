<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    use DownloadsImages;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Workshop Teknologi AI untuk Pemula',
                'status' => 'mendatang',
                'start_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(8)->format('Y-m-d'),
                'description' => 'Pelatihan dasar mengenai kecerdasan buatan dan penerapannya dalam kehidupan sehari-hari. Cocok untuk mahasiswa dan umum yang ingin mengenal dunia AI.',
                'penanggung_jawab' => 'Budi Santoso',
                'image_url' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&q=80',
            ],
            [
                'title' => 'Seminar Nasional: Masa Depan Digital Indonesia',
                'status' => 'mendatang',
                'start_date' => Carbon::now()->addWeeks(2)->format('Y-m-d'),
                'end_date' => Carbon::now()->addWeeks(2)->format('Y-m-d'),
                'description' => 'Diskusi panel bersama para ahli industri teknologi tentang peluang dan tantangan transformasi digital di Indonesia menuju 2030.',
                'penanggung_jawab' => 'Siti Aminah',
                'image_url' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80',
            ],
            [
                'title' => 'Lomba Coding Mahasiswa Nasional',
                'status' => 'aktif',
                'start_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'description' => 'Kompetisi pemrograman tingkat nasional yang mempertemukan talenta-talenta muda berbakat di bidang pengembangan perangkat lunak.',
                'penanggung_jawab' => 'Rizky Pratama',
                'image_url' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800&q=80',
            ],
            [
                'title' => 'Bakti Sosial: Berbagi untuk Sesama',
                'status' => 'mendatang',
                'start_date' => Carbon::now()->addMonth()->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonth()->format('Y-m-d'),
                'description' => 'Kegiatan sosial santunan ke panti asuhan dan pembagian sembako bagi warga kurang mampu di sekitar lingkungan kampus.',
                'penanggung_jawab' => 'Dewi Lestari',
                'image_url' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=800&q=80',
            ],
            [
                'title' => 'Festival Budaya Kampus 2025',
                'status' => 'selesai',
                'start_date' => Carbon::now()->subMonth()->format('Y-m-d'),
                'end_date' => Carbon::now()->subMonth()->addDays(2)->format('Y-m-d'),
                'description' => 'Pagelaran seni dan budaya nusantara yang dimeriahkan oleh berbagai unit kegiatan mahasiswa dan bintang tamu spesial.',
                'penanggung_jawab' => 'Ahmad Hidayat',
                'image_url' => 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?w=800&q=80',
            ],
            [
                'title' => 'Pelatihan Public Speaking Profesional',
                'status' => 'mendatang',
                'start_date' => Carbon::now()->addDays(10)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(10)->format('Y-m-d'),
                'description' => 'Tingkatkan kemampuan komunikasi Anda dengan teknik public speaking yang efektif dan persuasif bersama pelatih berpengalaman.',
                'penanggung_jawab' => 'Ratna Sari',
                'image_url' => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=800&q=80',
            ],
            [
                'title' => 'Pekan Olahraga Mahasiswa',
                'status' => 'selesai',
                'start_date' => Carbon::now()->subMonths(2)->format('Y-m-d'),
                'end_date' => Carbon::now()->subMonths(2)->addWeek()->format('Y-m-d'),
                'description' => 'Ajang kompetisi olahraga antar fakultas untuk menjunjung tinggi sportivitas dan mempererat tali persaudaraan antar mahasiswa.',
                'penanggung_jawab' => 'Eko Prasetyo',
                'image_url' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=800&q=80',
            ],
        ];

        $this->command->info('Downloading images untuk Events...');

        foreach ($events as $eventData) {
            // Download gambar dan dapatkan path lokal
            $imageUrl = $eventData['image_url'];
            $imagePath = $this->downloadImage($imageUrl, 'events');

            // Skip jika download gagal
            if (!$imagePath) {
                $this->command->warn("Skip event: {$eventData['title']} (gagal download gambar)");
                continue;
            }

            // Ganti image_url dengan image path lokal
            unset($eventData['image_url']);
            $eventData['image'] = $imagePath;

            // Simpan ke database
            Event::create($eventData);
        }

        $this->command->info('Seeding Events selesai!');
    }
}
