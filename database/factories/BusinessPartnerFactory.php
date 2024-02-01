<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusinessPartner>
 */
class BusinessPartnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $isCompany = $this->faker->boolean; // Randomly determine if it's a company

        $firstName = $this->faker->firstName;
        $lastName = $this->faker->lastName;

        $attributes = [
            'uuid' => Str::uuid(),
            'first_name' => $firstName,
            'last_name' => $lastName,
            'contact_number' => $this->faker->phoneNumber,
            'contact_email' => $this->faker->safeEmail,
            'website' => $this->faker->url,
            'notes' => $this->faker->paragraph,
            'is_active' => $this->faker->boolean,
            'is_company' => $isCompany,
        ];

        if ($isCompany) {
            $attributes['business_partner_name'] = $this->faker->company;
            $attributes['company_name'] = $attributes['business_partner_name'];
        } else {
            $attributes['business_partner_name'] = "$firstName $lastName";
        }

        // Optional company-related fields
        if ($isCompany) {
            $attributes['company_number'] = $this->faker->randomNumber;
            $attributes['company_contact_person'] = $this->faker->name;
            $attributes['company_contact_number'] = $this->faker->phoneNumber;
            $attributes['business_partner_type'] = $this->faker->randomElement(['Type A', 'Type B']);
            $attributes['business_partner_category'] = $this->faker->randomElement(['Category X', 'Category Y']);
        }

        // Generate a random number of social links (between 0 and 3)
        $numSocialLinks = $this->faker->numberBetween(0, 3);
        $numStatuses = $this->faker->numberBetween(0,4);
        $socialLinks = [];
        $statuses = [];

        for ($i = 0; $i < $numSocialLinks; $i++) {
            $socialLinks[] = [
                'media' => $this->faker->randomElement(['Facebook', 'X', 'LinkedIn']),
                'url' => $this->faker->url,
            ];
        }

        for ($i = 0; $i < $numStatuses; $i++) {
            $statuses[] = [
                'status' => $this->faker->randomElement(['Active', 'InActive', 'Suspended', 'OnHold', 'Pending']),
                'updated_on' => $this->faker->date,
                'updated_by' => $this->faker->randomNumber(1,4),
                'reason' => $this->faker->sentence,
            ];
        }

        $attributes['social_links'] = json_encode($socialLinks);
        $attributes['statuses'] = json_encode($statuses);

        return $attributes;
    }
}
