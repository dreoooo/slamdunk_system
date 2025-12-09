<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers_addresses', function (Blueprint $table) {
            $table->string('id', 8)->primary();
            $table->string('address_line_1', 30);
            $table->string('address_line_2', 30)->nullable();
            $table->string('city', 15);
            $table->string('postal_code', 7);
            $table->string('ctr_number', 6);
            $table->foreign('ctr_number')->references('ctr_number')->on('customers')->cascadeOnDelete();

            $table->timestamps(); // Add this line
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers_addresses');
    }
};
