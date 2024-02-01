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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();
            $table->integer('business_partner_id')->unsigned();

            $table->string('shipping_number')->index();
            $table->string('shipping_method');
            $table->string('shipping_status');
            $table->string('shipping_cost');
            $table->string('shipping_currency');
            $table->string('shipping_carrier');
            $table->string('shipping_tracking_url');
            $table->string('shipping_tracking_number');
            $table->json('shipping_tracking_status');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
