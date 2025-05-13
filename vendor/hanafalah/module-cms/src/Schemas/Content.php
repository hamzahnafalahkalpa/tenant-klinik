<?php

namespace Hanafalah\ModuleCms\Schemas;

use Hanafalah\LaravelSupport\Contracts\Data\PaginateData;
use Hanafalah\LaravelSupport\Supports\PackageManagement;
use Hanafalah\ModuleCms\Contracts\Schemas\Content as ContractsContent;
use Illuminate\Database\Eloquent\Model;
use Hanafalah\ModuleCms\Contracts\Data\ContentData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class Content extends PackageManagement implements ContractsContent
{
    protected string $__entity = 'Content';
    public static $project_model;

    protected array $__cache = [
        'index' => [
            'name'     => 'project',
            'tags'     => ['project', 'project-index'],
            'duration' => 60 * 24 * 7
        ]
    ];

    protected function viewUsingRelation(): array{
        return [];
    }

    protected function showUsingRelation(): array{
        return [];
    }

    public function getContent(): mixed{
        return static::$project_model;
    }

    public function prepareShowContent(?Model $model = null, ?array $attributes = null): Model{
        $attributes ??= request()->all();

        $model ??= $this->getContent();
        if (!isset($model)) {
            $id       = $attributes['id'] ?? null;
            if (!$id) throw new \Exception('id is not found');

            $model = $this->project()->findOrFail($id);            
        } else {
            $model->load($this->showUsingRelation());
        }
        return static::$project_model = $model;
    }    

    public function showContent(?Model $model = null): array{
        return $this->showEntityResource(function() use ($model){
            return $this->prepareShowContent($model);
        });
    }

    public function prepareStoreContent(ContentData $project_dto): Model{
        $project = $this->project()->updateOrCreate([
            'id' => $project_dto->id ?? null
        ],[
            'name'      => $project_dto->name,
            'client_id' => $project_dto->client_id
        ]);

        foreach ($project_dto->props as $key => $prop){
            $project->{$key} = $prop;
        }

        $project->save();

        return static::$project_model = $project;
    }

    public function storeContent(? ContentData $project_dto = null): array{
        return $this->transaction(function () use ($project_dto) {
            return $this->showContent($this->prepareStoreContent($project_dto ?? $this->requestDTO(ContentData::class)));
        });
    }

    public function prepareViewContentPaginate(PaginateData $paginate_dto): LengthAwarePaginator{
        return $this->project()->with($this->viewUsingRelation())->paginate(...$paginate_dto->toArray())->appends(request()->all());
    }

    public function viewContentPaginate(? PaginateData $paginate_dto = null): array{
        return $this->viewEntityResource(function() use ($paginate_dto){            
            return $this->prepareViewContentPaginate($paginate_dto ?? $this->requestDTO(PaginateData::class));
        });
    }

    public function prepareViewContentList(): Collection{
        return $this->project()->with($this->viewUsingRelation())->get();
    }

    public function viewContentList(): array{
        return $this->viewEntityResource(function(){
            return $this->prepareViewContentList();
        });
    }

    public function prepareDeleteContent(? array $attributes = null): bool{
        $attributes ??= request()->all();
        if (!isset($attributes['id'])) throw new \Exception('id not found');

        $project = $this->project()->findOrFail($attributes['id']);
        return $project->delete();
    }

    public function deleteContent(): bool{
        return $this->transaction(function(){
            return $this->prepareDeleteContent();
        });
    }

    public function content(mixed $conditionals = null): Builder{
        $this->booting();
        return $this->ContentModel()->conditionals($this->mergeCondition($conditionals))->withParameters()->orderBy('created_at','desc');
    }
}

