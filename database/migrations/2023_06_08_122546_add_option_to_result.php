<?php

use App\Models\InspectionMachineResult;
use App\Models\Option;
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
        Schema::table('inspection_machine_results', function (Blueprint $table) {
            $table->foreignIdFor(Option::class)->nullable()->constrained()->nullOnDelete();
//            $table->string('option_id')->nullable()->after('result');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inspection_machine_results', function (Blueprint $table) {
            $table->dropColumn('option_id');
        });
    }
};
