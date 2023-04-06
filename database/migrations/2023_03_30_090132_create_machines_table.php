<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\InspectionList;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('type');
            $table->string('image');
            $table->string('supplier');
            $table->foreignIdFor(InspectionList::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('machines');
    }
};
