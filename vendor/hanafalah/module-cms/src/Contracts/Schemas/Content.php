<?php

namespace Hanafalah\ModuleCms\Contracts\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\ModuleCms\Contracts\Data\ContentData;
use Illuminate\Database\Eloquent\Collection;

interface Content extends DataManagement
{
    public function getContent(): mixed;
    public function prepareShowContent(?Model $model = null, ?array $attributes = null): Model;
    public function showContent(?Model $model = null): array;
    public function prepareStoreContent(ContentData $employee_dto): Model;
    public function storeContent(? ContentData $employee_dto = null): array;
    public function prepareViewContentList(): Collection;
    public function viewContentList(): array;
    public function prepareDeleteContent(? array $attributes = null): bool;
    public function deleteContent(): bool;
    public function content(mixed $conditionals = null): Builder;
}
