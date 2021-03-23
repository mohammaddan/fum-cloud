<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index(Request $request)
    {
        return Info::where(function ($q) use ($request){
            if($request->has('name')) $q->where('name','like','%'.$request['name'].'%');
            if($request->has('city')) $q->where('city_id',$request['city_id']);
            if($request->has('spec')) $q->where('spec',$request['spec']);
            if($request->has('license')) $q->where('license',$request['license']);
        })->get();
    }
}
