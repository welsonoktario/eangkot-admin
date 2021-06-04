<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanBonusTable extends Migration
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
            $table->foreignId('driver_id')
                ->constrained()
                ->cascadeOnDelete();
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
}
