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
        Schema::create('hasil_pelatihan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pelatihan');
            $table->integer('id_sesi');
            $table->integer('id_user');
            $table->string('status_seleksi_administrasi')->nullable();
            $table->string('hasil_seleksi_administrasi')->nullable();
            $table->string('status_seleksi_tes')->nullable();
            $table->string('hasil_seleksi_tes')->nullable();
            $table->string('status_seleksi_wawancara')->nullable();
            $table->text('hasil_seleksi_wawancara')->nullable();
            $table->string('status_seleksi_daftar_ulang')->nullable();
            $table->string('hasil_seleksi_daftar_ulang')->nullable();
            $table->string('pakta_integritas')->nullable();
            $table->string('sertifikat')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('hasil_pelatihan');
    }
};
