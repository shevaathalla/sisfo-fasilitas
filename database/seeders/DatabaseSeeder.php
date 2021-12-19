<?php
use Database\Seeders\LaboratoriumSeeder;
use Database\Seeders\LoanSeeder;
use Database\Seeders\ToolSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            LaboratoriumSeeder::class,
            ToolSeeder::class,
            LoanSeeder::class
        ]);        
    }
}
