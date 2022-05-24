<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call([
            RolesAndPermissionsTableSeeder::class,
            UserSeeder::class,
            // CampaignSeeder::class,
            CountrySeeder::class,
            TemplateSeeder::class,
            PredefinedFieldsSeeder::class,
            SettingsTableSeeder::class,
        ]);
    }
}
