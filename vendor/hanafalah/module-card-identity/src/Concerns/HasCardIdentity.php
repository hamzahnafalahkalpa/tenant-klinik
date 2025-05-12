<?php

namespace Hanafalah\ModuleCardIdentity\Concerns;

trait HasCardIdentity
{

  public function getIdentityFlags(): array
  {
    return $this->identity_flags;
  }

  public function setCardIdentity($flag, $value)
  {
    if (isset($flag)) {
      return $this->cardIdentities()->updateOrCreate([
        'reference_id'   => $this->{$this->getKeyName()},
        'reference_type' => $this->getMorphClass(),
        'flag' => $flag
      ], [
        'value' => $value
      ]);
    } else {
      return null;
    }
  }

  public function cardIdentity()
  {
    return $this->morphOneModel('CardIdentity', 'reference');
  }
  public function cardIdentities()
  {
    return $this->morphManyModel('CardIdentity', 'reference');
  }
}
