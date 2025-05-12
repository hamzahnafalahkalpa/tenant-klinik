<?php

namespace Hanafalah\ModuleCardIdentity\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleCardIdentity\Contracts\Data\CardIdentityData as DataCardIdentityData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class CardIdentityData extends Data implements DataCardIdentityData
{
    #[MapInputName('id')]
    #[MapName('id')]
    public mixed $id = null;

    #[MapInputName('reference_type')]
    #[MapName('reference_type')]
    public string $reference_type;

    #[MapInputName('reference_id')]
    #[MapName('reference_id')]
    public mixed $reference_id;
}