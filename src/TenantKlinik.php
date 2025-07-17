<?php

namespace GroupInitialKlinik\TenantKlinik;

use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\{
    Concerns\Support\HasRepository,
    Supports\PackageManagement,
    Events as SupportEvents
};
use GroupInitialKlinik\TenantKlinik\Contracts\TenantKlinik as ContractsTenantKlinik;

class TenantKlinik extends PackageManagement implements ContractsTenantKlinik{
    use Supports\LocalPath,HasRepository;

    const LOWER_CLASS_NAME = "tenant_klinik";
    const SERVICE_TYPE     = "tenant";
    const ID               = "3";

    public ?Model $model;

    public function events(){
        return [
            SupportEvents\InitializingEvent::class => [
                
            ],
            SupportEvents\EventInitialized::class  => [],
            SupportEvents\EndingEvent::class       => [],
            SupportEvents\EventEnded::class        => [],
            //ADD MORE EVENTS
        ];
    }

    protected function dir(): string{
        return __DIR__;
    }
}
