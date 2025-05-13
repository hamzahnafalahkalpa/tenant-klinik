<?php

namespace Hanafalah\ModuleCms\Resources\EmployeeService;

use Hanafalah\LaravelSupport\Resources\ApiResource;

class ViewContent extends ApiResource
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'id'             => $this->id,
            'parent_id'      => $this->parent_id,
            'title'          => $this->title,
            'sub_title'      => $this->sub_title,
            'content'        => $this->content
        ];
        return $arr;
    }
}
