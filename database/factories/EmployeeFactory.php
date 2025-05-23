<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition()
    {
        // Atur locale Faker ke Indonesia
        $this->faker = \Faker\Factory::create('id_ID');
    
        return [
            'id_number' => sprintf('NIP-%03d', $this->faker->unique()->numberBetween(1, 50)), // Format ID (NIP-001, NIP-002, dst)
            'name' => $this->faker->firstName . ' ' . $this->faker->lastName, // Nama lengkap orang Indonesia
            'posisi' => $this->faker->randomElement(['Barista', 'Chef', 'Kasir', 'Admin']),
            'alamat' => $this->faker->streetAddress . ', ' . $this->faker->city . ', ' . $this->faker->state . ', ' . $this->faker->postcode, // Alamat Indonesia
            'jenis_kelamin' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            'no_telp' => $this->faker->numerify('+62 ##########'), // Format nomor telepon Indonesia
        ];
    }
    
    
    
}