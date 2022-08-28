<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ajout de l'administrateur par défaut
        User::factory()->create([
            'name' => 'Philipe',
            'email' => 'philipe@gmail.com'
        ]);
    }
}
