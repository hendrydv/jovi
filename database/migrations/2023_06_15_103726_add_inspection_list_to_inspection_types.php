<?php

use App\Models\InspectionList;
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
        Schema::table('inspection_types', function (Blueprint $table) {
            $table->foreignIdFor(InspectionList::class)->nullable()->constrained()->nullOnDelete();
            $table->unique('inspection_list_id', 'inspection_list_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inspection_types', function (Blueprint $table) {
            $table->dropForeign('inspection_types_inspection_list_id_foreign');
            $table->dropUnique('inspection_list_id_unique');
            $table->dropColumn('inspection_list_id');
        });
    }
};
