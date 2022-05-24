<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Country;


class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            ['name'=>'United States', 'code'=>'US'],
            ['name'=>'United Kingdom', 'code'=>'UK'],
            ['name'=>'France', 'code'=>'FR'],
            ['name'=>'Spain', 'code'=>'SP'],
            ['name'=>'Pakistan', 'code'=>'PK'],
        ];

        Country::insert($countries);
    }
}
