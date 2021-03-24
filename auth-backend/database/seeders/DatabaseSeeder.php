<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(User::count('id')>30) return;
        User::create([
            'username' => 'mohammad',
            'password' =>  Hash::make('123456'),
            'role' => 'user',
            'token' => Str::random(64),
        ]);
         \App\Models\User::factory(50)->create();
    }
}
