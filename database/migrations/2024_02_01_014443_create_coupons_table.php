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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();

            $table->string('coupon_code');
            $table->string('description');
            $table->string('coupon_type');
            $table->float('value', 10,2);
            $table->string('status');
            $table->date('activation');
            $table->date('expiration');
            $table->integer('max_usage');
            $table->integer('usage_count');

            $table->json('business_partners')->nullable();
            $table->json('products')->nullable();
            $table->json('product_categories')->nullable();
            $table->json('business_partner_categories')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
