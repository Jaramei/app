<?php

return [
    'locale-id'=>1,
    'cache_store_keys' => storage_path() . '/cache_keys.json',
    'package_path' => base_path() . '/packages/Application',
    'stubs_path'=> base_path().'/packages/Application/Core/stubs/package',
    'path_migrations'=>'/packages/Application/Core/database/migrations',
    'upload' => [
        'base_dir' => public_path('uploads'),
    ],

    'slug' => [
        'pattern' => '--slug--',
    ]
];


