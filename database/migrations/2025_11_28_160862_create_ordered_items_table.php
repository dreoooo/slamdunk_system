<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ordered_items', function (Blueprint $table) {
            $table->string('odr_id', 9);
            $table->string('itm_number', 10);
            $table->integer('quantity_ordered');
            $table->integer('quantity_shipped')->default(0);
            $table->timestamps();

            // Composite primary key: odr_id + itm_number
            $table->primary(['odr_id', 'itm_number']);

            // Foreign keys
            $table->foreign('odr_id')
                ->references('odr_id')
                ->on('orders')
                ->cascadeOnDelete();

            $table->foreign('itm_number')
                ->references('itm_number')
                ->on('items')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ordered_items');
    }
};
