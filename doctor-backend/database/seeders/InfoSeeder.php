<?php

namespace Database\Seeders;

use App\Models\Info;
use Faker\Provider\fa_IR\Address;
use Faker\Provider\fa_IR\Person;
use Faker\Provider\fa_IR\PhoneNumber;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Seeder;

class InfoSeeder extends Seeder
{

    public function run()
    {
        $specs = ['قلب', 'مغز و اعصاب', 'ارتوپدی', 'دستگاه گوارش', 'چشم', 'گوش و حلق و بینی'];
        $license = ['عمومی', 'تخصص', 'فوق تخصص'];
        $url = env('AUTH_URL');
        $res = Http::post($url . '/api/login',
            ['username' => 'mohammad', 'password' => '123456', 'role' => 'user']
        );
        $token = $res->json()['token'];
        $res = Http::withHeaders(['token' => $token])->get($url . '/api/doctors');
        $doctors = $res->json();
        foreach ($doctors as $doctor) {
            Info::create([
                'user_id' => $doctor['id'],
                'name' => Person::firstNameMale(),
                'spec' => $specs[random_int(0, count($specs)-1)],
                'license' => $license[random_int(0, count($license)-1)],
                'tell' => PhoneNumber::mobileNumber(),
                'address' => Address::streetPrefix()
            ]);
        }
    }
}
