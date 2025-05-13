<?php

use Hanafalah\ModuleCms\{
    Models as ModuleCmsModels,
    Commands as ModuleCmsCommands,
    Contracts
};

return [
    'app' => [
        'contracts' => [
            // ADD YOUR CONTRACTS HERE
        ],
    ],
    'commands' => [
        ModuleCmsCommands\InstallMakeCommand::class
    ],
    'libs'       => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas',
        'database' => 'Database',
        'data' => 'Data',
        'resource' => 'Resources',
        'migration' => '../assets/database/migrations'
    ],
    'database' => [
        'models' => [
            // ADD YOUR MODELS HERE
        ]
    ]
];
