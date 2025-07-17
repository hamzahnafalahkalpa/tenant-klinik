<?php

namespace GroupInitialKlinik\TenantKlinik\Providers;

use Exception;
use Illuminate\Foundation\Http\Kernel;
use Hanafalah\LaravelSupport\{
    Concerns\NowYouSeeMe,
    Supports\PathRegistry
};
use Illuminate\Support\Str;
use GroupInitialKlinik\TenantKlinik\{
    TenantKlinik,
    Contracts,
    Facades
};
use Hanafalah\LaravelSupport\Middlewares\PayloadMonitoring;

class TenantKlinikServiceProvider extends TenantKlinikEnvironment
{
    use NowYouSeeMe;

    public function register()
    {
        $this->registerMainClass(TenantKlinik::class)
             ->registerCommandService(CommandServiceProvider::class)
             ->registerServices(function(){
                 $this->binds([
                    Contracts\TenantKlinik::class => function(){
                        return new TenantKlinik;
                    },
                    //WorkspaceDTO\WorkspaceSettingData::class => WorkspaceSettingData::class
                ]);
            });
    }

    public function boot(Kernel $kernel){
        $kernel->pushMiddleware(PayloadMonitoring::class);
        // codes that will be run after the package booted
        $model   = Facades\TenantKlinik::myModel($this->TenantModel()->find(TenantKlinik::ID));
        $this->deferredProviders($model);

        // tenancy()->initialize(TenantKlinik::ID);
        // $tenant = tenancy()->tenant;
        // $tenant->save();

        $config_name = Str::kebab($model->name); 

        $this->registers([
            '*',
            'Config' => function() {
                $this->__config_tenant_klinik = config('tenant-klinik');
            },
            'Provider' => function() use ($model,$config_name){
                $this->bootedRegisters($model->packages, $config_name, __DIR__.'/../'.$this->__config_tenant_klinik['libs']['migration'] ?? 'Migrations');
                $this->registerOverideConfig($config_name,__DIR__.'/../'.$this->__config_tenant_klinik['libs']['config']);
            },
            'Model', 'Database'
        ]);
        $this->registerRouteService(RouteServiceProvider::class);

        $this->app->singleton(PathRegistry::class, function () {
            $registry = new PathRegistry();

            $config = config("tenant-klinik");
            foreach ($config['libs'] as $key => $lib) $registry->set($key, 'app/Tenants'.$lib);
            return $registry;
        });
    }
}
