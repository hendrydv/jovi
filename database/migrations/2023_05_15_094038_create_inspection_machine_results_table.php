<?php

use App\Models\SpaceMachine;
use App\Models\InspectionMachineResult;
use App\Models\Question;
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
        Schema::create('inspection_machine_results', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Question::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(SpaceMachine::class)->constrained()->cascadeOnDelete();
            $table->enum('result', InspectionMachineResult::RESULT_TYPES);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_machine_results');
    }
};
