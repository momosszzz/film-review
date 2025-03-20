<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('komentar', function (Blueprint $table) {
            $table->id('id_komentar');
            $table->unsignedInteger('id_film');
            $table->unsignedInteger('id_user');
            $table->enum('rating_user',['1','2','3','4','5']);
            $table->text('komentar')->nullable();
            $table->timestamps();
            
            $table->foreign('id_film')->references('id_film')->on('film')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('komentar');
    }
}; 