<?php

namespace Hanafalah\ModuleCardIdentity\Supports;

use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\LaravelSupport\Supports\PackageManagement;

class BaseModuleCardIdentity extends PackageManagement implements DataManagement
{
    /** @var array */
    protected $__module_card_identity_config = [];

    /**
     * A description of the entire PHP function.
     *
     * @param Container $app The Container instance
     * @throws Exception description of exception
     * @return void
     */
    public function __construct()
    {
        $this->setConfig('module-card-identity', $this->__module_card_identity_config);
    }
}
