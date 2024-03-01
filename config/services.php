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

    'google' => [
    'client_id' => '857749354166-drht6sq1olg0gf83gj9b0tbms6s2ei76.apps.googleusercontent.com',
    'client_secret' => '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',
    'redirect' => env('APP_URL').'/google/callback',
   ],

    'facebook' => [
        'client_id' => '1393430821561099',
        'client_secret' => '53e956579d142a5735a3d00898a1198b',
        'redirect' => env('APP_URL').'/facebook/callback',
    ],

    'twitter' => [
        'client_id' => 'F0s0uvyhcsNqEfSiExMOdn7hG',
        'client_secret' => '8iaQ5jmDBxZ5gKccDj2BdI6hcNHCWCI3et9RpJIxiLtEbCBSAb',
        'redirect' => env('APP_URL').'/twitter/callback',
    ],

    'instagrambasic' => [
        'client_id' => '479665690993216',
        'client_secret' => '216b05935d9866b5c5ec730cb9eb3165',
        'redirect' => env('APP_URL').'/instagram/callback',
    ],

];
