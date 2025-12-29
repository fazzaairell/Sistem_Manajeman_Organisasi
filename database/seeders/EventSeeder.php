<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title' => 'Workshop Teknologi AI untuk Pemula',
                'status' => 'Mendatang',
                'start_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(8)->format('Y-m-d'),
                'description' => 'Pelatihan dasar mengenai kecerdasan buatan dan penerapannya dalam kehidupan sehari-hari. Cocok untuk mahasiswa dan umum yang ingin mengenal dunia AI.',
                'penanggung_jawab' => 'Budi Santoso',
                'image' => null, // Bisa diisi path jika ada dummy image
            ],
            [
                'title' => 'Seminar Nasional: Masa Depan Digital Indonesia',
                'status' => 'Mendatang',
                'start_date' => Carbon::now()->addWeeks(2)->format('Y-m-d'),
                'end_date' => Carbon::now()->addWeeks(2)->format('Y-m-d'),
                'description' => 'Diskusi panel bersama para ahli industri teknologi tentang peluang dan tantangan transformasi digital di Indonesia menuju 2030.',
                'penanggung_jawab' => 'Siti Aminah',
                'image' => null,
            ],
            [
                'title' => 'Lomba Coding Mahasiswa Nasional',
                'status' => 'Berjalan',
                'start_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'description' => 'Kompetisi pemrograman tingkat nasional yang mempertemukan talenta-talenta muda berbakat di bidang pengembangan perangkat lunak.',
                'penanggung_jawab' => 'Rizky Pratama',
                'image' => null,
            ],
            [
                'title' => 'Bakti Sosial: Berbagi untuk Sesama',
                'status' => 'Mendatang',
                'start_date' => Carbon::now()->addMonth()->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonth()->format('Y-m-d'),
                'description' => 'Kegiatan sosial santunan ke panti asuhan dan pembagian sembako bagi warga kurang mampu di sekitar lingkungan kampus.',
                'penanggung_jawab' => 'Dewi Lestari',
                'image' => null,
            ],
            [
                'title' => 'Festival Budaya Kampus 2025',
                'status' => 'Selesai',
                'start_date' => Carbon::now()->subMonth()->format('Y-m-d'),
                'end_date' => Carbon::now()->subMonth()->addDays(2)->format('Y-m-d'),
                'description' => 'Pagelaran seni dan budaya nusantara yang dimeriahkan oleh berbagai unit kegiatan mahasiswa dan bintang tamu spesial.',
                'penanggung_jawab' => 'Ahmad Hidayat',
                'image' => null,
            ],
            [
                'title' => 'Pelatihan Public Speaking Profesional',
                'status' => 'Mendatang',
                'start_date' => Carbon::now()->addDays(10)->format('Y-m-d'),
                'end_date' => Carbon::now()->addDays(10)->format('Y-m-d'),
                'description' => 'Tingkatkan kemampuan komunikasi Anda dengan teknik public speaking yang efektif dan persuasif bersama pelatih berpengalaman.',
                'penanggung_jawab' => 'Ratna Sari',
                'image' => null,
            ],
            [
                'title' => 'Pekan Olahraga Mahasiswa',
                'status' => 'Selesai',
                'start_date' => Carbon::now()->subMonths(2)->format('Y-m-d'),
                'end_date' => Carbon::now()->subMonths(2)->addWeek()->format('Y-m-d'),
                'description' => 'Ajang kompetisi olahraga antar fakultas untuk menjunjung tinggi sportivitas dan mempererat tali persaudaraan antar mahasiswa.',
                'penanggung_jawab' => 'Eko Prasetyo',
                'image' => null,
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
