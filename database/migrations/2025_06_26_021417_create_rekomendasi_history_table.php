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
        Schema::create('rekomendasi_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ✅ FK ke users
            $table->json('filter');
            $table->timestamps();

            // Tambahkan relasi foreign key
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade'); // Optional: delete history saat user dihapus
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekomendasi_history');
    }
};

