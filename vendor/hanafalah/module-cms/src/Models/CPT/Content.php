<?php

namespace Hanafalah\ModuleCms\Models\CPT;

use Hanafalah\LaravelHasProps\Concerns\HasProps;
use Hanafalah\LaravelSupport\Models\BaseModel;
use Hanafalah\ModuleCms\Resources\EmployeeService\{
    ShowContent, ViewContent
};
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends BaseModel{
    use HasUlids, SoftDeletes, HasProps;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $list = [
        'id', 'parent_id', 'reference_type', 'reference_id', 
        'title', 'sub_title', 'content', 'props'
    ];

    public function reference(){return $this->morphTo();}

    public function getViewResource(){
        return ViewContent::class;
    }

    public function getShowResource(){
        return ShowContent::class;
    }

    public function recursiveChilds(){return $this->morphManyModel('Content','parent_id')->with('recursiveChilds');}
}