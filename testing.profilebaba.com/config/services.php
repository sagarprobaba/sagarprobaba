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

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\Models\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ], 

    'spotify' => [    
        'client_id' => env('SPOTIFY_CLIENT_ID','46bfb4213b984a41b9c9aaf2d53fac0b'),  
        'client_secret' => env('SPOTIFY_CLIENT_SECRET','d3b6eeb615554934b0f44b10c9625e64'),  
        'redirect' => env('SPOTIFY_REDIRECT_URI','https://gigjik.com/auth/spotify/callback') 
    ],

    'instagram' => [    
        'client_id' => env('INSTAGRAM_CLIENT_ID','791569561436432'),  
        'client_secret' => env('INSTAGRAM_CLIENT_SECRET','3580bf0b378321a456dd5ebeaa8180e4'),  
        'redirect' => env('INSTAGRAM_REDIRECT_URI','https://gigjik.com/auth/instagram/callback') 
    ],
    'facebook' => [    
        'client_id' => env('FACEBOOK_CLIENT_ID','791569561436432'),  
        'client_secret' => env('FACEBOOK_CLIENT_SECRET','3580bf0b378321a456dd5ebeaa8180e4'),  
        'redirect' => env('FACEBOOK_REDIRECT_URI','https://gigjik.com/auth/facebook/callback') 
    ],

    'firebase' => [
        'api_key' => env('FIREBASE_API_KEY'),
        'auth_domain' => env('FIREBASE_AUTH_DOMAIN'),
        'database_url' => env('FIREBASE_DATABASE_URL'),
        'storage_bucket' => env('FIREBASE_STORAGE_BUCKET'),
        'project_id' => env('FIREBASE_PROJECT_ID'),
        'messaging_sender_id' => env('FIREBASE_MESSAGING_SENDER_ID')
    ]

];
