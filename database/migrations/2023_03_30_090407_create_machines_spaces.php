<?php

use App\Models\Machine;
use App\Models\Space;
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
        Schema::create('machines_spaces', function (Blueprint $table) {
            $table->foreignIdFor(Space::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Machine::class)->constrained()->cascadeOnDelete();
            $table->bigInteger('inventory_number');
            $table->primary(['space_id', 'inventory_number']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('machines_spaces');
    }
};
