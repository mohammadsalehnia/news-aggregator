<?php

namespace App\Services\ArticleDataProvider;

// Strategy design pattern
interface ArticleDataProviderInterface
{
    public function fetchData(): void;
}
