<?php

use App\Models\Brand;
use App\Models\Kind;
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
        Schema::table('machines', function (Blueprint $table) {
            $table->foreignIdFor(Kind::class)->constrained();
            $table->foreignIdFor(Brand::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('machine', function (Blueprint $table) {
            $table->dropForeign(['kind_id', 'brand_id']);
            $table->dropCoumn(['kind_id', 'brand_id']);
        });
    }
};
