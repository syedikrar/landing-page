<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(
            [   'email' => 'vincenzo@dconcepts.tech', ],
            [
                'uuid' => Str::uuid(),
                'first_name' => 'Vincenzo',
                'last_name' => 'Decaro',
                'password' => bcrypt('12345678'),
                'user_type' => 'admin',
                'email_verified_at' => Carbon::now(),
            ]
        );

        User::firstOrCreate(
            [   'email' => 'info@media-dudes.com', ],
            [
                'uuid' => Str::uuid(),
                'first_name' => 'Media',
                'last_name' => 'Dudes',
                'password' => bcrypt('12345678'),
                'user_type' => 'admin',
                'email_verified_at' => Carbon::now(),
            ]
        );
    }
}
