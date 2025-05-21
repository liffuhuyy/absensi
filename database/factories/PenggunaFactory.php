<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PenggunaFactory extends Factory
{
    protected $model = Pengguna::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'), // Bisa diubah sesuai kebutuhan
            'role' => $this->faker->randomElement(['user', 'perusahaan', 'admin']),
        ];
    }
}