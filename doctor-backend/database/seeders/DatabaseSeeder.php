<?php

namespace Database\Seeders;

use App\Models\Info;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(Info::count('id')>30) return;
        $this->call([
            InfoSeeder::class,
            WorkTimeSeeder::class,
        ]);
    }
}
