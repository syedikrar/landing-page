<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'stripe' => [
        'bronze_price_key' => env('BRONZE_PRICE_KEY', 'price_1JrJafBQGa8GfwPLhkZ2rDTJ'),
        'bronze_plan_key' => env('BRONZE_PLAN_KEY', 'prod_KWMJXFZROLkcNW'),
        'silver_plan_key' => env('SILVER_PLAN_KEY', 'prod_KWMLWsN7oHTT5S'),
        'gold_plan_key' => env('GOLD_PLAN_KEY', 'prod_KWMLfHKUKfJ3nC'),
    ],
];
