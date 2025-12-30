<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleries = [
            [
                'title' => 'Workshop AI & Machine Learning 2025',
                'image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?w=800&q=80',
            ],
            [
                'title' => 'Seminar Nasional Teknologi Digital',
                'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80',
            ],
            [
                'title' => 'Lomba Coding Competition 2025',
                'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800&q=80',
            ],
            [
                'title' => 'Kegiatan Bakti Sosial di Desa',
                'image' => 'https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=800&q=80',
            ],
            [
                'title' => 'Festival Budaya Kampus 2025',
                'image' => 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?w=800&q=80',
            ],
            [
                'title' => 'Pelatihan Public Speaking',
                'image' => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?w=800&q=80',
            ],
            [
                'title' => 'Rapat Koordinasi Pengurus',
                'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&q=80',
            ],
            [
                'title' => 'Study Tour ke Perusahaan Startup',
                'image' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=800&q=80',
            ],
            [
                'title' => 'Pelantikan Pengurus Baru 2026',
                'image' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?w=800&q=80',
            ],
            [
                'title' => 'Gathering & Team Building',
                'image' => 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=800&q=80',
            ],
            [
                'title' => 'Pekan Olahraga Bersama',
                'image' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?w=800&q=80',
            ],
            [
                'title' => 'Webinar Digital Marketing Strategy',
                'image' => 'https://images.unsplash.com/photo-1591115765373-5207764f72e7?w=800&q=80',
            ],
        ];

        foreach ($galleries as $gallery) {
            Gallery::create($gallery);
        }
    }
}
