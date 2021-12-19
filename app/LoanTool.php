<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanTool extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tool(){
        return $this->belongsTo(Tool::class,'tool_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
