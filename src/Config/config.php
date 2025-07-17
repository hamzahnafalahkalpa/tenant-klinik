<?php

use GroupInitialKlinik\TenantKlinik\{
    Contracts, Models, Commands
};

return [
    "namespace"     => "GroupInitialKlinik\TenantKlinik",
    "service_name"  => "TenantKlinik",
    "paths"         => [
        "local_path"   => 'app/Tenants',
        "base_path"    => __DIR__.'\\..\\'
    ],
    "libs"           => [
        'migration' => 'Database/Migrations',
        'model' => 'Models',
        'provider' => 'Providers',
        'contract' => 'Contracts',
        'concern' => 'Concerns',
        'command' => 'Commands',
        'route' => 'Routes',
        'observer' => 'Observers',
        'policy' => 'Policies',
        'seeder' => 'Database/Seeders',
        'middleware' => 'Middleware',
        'request' => 'Requests',
        'support' => 'Supports',
        'view' => 'Views',
        'schema' => 'Schemas',
        'facade' => 'Facades',
        'config' => 'Config',
    ],
    "packages" => [
        /*--------------------------------------------------------------------------
        * Note: The contents of the packages are started with the class base name,
        * then followed by config and others. You can be used to override default package config
        * "module-user" => [
        *       "config" => []
        * ]
        *------------------------------------------------------------------------*/
    ],
    "app" => [
        "impersonate" => [
            "storage"   => [
                "driver" => env("FILESYSTEM_DISK", 'local'),
            ],
        ],
        "contracts" => [
        ],
    ],
    "database"     => [
        "models"   => [
        ]
    ],
    "commands" => [
        Commands\SeedCommand::class,
        Commands\MigrateCommand::class,
        Commands\InstallMakeCommand::class
    ],
    "encodings" => [
    ],
    "provider" => "GroupInitialKlinik\TenantKlinik\\Providers\\TenantKlinikServiceProvider"
];
