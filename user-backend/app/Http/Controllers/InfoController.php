<?php

namespace App\Http\Controllers;

use App\Models\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function me(Request $request)
    {
        return Info::where('user_id',$request->id)->first();
    }

    public function update($user_id,Request $request)
    {
        if($request->id!=$user_id) return response(['message'=>"it's not your account!"],403);
        $info=Info::where('user_id',$user_id)->first();
        if($info){
            $info->update([
               'name' => ($request['name']??$info->name),
               'tell' => ($request['tell']??$info->tell),
            ]);
        }else{
            $info=Info::create([
                'user_id' => $user_id,
                'name' => ($request['name']??null),
                'tell' => ($request['tell']??null),
            ]);
        }
        return $info;
    }
}
