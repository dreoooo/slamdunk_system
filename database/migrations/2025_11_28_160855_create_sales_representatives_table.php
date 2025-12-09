<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_representatives', function (Blueprint $table) {
            $table->string('id', 4)->primary();
            $table->string('email', 50)->unique();
            $table->string('first_name', 20);
            $table->string('last_name', 30);
            $table->string('phone_number', 11);
            $table->integer('commission_rate');
            $table->string('supervisor_id', 4)->nullable();
            $table->foreign('supervisor_id')->references('id')->on('sales_representatives');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_representatives');
    }
};
