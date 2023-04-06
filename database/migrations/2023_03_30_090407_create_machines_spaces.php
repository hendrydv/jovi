<?php

use App\Models\Machine;
use App\Models\Space;
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
            $table->foreignIdFor(Space::class);
            $table->foreignIdFor(Machine::class);
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
