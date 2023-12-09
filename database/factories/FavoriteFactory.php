<?php

namespace Database\Factories;

use App\Models\Facemark;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Favorite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                User::inRandomOrder()->first()->id;
            },
            'facemark_id' => function () {
                Facemark::inRandomOrder()->first()->id;
            },
        ];
    }
}
