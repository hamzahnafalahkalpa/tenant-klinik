<?php

namespace Hanafalah\ModuleCms;

use Hanafalah\LaravelSupport\Supports\PackageManagement;

class ModuleCms extends PackageManagement implements Contracts\ModuleCms
{
    /** @var array */
    protected $__module_project_config = [];

    /**
     * A description of the entire PHP function.
     *
     * @param Container $app The Container instance
     * @throws Exception description of exception
     * @return void
     */
    public function __construct()
    {
        $this->setConfig('module-cms', $this->__module_project_config);
    }
}
