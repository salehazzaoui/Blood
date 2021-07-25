<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'azsaleh954@gmail.com',
            'password' => Hash::make('admin2021'),
            'is_admin' => true
        ]);

        /*User::factory()
        ->count(150)
        ->create();*/
    }
}
