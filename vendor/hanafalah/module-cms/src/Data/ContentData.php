<?php

namespace Hanafalah\ModuleCms\Data;

use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleCms\Contracts\Data\ContentData as DataContentData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;

class ContentData extends Data implements DataContentData{
    #[MapInputName('id')]
    #[MapName('id')]
    public mixed $id = null;

    #[MapInputName('parent_id')]
    #[MapName('parent_id')]
    public mixed $parent_id = null;

    #[MapInputName('title')]
    #[MapName('title')]
    public string $title;

    #[MapInputName('sub_title')]
    #[MapName('sub_title')]
    public ?string $sub_title = null;

    #[MapInputName('content')]
    #[MapName('content')]
    public ?string $content = null;
}