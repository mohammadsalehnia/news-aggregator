<?php

namespace App\Services\ArticleDataProvider;

class ArticleDataProviderContext
{
    // context class

    protected ArticleDataProviderInterface $provider;

    public function setProvider(ArticleDataProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    public function fetchData(): void
    {
        $this->provider->fetchData();
    }
}
