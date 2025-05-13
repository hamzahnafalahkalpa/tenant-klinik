<?php

namespace Hanafalah\ModuleCms\Models\CPT;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleCms\Concerns\HasContent;
use Hanafalah\ModuleCms\Enums\Article\Flag;
use Hanafalah\ModuleCms\Enums\Article\Status;
use Hanafalah\ModuleCms\Resources\EmployeeService\{
    ViewArticle, ShowArticle
};
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends BaseModel{
    use HasUlids, SoftDeletes, HasProps, HasContent;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $list = [
        'id', 'article_code', 'parent_id', 'flag', 'title', 'sub_title', 
        'status','author_type', 'author_id', 'published_at', 
        'archived_at', 'props'
    ];

    public function getViewResource(){
        return ViewArticle::class;
    }

    public function getShowResource(){
        return ShowArticle::class;
    }

    public function scopePublished($builder){return $builder->where('status', Status::PUBLISHED);}
    public function scopeDraft($builder){return $builder->where('status', Status::DRAFT);}
    public function scopeArchived($builder){return $builder->whereNotNull('archived_at');}
    public function scopePost($builder){return $builder->where('flag', Flag::POST);}
    public function scopePage($builder){return $builder->where('flag', Flag::PAGE);}
    public function scopeAnnouncement($builder){return $builder->where('flag', Flag::ANNOUNCEMENT);}

    public function author(){return $this->morphTo();}
}