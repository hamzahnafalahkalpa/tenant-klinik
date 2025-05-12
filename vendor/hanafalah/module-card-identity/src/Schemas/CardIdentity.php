<?php

namespace Hanafalah\ModuleCardIdentity\Schemas;

use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleCardIdentity\{
    Supports\BaseModuleCardIdentity
};
use Hanafalah\ModuleCardIdentity\Contracts\Schemas\CardIdentity as ContractsCardIdentity;
use Hanafalah\ModuleCardIdentity\Contracts\Data\CardIdentityData;

class CardIdentity extends BaseModuleCardIdentity implements ContractsCardIdentity
{
    protected string $__entity = 'CardIdentity';
    public static $card_identity_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'card_identity',
            'tags'     => ['card_identity', 'card_identity-index'],
            'duration' => 24 * 60
        ]
    ];

    public function prepareStoreCardIdentity(CardIdentityData $card_identity_dto): Model{
        $add = [
            'reference_type' => $card_identity_dto->reference_type,
            'reference_id'   => $card_identity_dto->reference_id,
            'flag'           => $card_identity_dto->flag
        ];
        if (isset($card_identity_dto->id)) {
            $guard        = ['id' => $card_identity_dto->id];
            $add['value'] = $card_identity_dto->value;
        }else{
            $guard = $add;
            $add = ['value' => $card_identity_dto->value];
        }
        $card_identity = $this->usingEntity()->updateOrCreate($guard,$add);
        return static::$card_identity_model = $card_identity;
    }
}