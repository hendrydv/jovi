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
    public function up(): void
    {
        Schema::table('machines', function (Blueprint $table) {
            $table->foreignIdFor(InspectionList::class)->nullable()->constrained()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('machines', function (Blueprint $table) {
            $table->dropForeign('machines_inspection_list_id_foreign');
            $table->dropColumn('inspection_list_id');
        });
    }
};
