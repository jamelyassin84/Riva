<?php


return [
    'publishable' => env('STRIPE_KEY', null),
    'secret' => env('STRIPE_SECRET', null),
    'currency' => env('CASHIER_CURRENCY', null),
    'currency_local' => env('CASHIER_CURRENCY_LOCALE', null),
    'logger' => env('CASHIER_LOGGER', null),
];
