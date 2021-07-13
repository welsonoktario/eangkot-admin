<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('driver_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->multiPoint('rute');
            $table->integer('penumpang')->default(1);
            $table->enum('status', ['Pending', 'Diterima', 'Ditolak', 'Aktif', 'Selesai', 'Batal'])
                ->default('Pending');
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
        Schema::dropIfExists('pesanans');
    }
}
