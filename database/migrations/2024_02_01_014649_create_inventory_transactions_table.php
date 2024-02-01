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
        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();

            $table->integer('product_id')->unsigned();

            $table->integer('quantity_in')->default(0);
            $table->integer('quantity_out')->default(0);
            $table->decimal('value_in', 10,2)->default(0.00);
            $table->decimal('value_out', 10,2)->default(0.00);
            $table->string('transaction_type');
            $table->string('transaction_status');
            $table->string('transaction_date');
            $table->string('transaction_time');
            $table->string('transaction_user');
            $table->string('transaction_notes');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_transactions');
    }
};
