<?php

use Hanafalah\ModuleCardIdentity\{
    Models as ModuleCardIdentityModels,
    Contracts
};

return [
    'namespace'  => 'Hanafalah\ModuleCardIdentity',
    'libs'       => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas',
        'database' => 'Database',
        'data' => 'Data',
        'resource' => 'Resources',
        'migration' => '../assets/database/migrations'
    ],
    'app' => [
        'contracts' => [
            // ADD YOUR CONTRACTS HERE
        ],
    ],
    'database'   => [
        'models' => [
        ]
    ]
];
