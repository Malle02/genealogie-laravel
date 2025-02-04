<?php

namespace Database\Factories;
namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    protected $model = Person::class;

    public function definition()
    {
        return [
            'created_by' => 1,
            'first_name' => fake()->firstName(), 
            'last_name' => strtoupper(fake()->lastName()), 
            'birth_name' => strtoupper(fake()->lastName()), 
            'middle_names' => null,
            'date_of_birth' => fake()->date(), 
        ];
    }
    
}
