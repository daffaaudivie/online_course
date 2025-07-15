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
        Schema::create('rekomendasi_detail', function (Blueprint $table) {
            $table->id();

            // FK ke rekomendasi_history
            $table->foreignId('rekomendasi_history_id')
                  ->constrained('rekomendasi_history')
                  ->onDelete('cascade');

            // FK ke online_course
            $table->foreignId('online_course_id')
                  ->constrained('online_course')
                  ->onDelete('cascade');

            // skor rekomendasi
            $table->double('skor', 8, 2);

            // Optional: track waktu
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekomendasi_detail');
    }
};

