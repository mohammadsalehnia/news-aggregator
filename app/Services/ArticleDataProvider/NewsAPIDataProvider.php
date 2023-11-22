<?php

namespace App\Services\ArticleDataProvider;

use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\Log;
use jcobhams\NewsApi\NewsApi;

class NewsAPIDataProvider implements ArticleDataProviderInterface
{
    private string $apiKey;
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->apiKey = env('NEWS_API_KEY');

    }

    public function fetchData(): void
    {
        try {
            $newsAPI = new NewsApi($this->apiKey);

//        I considered us for our default country

//        $countries = $newsAPI->getCountries();
//        $languages = $newsAPI->getLanguages();

            $categories = $newsAPI->getCategories();

            foreach ($categories as $category) {
                $topHeadlines = $newsAPI->getTopHeadlines(null, null, 'us', $category, 10, 1);
                foreach ($topHeadlines->articles as $articleItem) {

                    $articleData = [];

                    $articleData['source'] = $articleItem->source->name;
                    $articleData['author'] = htmlspecialchars($articleItem->author);
                    $articleData['title'] = htmlspecialchars($articleItem->title);
                    $articleData['content'] = htmlspecialchars($articleItem->description);
                    $articleData['url'] = $articleItem->url;
                    $articleData['image_url'] = $articleItem->urlToImage;
                    $articleData['date'] = $articleItem->publishedAt;
                    $articleData['category'] = $category;

                    if (!$this->articleRepository->existsByUrl($articleData['url'])) {
                        $this->articleRepository->create($articleData);
                    }
                }
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
