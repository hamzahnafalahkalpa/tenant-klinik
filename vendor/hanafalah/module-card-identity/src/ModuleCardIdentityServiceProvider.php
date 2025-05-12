<?php

namespace Hanafalah\ModuleCardIdentity;

use Hanafalah\LaravelSupport\Providers\BaseServiceProvider;
use Hanafalah\ModuleCardIdentity\Contracts;

class ModuleCardIdentityServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->registerMainClass(ModuleCardIdentity::class)
            ->registerCommandService(Providers\CommandServiceProvider::class)
            ->registers(['*']);
    }

    /**
     * Get the base path of the package.
     *
     * @return string
     */
    protected function dir(): string
    {
        return __DIR__ . '/';
    }

    protected function migrationPath(string $path = ''): string
    {
        return database_path($path);
    }
}
