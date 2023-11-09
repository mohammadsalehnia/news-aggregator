<?php

namespace App\Services\ArticleDataProvider;

use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TheGuardianDataProvider implements ArticleDataProviderInterface
{
    private string $apiKey = "b4e72857-e5a9-4c94-9a4f-51d182a5a960";
    private string $baseUrl = "https://content.guardianapis.com";

    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function fetchData(): void
    {
        // Set up parameters (adjust as needed)
        $params = [
            'api-key' => $this->apiKey,
            // Other parameters as needed
        ];

        // Make the request
        $response = Http::get($this->baseUrl . '/search', $params);

        // Check if the request was successful (status code 200)
        if ($response->successful()) {
            // Parse and work with the response JSON
            $articles = $response->json()['response']['results'];
            foreach ($articles as $article) {
                $articleData = [];

                $articleData['title'] = $article['webTitle'];
                $articleData['date'] = $article['webPublicationDate'];
                $articleData['source'] = $article['sectionName'];
                $articleData['category'] = $article['pillarName'];
                $articleData['author'] = $this->getAuthor($article);
                $articleData['url'] = $article['webUrl'];
                $articleData['image_url'] = $this->getImageUrl($article);
                $articleData['content'] = $this->getContent($article);

                if (!$this->articleRepository->existsByUrl($articleData['url'])) {
                    $this->articleRepository->create($articleData);
                }

            }
        } else {
            Log::error($response->body());
        }
    }


    private function getAuthor($article): string
    {
        if (isset($article['fields']['byline'])) {
            return $article['fields']['byline'];
        }

        return 'N/A';
    }

    private function getImageUrl($article): string
    {
        if (isset($article['fields']['thumbnail'])) {
            return $article['fields']['thumbnail'];
        }

        return 'N/A';
    }

    private function getContent($article): string
    {
        if (isset($article['fields']['body'])) {
            return $article['fields']['body'];
        }

        return 'N/A';
    }
}
