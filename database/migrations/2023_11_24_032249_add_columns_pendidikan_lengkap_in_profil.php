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
        Schema::table('profil', function (Blueprint $table) {
            $table->text('pendidikan_sd')->after('tanggal_lahir')->nullable();
            $table->text('pendidikan_smp')->after('tanggal_lahir')->nullable();
            $table->text('pendidikan_sma')->after('tanggal_lahir')->nullable();
            $table->text('pendidikan_s1')->after('tanggal_lahir')->nullable();
            $table->text('pendidikan_s2')->after('tanggal_lahir')->nullable();
            $table->text('pendidikan_s3')->after('tanggal_lahir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profil', function (Blueprint $table) {
            $table->dropColumn('pendidikan_sd');
            $table->dropColumn('pendidikan_smp');
            $table->dropColumn('pendidikan_sma');
            $table->dropColumn('pendidikan_s1');
            $table->dropColumn('pendidikan_s2');
            $table->dropColumn('pendidikan_s3');
        });
    }
};
