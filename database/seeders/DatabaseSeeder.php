<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use \App\Models\User;
use \App\Models\Animal;
use \App\Models\Farm;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@localhost',
            'password' => Hash::make('admin')
        ]);

        $farm = Farm::factory()->create([
            'name' => 'Jelgavas ferma',
            'email' => 'info@ferma.loc',
            'website' => 'https://ferma.loc',
            'user_id' => $admin->id
        ]);

        Animal::factory()->create([
            'number' => 2,
            'type' => 'Govs',
            'years' => 2018,
            'farm_id' => $farm->id,
            'user_id' => $admin->id
        ]);

        Animal::factory()->create([
            'number' => 10,
            'type' => 'Aitas',
            'years' => 2020,
            'farm_id' => $farm->id,
            'user_id' => $admin->id
        ]);

        Animal::factory()->create([
            'number' => 5,
            'type' => 'Kaza',
            'years' => 2017,
            'farm_id' => $farm->id,
            'user_id' => $admin->id
        ]);

        $farm2 = Farm::factory()->create([
            'name' => 'Dobeles ferma',
            'email' => 'info@ferma.loc',
            'website' => 'https://dobele.loc',
            'user_id' => $admin->id
        ]);

        Animal::factory()->create([
            'number' => 50,
            'type' => 'Govs',
            'years' => 2020,
            'farm_id' => $farm2->id,
            'user_id' => $admin->id
        ]);

        $user = \App\Models\User::factory()->create([
            'name' => 'user',
            'email' => 'user@localhost',
            'password' => Hash::make('user')
        ]);

        $farm3 = Farm::factory()->create([
            'name' => 'Ķekavas putnu ferma',
            'email' => 'info@vistas.loc',
            'website' => 'https://vistas.loc',
            'user_id' => $user->id
        ]);

        Animal::factory()->create([
            'number' => 500,
            'type' => 'Vista',
            'years' => 2021,
            'farm_id' => $farm3->id,
            'user_id' => $user->id
        ]);

        Animal::factory()->create([
            'number' => 38,
            'type' => 'Gailis',
            'years' => 2020,
            'farm_id' => $farm3->id,
            'user_id' => $user->id
        ]);

        $farm4 = Farm::factory()->create([
            'name' => 'Olaines ferma',
            'email' => 'info@zirgi.loc',
            'website' => 'https://zirgi.loc',
            'user_id' => $user->id
        ]);

        Animal::factory()->create([
            'number' => 10,
            'type' => 'Zirgs',
            'years' => 2015,
            'farm_id' => $farm4->id,
            'user_id' => $user->id
        ]);
    }
}
