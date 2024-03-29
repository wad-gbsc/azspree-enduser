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
        'client_id' => '782154035632-k0suabhthirkcgf0j4eaups9ome166kl.apps.googleusercontent.com',
        'client_secret' => 'j-yFKzFU31UOlX2oxr6V4R9S',
        'redirect' => 'https://localhost.azspree.com/auth/google/callback',
    ],

    'facebook' => [
        'client_id' => '217655209954828',
        'client_secret' => 'a07df56157a5c6f880e3b83709365227',
        'redirect' => 'https://localhost.azspree.com/auth/facebook/callback',
    ],

    // //For Up
    // 'google' => [
    //     'client_id' => '670035484977-vi38v7j7afhl7efe2bt9i8u1os7n9gr8.apps.googleusercontent.com',
    //     'client_secret' => '02FUS4h-B3vYhA8-Nr5Rctj6',
    //     'redirect' => 'https://azspree.com/auth/google/callback',
    // ],

    // 'facebook' => [
    //     'client_id' => '219192816331509',
    //     'client_secret' => '951c343c3c28fe6af2c76e12c03f80fb',
    //     'redirect' => 'https://azspree.com/auth/facebook/callback',
    // ],

];
