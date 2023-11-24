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
        Schema::table('sesi_pelatihan', function (Blueprint $table) {
            $table->string('sesi_dibuka')->after('jumlah_peserta')->nullable();
            $table->string('sesi_ditutup')->after('jumlah_peserta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sesi_pelatihan', function (Blueprint $table) {
            $table->dropColumn('sesi_dibuka');
            $table->dropColumn('sesi_ditutup');
        });
    }
};
