<?php

namespace Database\Factories;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FeedbackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feedback::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'rating' => $this->faker->numberBetween($min = 0, $max = 5),
            'description' => $this->faker->text,
            'created_at' => $this->faker->dateTimeBetween('-30 days')
        ];
    }
}
