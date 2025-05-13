<?php

namespace Hanafalah\ModuleCms\Data;

use Carbon\Carbon;
use Hanafalah\LaravelSupport\Supports\Data;
use Hanafalah\ModuleCms\Contracts\Data\ArticleData as DataArticleData;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Before;

class ArticleData extends Data implements DataArticleData{
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

    #[MapInputName('author_type')]
    #[MapName('author_type')]
    public ?string $author_type = null;

    #[MapInputName('author_id')]
    #[MapName('author_id')]
    public mixed $author_id = null;

    #[MapInputName('published_at')]
    #[MapName('published_at')]
    #[Before('tomorrow')]
    public ?Carbon $published_at = null;

    #[MapInputName('archived_at')]
    #[MapName('archived_at')]
    #[Before('tomorrow')]
    public ?Carbon $archived_at = null;

    #[MapInputName('content')]
    #[MapName('content')]
    public ?ContentData $content = null;
}