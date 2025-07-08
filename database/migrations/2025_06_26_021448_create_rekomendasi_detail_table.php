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
            $table->foreignId('rekomendasi_history_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('online_course_id');
            $table->float('skor');
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
