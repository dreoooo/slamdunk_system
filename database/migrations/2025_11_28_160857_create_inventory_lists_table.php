<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_list', function (Blueprint $table) {
            $table->string('id', 11)->primary();
            $table->decimal('cost', 7, 2);
            $table->integer('units');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_list');
    }
};
