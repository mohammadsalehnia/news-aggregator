<?php

namespace App\Services;

use App\Repositories\ArticleRepository;
use Illuminate\Support\Collection;

class ArticleService
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function filter(array $data): Collection
    {
        return $this->articleRepository->searchFilters($data);
    }
}
