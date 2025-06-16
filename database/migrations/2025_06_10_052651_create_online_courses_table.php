<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('online_course', function (Blueprint $table) {
            $table->id('id_online_course');
            $table->string('link');
            $table->string('deskripsi');
            $table->string('judul');
            $table->string('kategori');
            $table->enum('tipe', ['Free', 'Specialization', 'Project', 'Professional Certificate']);
            $table->decimal('harga', 10, 2);
            $table->string('bahasa');
            $table->string('level'); 
            $table->float('rating', 3, 2);
            $table->unsignedBigInteger('jumlah_viewers');
            $table->string('durasi'); 
            $table->string('platform');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('online_course');
    }
};
