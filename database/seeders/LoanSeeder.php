<?php

namespace Database\Seeders;

use App\Laboratorium;
use App\LoanLaboratorium;
use App\LoanTool;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        LoanTool::factory()->count(5)->create();

        $laboratoria = Laboratorium::inRandomOrder()->limit(5)->pluck('id')->toArray();

        for ($i=0; $i < count($laboratoria) ; $i++) { 
            LoanLaboratorium::factory()->create([
                "laboratorium_id" => $laboratoria[$i]
            ]);            
        }

        Laboratorium::whereIn('id', $laboratoria)->update([
            "status" => "unavailable"
        ]);
    }
}
