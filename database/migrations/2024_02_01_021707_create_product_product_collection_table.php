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
        Schema::create('product_product_collection', function (Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table->integer('product_collection_id')->unsigned();
            $table->primary(['product_collection_id', 'product_id']);
            $table->string('identifier')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_product_collection');
    }
};
