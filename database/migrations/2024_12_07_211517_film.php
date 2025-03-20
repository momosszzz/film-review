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
        Schema::create('film', function (Blueprint $table) {
            $table->increments('id_film');
            $table->string('nama_film')->nullable();
            $table->text('trailer')->nullable();
            $table->text('gambar_film')->nullable();
            $table->text('deskripsi')->nullable();
            $table->enum('for_usia',['anak','remaja','dewasa']);
            $table->unsignedBigInteger('genre')->nullable();
            $table->unsignedBigInteger('tahun')->nullable();
            $table->unsignedBigInteger('negara')->nullable();
            $table->char('rating')->nullable();
            $table->unsignedBigInteger('durasi')->nullable();
            $table->timestamps();
        });

        Schema::create('genre', function (Blueprint $table) {
            $table->increments('id_genre');
            $table->string('nama_genre');
            $table->timestamps();

        });

        Schema::create('tahun',function(Blueprint $table){
            $table->increments('id_tahun');
            $table->year('tahun_rilis');
            $table->timestamps();

        });

        Schema::create('negara', function (Blueprint $table) {
            $table->increments('id_negara');
            $table->string('nama_negara');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('film');
        Schema::dropIfExists('genre');
        Schema::dropIfExists('tahun');
        Schema::dropIfExists('negara');
    }
};
