<?php

namespace Database\Seeders;
use Carbon\Carbon;

use App\Models\User;
use Faker\Factory as Faker;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create();
        // foreach (range(1,10) as $index) {
        //     User::create([
        //         'uuid' => Str::uuid(),
        //         'first_name' => $faker->firstName,
        //         'last_name' => $faker->lastName,
        //         'email' => $faker->unique()->email,
        //         'password' => bcrypt('12345678'),
        //         'user_type' => 'client',
        //         'email_verified_at' => Carbon::now(),
        //     ]);
        // }

        $client = User::create([
            'uuid' => Str::uuid(),
            'first_name' => 'Yasir',
            'last_name' => 'Mehmood',
            'email' => 'yasir.mehmood@therightsw.com',
            'password' => bcrypt('12345678'),
            'user_type' => 'client',
            'email_verified_at' => Carbon::now(),
        ]);

        $stripeCustomer = $client->createAsStripeCustomer();
        // Subscribe to a free plan - bronze

        $bronze_price_key = config('services.stripe.bronze_price_key');
        
        $client->newSubscription('default', $bronze_price_key)->create(null);

        User::create([
            'uuid' => Str::uuid(),
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('12345678'),
            'user_type' => 'admin',
            'email_verified_at' => Carbon::now(),
        ]);
    }
}
