<?php

namespace App\Services\ArticleDataProvider;

use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NewYorkTimesDataProvider implements ArticleDataProviderInterface
{
    private string $apiKey = "v4H2REteYSUmUgYOWoCNPlUKVL1RqTN5";
    private string $baseUrl = "https://api.nytimes.com/svc";

    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function fetchData(): void
    {
        $url = $this->baseUrl . '/search/v2/articlesearch.json';

        // Set up parameters (adjust as needed)
        $params = [
            'api-key' => $this->apiKey,
//            'q' => 'your_search_query', // Replace with your search query
//            'page' => 1,  // Adjust for pagination
            'sort' => 'newest', // Specify the sort order

        ];

        $response = Http::get($url, $params);

        // Check if the request was successful (status code 200)
        if ($response->successful()) {
            // Parse and work with the response JSON
            $articles = $response->json()['response']['docs'];
            foreach ($articles as $articleItem) {

                $articleData = [];
                $articleData['date'] = $articleItem['pub_date'];
                $articleData['source'] = $articleItem['source'];
                $articleData['category'] = $articleItem['section_name'];
                $articleData['title'] = $articleItem['headline']['main'];
                $articleData['author'] = $this->getAuthor($articleItem);
                $articleData['url'] = $articleItem['web_url'];
                $articleData['image_url'] = $this->getImageUrl($articleItem);
                $articleData['content'] = $this->getContent($articleItem);

                if (!$this->articleRepository->existsByUrl($articleData['url'])) {
                    $this->articleRepository->create($articleData);
                }

            }

        } else {
            Log::error($response->body());
        }

    }


    private function getImageUrl($article): string
    {
        if (isset($article['multimedia'][0]['url'])) {
            return 'https://www.nytimes.com/' . $article['multimedia'][0]['url'];
        }

        return 'N/A';
    }

    private function getAuthor($article): string
    {
        if (isset($article['byline']['original'])) {
            return $article['byline']['original'];
        }

        return 'N/A';
    }

    private function getContent($article): string
    {
        if (isset($article['lead_paragraph'])) {
            return $article['lead_paragraph'];
        } elseif (isset($article['abstract'])) {
            return $article['abstract'];
        }

        return 'N/A';
    }
}
