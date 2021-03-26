<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('src')){
            return City::where('name','like',"%{$request['src']}%")->orderBy('name')->get();
        }
        return City::orderBy('name')->get();
    }
}
