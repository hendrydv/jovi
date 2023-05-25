<?php

use App\Models\Inspection;
use App\Models\SpaceMachine;
use App\Models\User;
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
        Schema::create('inspection_machines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Inspection::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(SpaceMachine::class)->nullable()->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_machines');
    }
};
