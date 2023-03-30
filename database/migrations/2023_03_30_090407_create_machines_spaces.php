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
        Schema::create('machines_spaces', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('space_id');
            $table->foreign('space_id')->references('id')->on('spaces');

            $table->unsignedBigInteger('machine_id');
            $table->foreign('machine_id')->references('id')->on('machines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('machines_spaces');
    }
};
