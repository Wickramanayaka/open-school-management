<?php

return $config = [
    'app_one' => env('APP_ONE_PRICE', 500),
    'app_two' => env('APP_TWO_PRICE', 250),

    // Mobile application api key
    'api_key' => env('API_KEY', ''),

    // SMS API
    'sms_api' => '',

    // SMS hash
    'sms_hash' => '',

    // Genie IPG
    'currency' => 'LKR',
    'secretCode' => '',
    'storeName' => '',
];