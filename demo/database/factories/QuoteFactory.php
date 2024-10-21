<?php

namespace Database\Factories;

use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuoteFactory extends Factory
{
    protected $model = Quote::class;

    public function definition()
    {
        return [
            'quote' => $this->faker->sentence(10), // Random sentence with 10 words
            'author' => $this->faker->name, // Random name for author
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
