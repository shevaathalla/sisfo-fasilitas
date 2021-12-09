<?php
use Database\Seeders\FacilitySeeder;
use Database\Seeders\LoanSeeder;
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
            FacilitySeeder::class,
            LoanSeeder::class
        ]);
    }
}
