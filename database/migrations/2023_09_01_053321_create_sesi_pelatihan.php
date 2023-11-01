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
        Schema::create('sesi_pelatihan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pelatihan');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah_peserta');
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
        Schema::dropIfExists('sesi_pelatihan');
    }
};
