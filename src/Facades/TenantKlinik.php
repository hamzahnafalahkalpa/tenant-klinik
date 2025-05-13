<?php

namespace GroupInitialKlinik\TenantKlinik\Facades;

class TenantKlinik extends \Illuminate\Support\Facades\Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor()
  {
    return \GroupInitialKlinik\TenantKlinik\Contracts\TenantKlinik::class;
  }
}
