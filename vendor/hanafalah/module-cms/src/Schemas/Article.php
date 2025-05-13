<?php

namespace Hanafalah\ModuleCms\Schemas;

use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleCms\Contracts\Schemas\Article as ContractsArticle;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleCms\Contracts\Data\ArticleData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Article extends PackageManagement implements ContractsArticle
{
    protected string $__entity = 'Article';
    public static $article_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'article',
            'tags'     => ['article', 'article-index'],
            'duration' => 60 * 24 * 7
        ]
    ];

    protected function viewUsingRelation(): array{
        return [];
    }

    protected function showUsingRelation(): array{
        return [
            'contents'
        ];
    }

    public function getArticle(): mixed{
        return static::$article_model;
    }

    public function prepareShowArticle(?Model $model = null, ?array $attributes = null): Model{
        $attributes ??= request()->all();

        $model ??= $this->getArticle();
        if (!isset($model)) {
            $id       = $attributes['id'] ?? null;
            if (!$id) throw new \Exception('id is not found');

            $model = $this->article()->findOrFail($id);            
        } else {
            $model->load($this->showUsingRelation());
        }
        return static::$article_model = $model;
    }    

    public function showArticle(?Model $model = null): array{
        return $this->showEntityResource(function() use ($model){
            return $this->prepareShowArticle($model);
        });
    }

    protected function prepareStore(mixed $model_dto): Model{
        $article = $this->article()->updateOrCreate([
            'id' => $model_dto->id ?? null
        ],[
            'parent_id'      => $model_dto->parent_id ?? null, 
            'title'          => $model_dto->title ?? 'Untitled', 
            'sub_title'      => $model_dto->sub_title ?? null, 
            'author_type'    => $model_dto->author_type ?? null, 
            'author_id'      => $model_dto->author_id ?? null, 
            'published_at'   => $model_dto->published_at ?? null, 
            'archived_at'    => $model_dto->archived_at ?? null
        ]);

        foreach ($model_dto->props as $key => $prop) $article->{$key} = $prop;
        $article->save();

        if (isset($model_dto->content)) {
            $content_dto = &$model_dto->content;
            $content_dto->reference_id   = $article->getKey();
            $content_dto->reference_type = $article->getMorphClass();
            $this->schemaContract('content')->prepareStoreContent($content_dto);
        }
        return $article;
    }

    public function prepareStoreArticle(ArticleData $article_dto): Model{
        $article = $this->prepareStore($article_dto); 
        return static::$article_model = $article;
    }

    public function storeArticle(? ArticleData $article_dto = null): array{
        return $this->transaction(function () use ($article_dto) {
            return $this->showArticle($this->prepareStoreArticle($article_dto ?? $this->requestDTO(ArticleData::class)));
        });
    }

    public function prepareViewArticlePaginate(PaginateData $paginate_dto): LengthAwarePaginator{
        return $this->article()->with($this->viewUsingRelation())->paginate(...$paginate_dto->toArray())->appends(request()->all());
    }

    public function viewArticlePaginate(? PaginateData $paginate_dto = null): array{
        return $this->viewEntityResource(function() use ($paginate_dto){            
            return $this->prepareViewArticlePaginate($paginate_dto ?? $this->requestDTO(PaginateData::class));
        });
    }

    public function prepareViewArticleList(): Collection{
        return $this->article()->with($this->viewUsingRelation())->get();
    }

    public function viewArticleList(): array{
        return $this->viewEntityResource(function(){
            return $this->prepareViewArticleList();
        });
    }

    public function prepareDeleteArticle(? array $attributes = null): bool{
        $attributes ??= request()->all();
        if (!isset($attributes['id'])) throw new \Exception('id not found');

        $article = $this->article()->findOrFail($attributes['id']);
        return $article->delete();
    }

    public function deleteArticle(): bool{
        return $this->transaction(function(){
            return $this->prepareDeleteArticle();
        });
    }

    public function article(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->{$this->__entity.'Model'}()->conditionals($this->mergeCondition($conditionals))->withParameters()->orderBy('created_at','desc');
    }
}

