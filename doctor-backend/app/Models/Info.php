<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function workTimes(){
        return $this->hasMany(WorkTime::class,'doctor_id');
    }
}
