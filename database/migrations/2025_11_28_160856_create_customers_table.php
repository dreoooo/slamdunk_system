<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->string('ctr_number', 6)->primary();
            $table->string('email', 50)->unique();
            $table->string('first_name', 20);
            $table->string('last_name', 30);
            $table->string('phone_number', 11);
            $table->decimal('current_balance', 6, 2); // fixed precision
            $table->string('loyalty_card_number', 6)->unique()->nullable();
            $table->string('tem_id', 4)->nullable();
            $table->string('sre_id', 4)->nullable();

            // Foreign keys
            $table->foreign('tem_id')->references('id')->on('teams')->nullOnDelete();
            $table->foreign('sre_id')->references('id')->on('sales_representatives')->nullOnDelete();

            // Add timestamps
            $table->timestamps(); // <-- this is required
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
