<?php

namespace Klinik\TenantKlinik\Providers;

use Exception;
use Illuminate\Foundation\Http\Kernel;
use Hanafalah\LaravelSupport\{
    Concerns\NowYouSeeMe,
    Supports\PathRegistry
};
use Illuminate\Support\Str;
use Klinik\TenantKlinik\{
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
        $this->app->booted(function(){
            $this->registers([
                '*',
                'Config' => function() {
                    $this->__config_tenant_klinik = config('tenant-klinik');
                },
                'Provider' => function() {
                    $model = Facades\TenantKlinik::myModel($this->WorkspaceModel()->find(TenantKlinik::ID));
                    if (!isset($model)) throw new Exception('TenantKlinik Model not found');
                    $config_name = Str::kebab($model->name);
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
        });
    }
}
