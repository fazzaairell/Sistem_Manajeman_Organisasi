<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul pengumuman
            $table->string('category'); // Kategori: Akademik, Event, Umum, Prestasi, dll
            $table->enum('priority', ['normal', 'penting', 'urgent'])->default('normal'); // Prioritas
            $table->enum('status', ['draft', 'published'])->default('published'); // Status publikasi
            $table->date('date'); // Tanggal pengumuman
            $table->date('expires_at')->nullable(); // Tanggal kadaluarsa
            $table->text('description'); // Ringkasan/deskripsi singkat
            $table->text('content'); // Isi lengkap pengumuman
            $table->string('author'); // Nama pembuat/penulis
            $table->string('image')->nullable(); // Gambar pengumuman
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
