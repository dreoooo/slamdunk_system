<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->string('itm_number', 10)->primary();
            $table->string('name', 20);
            $table->string('description', 50);
            $table->string('category', 25);
            $table->string('color', 15)->nullable();
            $table->char('size', 1)->nullable();
            $table->string('ilt_id', 11)->nullable(); // FK to inventory_list
            $table->timestamps();

            $table->foreign('ilt_id')->references('id')->on('inventory_list')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
