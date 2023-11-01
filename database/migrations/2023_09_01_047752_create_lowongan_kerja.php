<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lowongan_kerja', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kategori');
            $table->integer('id_perusahaan')->nullable();
            $table->string('judul');
            $table->string('gambar')->nullable();
            $table->integer('gaji_min')->nullable();
            $table->integer('gaji_max')->nullable();
            $table->string('tipe_pekerjaan');
            $table->text('deskripsi')->nullable();
            $table->integer('dilihat')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lowongan_kerja');
    }
};
