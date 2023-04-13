<?php

use App\Models\Inspection;
use App\Models\InspectionResult;
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
    public function up(): void
    {
        Schema::create('inspection_results', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Question::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Inspection::class)->constrained()->cascadeOnDelete();
            $table->enum('result', InspectionResult::RESULT_TYPES);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_results');
    }
};
