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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '654103914700-tudh12ujo7401l48uobrf4p2du00pvgb.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'http://localhost:8000/google/callback',
    ],
    'facebook' => [
        'client_id' => '1065098717715216', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'client_secret' => '1a872f2b6c64863718b56077da662308', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'redirect' => 'http://localhost:8000/facebook/callback/'
    ],

];
