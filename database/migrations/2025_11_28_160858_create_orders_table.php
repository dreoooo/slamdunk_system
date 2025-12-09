<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->string('odr_id', 9)->primary();
            $table->string('ctr_number', 6);
            $table->date('odr_date');
            $table->timestamp('odr_time')->useCurrent();
            $table->integer('number_of_units');
            $table->timestamps();

            // Foreign key: link to customers
            $table->foreign('ctr_number')
                ->references('ctr_number')
                ->on('customers')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
