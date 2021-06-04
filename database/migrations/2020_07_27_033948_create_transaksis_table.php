<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pesanan_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('promo_id')
                ->constrained()
                ->on('promos')
                ->cascadeOnDelete();
            $table->dateTime('tanggal')->useCurrent();
            $table->integer('ongkos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
