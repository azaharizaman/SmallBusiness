<?php

namespace Database\Factories;

use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{

    public function definition()
    {

        $numItems = $this->faker->numberBetween(2, 6);

        return [

            'uuid' => $this->faker->uuid,
            'business_partner_id' => null,
            'order_id' => null,
            'billing_address_id' => $this->faker->numberBetween(1, 100), // Adjust as needed

            'invoice_number' => $this->faker->unique()->word,
            'invoice_date' => $this->faker->date,
            'invoice_status' => 'Draft',
            'title' => $this->faker->sentence,
            'notes' => $this->faker->paragraph,

            'subtotal_amount' => $this->faker->randomFloat(2, 0, 1000),
            'tax_amount' => $this->faker->randomFloat(2, 0, 100),
            'discount_amount' => $this->faker->randomFloat(2, 0, 50),
            'shipping_charges' => $this->faker->randomFloat(2, 0, 20),
            'other_charges' => $this->faker->randomFloat(2, 0, 10),
            'total_paid_amount' => $this->faker->randomFloat(2, 0, 500),
            'total_invoice_amount' => $this->faker->randomFloat(2, 0, 1000),
            'total_outstanding_amount' => $this->faker->randomFloat(2, 0, 500),

            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'deleted_at' => null,

            'invoice_items' => function () use ($numItems) {
                return InvoiceItem::factory($numItems)->create();
            },
        ];
    }
}
