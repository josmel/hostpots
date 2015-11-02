<?php

return [
    'android' => [
        'url' => 'https://android.googleapis.com/gcm/send',
        'api' => 'AIzaSyBGKuUUliZkEzn3F_iuQONWHNuPcG0GkIE',
    ],
    'ios' => [
        'pass' => 'Reflexiones2015',
        'pem' => storage_path('app/pem/iReflexiones.pem'),
        'sandbox' => 'ssl://gateway.sandbox.push.apple.com:2195',  
    ],
];
