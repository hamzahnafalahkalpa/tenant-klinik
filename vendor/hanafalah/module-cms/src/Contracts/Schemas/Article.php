<?php

namespace Hanafalah\ModuleCms\Contracts\Schemas;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\LaravelSupport\Contracts\Supports\DataManagement;
use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\ModuleCms\Contracts\Data\ArticleData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface Article extends DataManagement
{
    public function getArticle(): mixed;
    public function prepareShowArticle(?Model $model = null, ?array $attributes = null): Model;
    public function showArticle(?Model $model = null): array;
    public function prepareStoreArticle(ArticleData $employee_dto): Model;
    public function storeArticle(? ArticleData $employee_dto = null): array;
    public function prepareViewArticlePaginate(PaginateData $paginate_dto): LengthAwarePaginator;
    public function viewArticlePaginate(? PaginateData $paginate_dto = null): array;
    public function prepareViewArticleList(): Collection;
    public function viewArticleList(): array;
    public function prepareDeleteArticle(? array $attributes = null): bool;
    public function deleteArticle(): bool;
    public function article(mixed $conditionals = null): Builder;
}
