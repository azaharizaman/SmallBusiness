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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();

            $table->integer('business_partner_id')->unsigned();

            $table->string('payment_number');
            $table->date('payment_date');
            $table->string('payment_type');
            $table->string('payment_status');
            $table->string('payment_method');

            $table->decimal('payment_amount', 10, 2);
            $table->text('notes')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
