<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kriteria', function (Blueprint $table) {
            $table->id('id_kriteria');
            $table->string('kode_kriteria')->unique(); 
            $table->string('nama_kriteria');            
            $table->decimal('nilai_ideal', 5, 2);       
            $table->boolean('faktor_inti');             
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kriteria');
    }
};
