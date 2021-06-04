<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAngkotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angkots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trayek_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('no_kendaraan', 10);
            $table->boolean('aktif')->default(false);
            $table->point('lokasi')->nullable();
            $table->string('gambar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('angkots');
    }
}
