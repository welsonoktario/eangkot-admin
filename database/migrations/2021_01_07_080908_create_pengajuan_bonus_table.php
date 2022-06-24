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
        Schema::create('pengajuan_bonus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id');
            $table->enum('status', ['Pending', 'Diterima', 'Ditolak']);
            $table->dateTime('tanggal');
            $table->integer('nominal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan_bonus');
    }
};
