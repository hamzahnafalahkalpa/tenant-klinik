<?php

namespace Hanafalah\ModuleCardIdentity\Contracts\Schemas;

use Hanafalah\ModuleCardIdentity\Contracts\Data\CardIdentityData;
//use Hanafalah\ModuleCardIdentity\Contracts\Data\CardIdentityUpdateData;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @see \Hanafalah\ModuleCardIdentity\Schemas\CardIdentity
 * @method self conditionals(mixed $conditionals)
 * @method array updateCardIdentity(?CardIdentityData $card_identity_dto = null)
 * @method Model prepareUpdateCardIdentity(CardIdentityData $card_identity_dto)
 * @method bool deleteCardIdentity()
 * @method bool prepareDeleteCardIdentity(? array $attributes = null)
 * @method mixed getCardIdentity()
 * @method ?Model prepareShowCardIdentity(?Model $model = null, ?array $attributes = null)
 * @method array showCardIdentity(?Model $model = null)
 * @method Collection prepareViewCardIdentityList()
 * @method array viewCardIdentityList()
 * @method LengthAwarePaginator prepareViewCardIdentityPaginate(PaginateData $paginate_dto)
 * @method array viewCardIdentityPaginate(?PaginateData $paginate_dto = null)
 * @method array storeCardIdentity(?CardIdentityData $card_identity_dto = null);
 * @method Builder cardIdentity(mixed $conditionals = null);
 */

interface CardIdentity extends DataManagement
{
    public function prepareStoreCardIdentity(CardIdentityData $card_identity_dto): Model;
}