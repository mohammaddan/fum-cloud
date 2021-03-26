<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $doc_ids= Favorite::where('user_id',$request->id)
            ->get('doctor_id')->pluck('doctor_id')->toArray();
        return Http::get(env('DOCTOR_URL').'/api/doctors?ids='.implode(',',$doc_ids))->json();
    }

    public function attach(Request $request)
    {
        $fav=Favorite::where('user_id',$request->id)
            ->where('doctor_id',$request['doctor_id'])->first();
        if($fav) return ['message'=>'این پزشک را قبلا به لیست علاقه مندی های خود افزوده اید'];
        Favorite::create([
           'user_id' => $request->id,
           'doctor_id' => $request['doctor_id']
        ]);
        return ['message'=>'این پزشک به لیست علاقه مندی های شما افزوده شد'];
    }

    public function remove(Request $request,$doctor_id)
    {
        return Favorite::where('user_id',$request->id)
            ->where('doctor_id',$doctor_id)->delete();
    }
}
