<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<< HEAD
return new class extends Migration
=======
class CreateFavoritsTable extends Migration
>>>>>>> 862cba1 (Initial commit)
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorits', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('trayek_id');
            $table->string('alamat');
            $table->point('tujuan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorits');
    }
};
