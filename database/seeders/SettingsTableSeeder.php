<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $data = [
            [
            'key' => 'site_title',
            'value' => 'Demo title',
            'type' => 'landing-page',
            ],
            [
                'key' => 'contact_email',
                'value' => 'contact@email.com',
                'type' => 'llanding-page',
            ],
            [
                'key' => 'site_logo',
                'value' => 'images/logo.png',
                'type' => 'llanding-page',
            ],
            [
                'key' => 'site_favicon',
                'value' => 'images/logo.png',
                'type' => 'llanding-page',
            ],
            [
                'key' => 'facebook_link',
                'value' => 'www.facebook.com',
                'type' => 'social-links',
            ],
            [
                'key' => 'twitter_link',
                'value' => 'www.twitter.com',
                'type' => 'social-links',
            ],
            [
                'key' => 'instagram_link',
                'value' => 'www.instagram.com',
                'type' => 'social-links',
            ],
            [
                'key' => 'linkedin_link',
                'value' => 'www.linkedin.com',
                'type' => 'social-links',
            ],
        ];

        Setting::insert($data);
    }
}
