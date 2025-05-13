<?php

namespace Hanafalah\ModuleCms\Concerns;

trait HasContent{
    public function content(){return $this->morphOneModel('Content','reference');}
    public function contents(){return $this->morphManyModel('Content','reference');}
}