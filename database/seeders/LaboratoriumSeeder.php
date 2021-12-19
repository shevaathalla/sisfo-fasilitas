<?php

namespace Database\Seeders;

use App\Laboratorium;
use Illuminate\Database\Seeder;

class LaboratoriumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Laboratorium::factory()->count(10)->create();
    }
}
