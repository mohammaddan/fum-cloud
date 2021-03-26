<?php

namespace App\Http\Controllers;

use App\Models\DoctorComment;
use Illuminate\Http\Request;

class DoctorCommentController extends Controller
{
    public function index($doctor_id)
    {
        return DoctorComment::where('doctor_id',$doctor_id)->get();
    }

    public function store(Request $request)
    {
        return DoctorComment::create([
            'user_id' => $request->id,
            'doctor_id' => $request['doctor_id'],
            'comment' => $request['comment']
        ]);
    }
}
