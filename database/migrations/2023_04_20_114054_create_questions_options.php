<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Question;
use App\Models\Option;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('questions_options', function (Blueprint $table) {
            $table->foreignIdFor(Question::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Option::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions_options');
    }
};
