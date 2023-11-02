<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\User;

class Admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$1fuG/l9hJgJb6XqR9G5djuAs01u4R7e14DMMwSxFPuxJOn8ZGOM2O',
            'is_admin' => 1,

        ]);
    }
}
