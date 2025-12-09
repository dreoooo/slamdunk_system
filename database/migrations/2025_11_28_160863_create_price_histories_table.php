<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_history', function (Blueprint $table) {
            $table->date('start_date');
            $table->time('start_time'); // <-- Use time()
            $table->decimal('price', 7, 2);
            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable(); // <-- Use time()
            $table->string('itm_number', 10);

            // Composite primary key
            $table->primary(['start_date', 'start_time', 'price', 'itm_number']);

            // Foreign key
            $table->foreign('itm_number')
                ->references('itm_number')
                ->on('items')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_history');
    }
};
