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
       Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->string('image')->nullable(); // Foto Event
        $table->string('title'); // Judul Event
        $table->string('status'); // Contoh: 'Mendatang', 'Selesai'
        $table->date('start_date');
        $table->date('end_date');
        $table->text('description');
        $table->string('penanggung_jawab'); 
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
