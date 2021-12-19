<?php

namespace Database\Seeders;

use App\Tool;
use Illuminate\Database\Seeder;

class ToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tool::factory()->count(10)->create();
    }
}
