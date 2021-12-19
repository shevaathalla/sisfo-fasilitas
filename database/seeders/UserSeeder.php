<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            "nim" => 000001,
            "name" => "Super",
            "last_name" => "Admin",
            "email" => 'admin@mail.com',
            "password" => 'password',
            'type' => 'admin'
        ]);
        factory(User::class,10)->create();
    }
}
