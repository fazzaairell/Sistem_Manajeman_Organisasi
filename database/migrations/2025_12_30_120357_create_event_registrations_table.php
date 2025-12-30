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
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('reason')->nullable(); // Alasan mendaftar atau alasan reject
            $table->text('admin_notes')->nullable(); // Catatan dari admin
            $table->timestamp('registered_at')->useCurrent();
            $table->timestamp('reviewed_at')->nullable(); // Kapan di-review admin
            $table->foreignId('reviewed_by')->nullable()->constrained('users'); // Admin yang review
            $table->timestamps();

            // Unique constraint: user hanya bisa daftar sekali per event
            $table->unique(['event_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
