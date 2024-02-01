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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();

            $table->integer('business_partner_id');
            
            $table->date('order_date');
            $table->string('order_number')->index();
            $table->string('order_status');
            $table->string('order_title')->nullable();
            $table->text('notes');

            $table->decimal('subtotal_amount', 10, 2);
            $table->decimal('tax_amount', 10, 2);
            $table->decimal('discount_amount', 10, 2);
            $table->decimal('shipping_charges', 10, 2);
            $table->decimal('other_charges', 10, 2);
            $table->decimal('total_order_amount', 10, 2);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
