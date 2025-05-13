<?php

namespace Hanafalah\ModuleCms\Resources\EmployeeService;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewArticle extends ApiResource
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'id'           => $this->id, 
            'article_code' => $this->article_code,
            'parent_id'    => $this->parent_id, 
            'flag'         => $this->flag,
            'title'        => $this->title, 
            'sub_title'    => $this->sub_title, 
            'author'       => $this->prop_author,
            'published_at' => $this->published_at, 
            'archived_at'  => $this->archived_at
        ];
        return $arr;
    }
}
