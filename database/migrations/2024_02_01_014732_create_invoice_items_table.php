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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();

            $table->integer('invoice_id');
            $table->integer('product_id');
            $table->string('description')->nullable();

            $table->integer('quantity')->default(1);
            $table->decimal('selling_price', 10,2)->default(0.00);
            $table->decimal('discount', 10,2)->default(0.00);
            $table->decimal('tax', 10,2)->default(0.00);
            $table->decimal('total', 10,2)->default(0.00);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
