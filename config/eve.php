<?php

return [
    'esi' => [
        'version' => env('EVE_ESI_VERSION', 'latest'),
        'api_uri' => env('EVE_ESI_BASE_URL', 'https://esi.evetech.net'),
        'login_uri' => env('EVE_ESI_LOGIN_URL', 'https://login.eveonline.com'),

        'server' => env('EVE_ESI_SERVER', 'tranquility'),

        'client_id' => env('EVE_ESI_CLIENT_ID'),
        'secret_key' => env('EVE_ESI_SECRET_KEY'),

        'corporation' => env('EVE_ESI_CORPORATION_ID')
    ]
];
