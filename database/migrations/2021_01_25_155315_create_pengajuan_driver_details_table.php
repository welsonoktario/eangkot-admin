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
        Schema::create('pengajuan_driver_details', function (Blueprint $table) {
            $table->unsignedBigInteger('pengajuan_driver_id')->primary();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->string('nik', 16);
            $table->string('alamat');
            $table->string('rekening')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan_driver_details');
    }
};
