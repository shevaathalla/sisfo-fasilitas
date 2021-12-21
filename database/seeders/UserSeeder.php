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
        factory(User::class)->create([
            "nim" => 1,
            "name" => "Super",
            "last_name" => "Admin",
            "email" => 'admin@mail.com',
            "password" => 'password',
            'type' => 'admin'
        ]);

        factory(User::class)->create([
            "nim" => 2,
            "name" => "Faculty",
            "last_name" => "Admin",
            "email" => 'faculty@mail.com',
            "password" => 'password',
            'type' => 'faculty_admin'
        ]);

        factory(User::class)->create([
            "nim" => 3,
            "name" => "Department",
            "last_name" => "Admin",
            "email" => 'department@mail.com',
            "password" => 'password',
            'type' => 'department_admin'
        ]);

        factory(User::class)->create([
            "nim" => 4,
            "name" => "Student",   
            "last_name" => "Sheva",         
            "email" => 'student@mail.com',
            "password" => 'password',
            'type' => 'student'
        ]);

        factory(User::class,10)->create();
    }
}
