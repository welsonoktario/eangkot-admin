<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('bank_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('angkot_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->string('nama');
            $table->string('alamat');
            $table->string('nik', 16)->unique();
            $table->string('rekening')->unique()->nullable();
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
        Schema::dropIfExists('drivers');
    }
}
