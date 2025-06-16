<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id('id_favorite');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('id_online_course');
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_online_course')->references('id_online_course')->on('online_course')->onDelete('cascade');

            // Unique combination to prevent duplicate favorites
            $table->unique(['user_id', 'id_online_course']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('favorites');
    }
}

