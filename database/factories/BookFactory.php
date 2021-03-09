<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Author;
use App\Models\Library;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'year' => $this->faker->year(),
            'author_id' => Author::factory()->create()
        ];
    }
}
