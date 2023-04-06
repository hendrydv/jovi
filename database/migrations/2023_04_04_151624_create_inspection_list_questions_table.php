<?php

use App\Models\InspectionList;
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
        Schema::create('inspection_list_question', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(InspectionList::class);
            $table->foreignIdFor(Question::class);
            $table->integer('index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_list_question');
    }
};
