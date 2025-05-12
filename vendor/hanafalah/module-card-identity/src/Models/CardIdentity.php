<?php

namespace Hanafalah\ModuleCardIdentity\Models;

use Hanafalah\LaravelSupport\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hanafalah\ModuleCardIdentity\Resources\CardIdentity\{
    ViewCardIdentity,
    ShowCardIdentity
};

class CardIdentity extends BaseModel
{
    use SoftDeletes;
    
    protected $list = ['id', 'reference_type', 'reference_id', 'flag', 'value'];

    protected $casts = [
        'flag'  => 'string',
        'value' => 'string'
    ];

    public function viewUsingRelation(): array{
        return [];
    }

    public function showUsingRelation(): array{
        return [];
    }

    public function getViewResource(){
        return ViewCardIdentity::class;
    }

    public function getShowResource(){
        return ShowCardIdentity::class;
    }

    public function reference(){return $this->morphTo();}
}
