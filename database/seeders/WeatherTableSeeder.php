<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;

class WeatherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weather')->insert([
            'city_name' => 'London',
        ]);
        DB::table('weather')->insert([
            'city_name' => 'New York',
        ]);
        DB::table('weather')->insert([
            'city_name' => 'Berlin',
        ]);
    }
}
