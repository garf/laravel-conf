<?php

return [
    // database and other drivers is going to be added in the future
    'driver' => 'file',

    'drivers' => [
        'file' => [
            'path' => storage_path('app/conf.json'),
        ],
    ],
];
