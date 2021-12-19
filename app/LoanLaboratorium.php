<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanLaboratorium extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function laboratorium()
    {
        return $this->belongsTo(Laboratorium::class,'laboratorium_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
