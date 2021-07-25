<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\{Wilaya, Commune};

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    public function definition()
    {
        $blood = array("A+", "A-", "B+", "B-", "AB+", "AB-", "O+", "O-");
        $wilaya = Wilaya::inRandomOrder()->first();
        $commune = Commune::where('wilaya_id', $wilaya->id)->inRandomOrder()->first();
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            //'phone' => rand(10, 10),
            'blood_type' => $blood[array_rand($blood)],
            'wilaya' => $wilaya->name,
            'commune' => $commune->name,
            'contact_time' => '24/24h',
            'contact_type' => 'sms/call',
            'driver' => 'local'
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
