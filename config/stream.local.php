<?php

return [
    'stream' => [
        // Heroku connection url:
        'url' => getenv('STREAM_URL'),

        // Just regular key and secret found in your app dashboard: https://getstream.io/dashboard
        'app_key' => getenv('STREAM_APP_KEY'),
        'app_secret' => getenv('STREAM_APP_SECRET'),
    ],
];
