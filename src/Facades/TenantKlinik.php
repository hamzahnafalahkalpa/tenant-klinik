<?php

namespace Klinik\TenantKlinik\Facades;

class TenantKlinik extends \Illuminate\Support\Facades\Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor()
  {
    return \Klinik\TenantKlinik\Contracts\TenantKlinik::class;
  }
}
