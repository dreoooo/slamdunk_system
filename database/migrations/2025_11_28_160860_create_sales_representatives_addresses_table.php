<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_representative_addresses', function (Blueprint $table) {
            $table->string('id', 4)->primary(); // 4-character primary key
            $table->string('sre_id', 4);        // FK to sales_representatives.id
            $table->string('address_line_1', 30);
            $table->string('address_line_2', 30)->nullable();
            $table->string('city', 15);
            $table->string('postal_code', 7);
            $table->timestamps();

            $table->foreign('sre_id')->references('id')->on('sales_representatives')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_representative_addresses');
    }
};
