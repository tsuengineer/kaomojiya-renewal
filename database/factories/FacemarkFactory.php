<?php

namespace Database\Factories;

use App\Models\Facemark;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FacemarkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Facemark::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // 使用例: ランダムなタグを3つ持つ投稿を生成
        // $facemark = Facemark::factory()->withTags(3)->create();

        $createdAt = $this->faker->dateTimeBetween('-1 years', 'now');

        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'ulid' => Str::ulid(),
            'data' => $this->faker->unique()->sentence(20),
            'copy_count' => $this->faker->numberBetween(0, 1000),
            'created_at' => $createdAt,
        ];
    }

    /**
     * Attach tags to the facemark.
     *
     * @param int $count Number of tags to attach
     * @return $this
     */
    public function withTags(int $count = 3): static
    {
        return $this->afterCreating(function (Facemark $facemark) use ($count) {
            $tags = Tag::query()->inRandomOrder()->limit($count)->get();
            $facemark->tags()->attach($tags);
        });
    }
}
