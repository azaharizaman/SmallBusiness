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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();
            
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('tax_id')->unsigned()->nullable();
            $table->integer('product_category_id')->unsigned()->nullable();

            $table->string('product_name');
            $table->string('product_code');
            $table->text('product_description')->nullable();
            $table->string('product_type')->default('General');
            $table->json('product_group')->nullable();
            $table->json('product_images')->nullable();

            $table->boolean('product_is_physical')->default(1);
            $table->integer('inventory_quantity_on_hand')->default(0);
            $table->decimal('product_cost_price', 9,2)->default(0.00);
            $table->decimal('product_selling_price', 9,2)->default(0.00);
        
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
