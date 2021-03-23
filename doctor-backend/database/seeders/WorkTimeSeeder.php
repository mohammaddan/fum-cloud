<?php

namespace Database\Seeders;

use App\Models\Info;
use App\Models\WorkTime;
use Illuminate\Database\Seeder;

class WorkTimeSeeder extends Seeder
{
    public function run()
    {
        $doctors=Info::all();
        foreach ($doctors as $doctor){
            $nums=random_int(10,20);
            for($i=0;$i<$nums;$i++){
                WorkTime::create([
                    'doctor_id' => $doctor->id,
                    'week_day'=> random_int(0,5),
                    'hour'=>random_int(9,22),
                    'capacity'=>random_int(5,15),
                ]);
            }
        }
    }
}
