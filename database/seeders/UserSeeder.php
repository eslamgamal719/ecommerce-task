<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $admin = User::create([
            'full_name' => $faker->firstName . " " . $faker->lastName,
            'email' => 'admin@gmail.com',
            'mobile' => $faker->unique()->numerify("010########"),
            'role_name' => 'admin',
            'password' => bcrypt(123456789),
        ]);

        $client = User::create([
            'full_name' => $faker->firstName . " " . $faker->lastName,
            'email' => 'client@gmail.com',
            'mobile' => $faker->unique()->numerify("010########"),
            'role_name' => 'client',
            'password' => bcrypt(123456789),
        ]);

        $adminRole  = DB::table('roles')->where('name', 'admin')->first()->id;
        $clientRole = DB::table('roles')->where('name', 'client')->first()->id;

        $admin->assignRole($adminRole);
        $client->assignRole($clientRole);

        User::factory(100)->create();

    }
}
