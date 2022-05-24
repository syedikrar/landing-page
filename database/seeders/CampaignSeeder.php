<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Campaign;


class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,10) as $i){
            $campaign = new Campaign();
            $campaign->user_id = $faker->numberBetween(1,5);
            $campaign->uuid = $faker->uuid;
            $campaign->name = $faker->text($maxNbChars = 20);
            $campaign->code = $faker->text($maxNbChars = 20);
      
            $campaign->save();
        }
    }
}
