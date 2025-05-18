<?php

return [

    'default' => env('DB_CONNECTION', 'pgsql'),

    // Konfigurasi koneksi database lainnya ...
    'connections' => [
        'pgsql' => [
            'driver' => env('DB_CONNECTION', 'pgsql'),
            'host' => env('DB_HOST', '27.112.78.145'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'sipayu_db'),
            'username' => env('DB_USERNAME', 'postgres'),
            'password' => env('DB_PASSWORD', 'k3s24fGWWQ6FKZnRWDbAaBhiYWB6jxIZLtRNAYGwW4Ea8GepKXyBWQqDRBwpwrea'),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],
    
        // 'redis' => [
        //     'client' => 'predis',  // atau 'phpredis' jika menggunakan ekstensi phpredis
        //     'default' => [
        //         'host'     => env('REDIS_HOST', '127.0.0.1'),
        //         'password' => env('REDIS_PASSWORD', null),
        //         'port'     => env('REDIS_PORT', 6379),
        //         'database' => env('REDIS_DATABASE', 0),
        //     ],
    
        // ],
        // 'redis' => [
    
        //     'client' => env('REDIS_CLIENT', 'predis'), // atau 'phpredis' jika menggunakan ekstensi phpredis
    
        //     'default' => [
        //         'host'     => env('REDIS_HOST', '127.0.0.1'),
        //         'password' => env('REDIS_PASSWORD', null),
        //         'port'     => env('REDIS_PORT', 6379),
        //         'database' => env('REDIS_DATABASE', 0),
        //     ],
    
        //     // Jika diperlukan, Anda juga bisa menambahkan koneksi lain, misalnya untuk cache
        //     'cache' => [
        //         'host'     => env('REDIS_HOST', '127.0.0.1'),
        //         'password' => env('REDIS_PASSWORD', null),
        //         'port'     => env('REDIS_PORT', 6379),
        //         'database' => env('REDIS_CACHE_DATABASE', 1),
        //     ],
        // ],

    ],
    
    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    */
    'redis' => [

        // Pilih client: predis atau phpredis
        'client' => env('REDIS_CLIENT', 'predis'),

        'default' => [
            'host'     => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port'     => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DATABASE', 0),
        ],

        // Jika Anda ingin menggunakan koneksi terpisah untuk cache,
        // Anda bisa menambahkannya seperti contoh sebelumnya.
    ],
    
    'migrations' => 'migrations',

];
