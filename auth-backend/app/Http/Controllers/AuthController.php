<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function signup(AuthRequest $request)
    {
        $data=$request->validated();

        $data['password']= Hash::make($data['password']);
        $data['token']=Str::random(64);
        return User::create($data)->token;
    }

    public function login(AuthRequest $request)
    {
        $request->validated();
        $user=User::where('username',$request['username'])->where('role',$request['role'])->first();
        if(!$user || !Hash::check($request['password'],$user->password)) {
            return response(['message' => 'The provided credentials are incorrect.'], 401);
        }

        return $user->token;
    }

    public function check()
    {
        return true;
    }

}
