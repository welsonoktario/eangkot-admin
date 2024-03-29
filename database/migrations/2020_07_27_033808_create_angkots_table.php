<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angkots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trayek_id');
            $table->string('no_kendaraan', 10)->unique();
            $table->boolean('aktif')->default(false);
            $table->point('lokasi')->nullable();
            $table->string('doc_id', 20)->nullable();
            $table->timestamps();
            $table->softDeletes();
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
};
