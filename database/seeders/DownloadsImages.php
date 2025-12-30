<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait DownloadsImages
{
    /**
     * Download gambar dari URL dan simpan ke storage
     *
     * @param string $url URL gambar yang akan didownload
     * @param string $folder Folder tujuan di storage (contoh: 'events', 'announcements')
     * @return string|null Path relatif gambar di storage atau null jika gagal
     */
    protected function downloadImage(string $url, string $folder): ?string
    {
        try {
            // Download gambar dari URL
            $response = Http::timeout(30)->get($url);

            // Cek apakah request berhasil
            if (!$response->successful()) {
                $this->command->warn("Gagal download gambar dari: {$url}");
                return null;
            }

            // Ambil content gambar
            $imageContent = $response->body();

            // Deteksi extension dari URL atau content-type
            $extension = $this->getImageExtension($url, $response->header('Content-Type'));

            // Generate nama file unik
            $timestamp = time();
            $hash = substr(md5($url), 0, 6);
            $filename = "{$timestamp}_{$hash}.{$extension}";

            // Path lengkap di storage
            $path = "{$folder}/{$filename}";

            // Simpan ke storage disk 'public'
            Storage::disk('public')->put($path, $imageContent);

            $this->command->info("✓ Berhasil download: {$filename}");

            return $path;
        } catch (\Exception $e) {
            $this->command->error("Error download gambar dari {$url}: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Deteksi extension gambar dari URL atau Content-Type
     *
     * @param string $url
     * @param string|null $contentType
     * @return string
     */
    private function getImageExtension(string $url, ?string $contentType): string
    {
        // Coba ambil extension dari URL
        $urlExtension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
        
        if (in_array(strtolower($urlExtension), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])) {
            return strtolower($urlExtension);
        }

        // Fallback ke Content-Type
        if ($contentType) {
            $mimeToExtension = [
                'image/jpeg' => 'jpg',
                'image/jpg' => 'jpg',
                'image/png' => 'png',
                'image/gif' => 'gif',
                'image/webp' => 'webp',
                'image/svg+xml' => 'svg',
            ];

            foreach ($mimeToExtension as $mime => $ext) {
                if (str_contains($contentType, $mime)) {
                    return $ext;
                }
            }
        }

        // Default ke jpg
        return 'jpg';
    }
}
