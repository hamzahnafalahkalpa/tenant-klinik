<?php

namespace Hanafalah\ModuleCms\Resources\EmployeeService;

class ShowArticle extends ViewArticle
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
            'author' => $this->relationValidation('author', function () {
                return $this->author->toShowApi();
            }),
            'content' => $this->relationValidation('content', function () {
                return $this->content->toShowApi();
            })
        ];
        $arr = array_merge(parent::toArray($request), $arr);
        return $arr;
    }
}
