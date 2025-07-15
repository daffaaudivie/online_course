<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekomendasi_detail', function (Blueprint $table) {
            $table->id();

            // FK ke rekomendasi_history
            $table->foreignId('rekomendasi_history_id')
                  ->constrained('rekomendasi_history')
                  ->onDelete('cascade');

            // FK ke online_course (pakai manual jika nama tabelnya bukan 'online_courses')
            $table->unsignedBigInteger('online_course_id');
            $table->foreign('online_course_id')
                  ->references('id')
                  ->on('online_course') // Ubah ke 'online_courses' jika itu nama tabelmu
                  ->onDelete('cascade');

            $table->double('skor', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekomendasi_detail');
    }
};


