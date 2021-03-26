<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cr=file(storage_path('app/public/data/city.csv'));
        foreach ($cr as $c){
            $city=explode(',',$c)[3];
            $city=str_replace("\n",'',$city);
            City::create([
                'name'   =>  $city,
            ]);
        }
    }
}
