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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();

            $table->integer('business_partner_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->integer('billing_address_id')->unsigned();

            $table->string('invoice_number')->index();
            $table->date('invoice_date');
            $table->string('invoice_status')->default('Draft');
            $table->string('title')->nullable();
            $table->text('notes');

            $table->decimal('subtotal_amount', 10,2)->default(0.00);
            $table->decimal('tax_amount', 10,2)->default(0.00);
            $table->decimal('discount_amount', 10,2)->default(0.00);
            $table->decimal('shipping_charges', 10,2)->default(0.00);
            $table->decimal('other_charges', 10,2)->default(0.00);
            $table->decimal('total_paid_amount', 10,2)->default(0.00);
            $table->decimal('total_invoice_amount', 10,2)->default(0.00);
            $table->decimal('total_outstating_amount', 10,2)->default(0.00);

            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
