<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanDriverDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_driver_details', function (Blueprint $table) {
            $table->foreignId('pengajuan_driver_id')
                ->primary()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('bank_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
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
}
