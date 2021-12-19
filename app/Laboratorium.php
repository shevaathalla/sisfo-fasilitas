<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorium extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function loans(){
        return $this->hasMany(LoanLaboratorium::class);
    }
}
