<?php

namespace App\Http\Controllers;

use App\Models\VisitTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VisitTimeController extends Controller
{
    public function getVisit(Request $request){
        return VisitTime::create([
            'user_id'=> $request['user_id'],
            'doctor_id'=> $request['doctor_id'],
            'work_time_id'=> $request['work_time_id'],
            'hour'=> $request['hour'],
            'visit_date'=> Carbon::now()->addDays($request['plusDay']),
        ]);
    }
}
