<?php

namespace Hanafalah\ModuleCms\Resources\EmployeeService;

class ShowContent extends ViewContent
{
    public function toArray(\Illuminate\Http\Request $request): array
    {
        $arr = [
        ];
        $arr = array_merge(parent::toArray($request), $arr);
        return $arr;
    }
}
