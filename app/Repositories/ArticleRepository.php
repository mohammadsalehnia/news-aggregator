<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Support\Collection;

class ArticleRepository extends Repository
{
    public function model(): string
    {
        return Article::class;
    }

    public function findByUrl($url)
    {
        return $this->model->whereUrl($url);
    }

    public function existsByUrl($url)
    {
        return $this->model::where('url', $url)->exists();
    }

    public function searchFilters($filters): Collection
    {

        // Build query based on the criteria
        $query = Article::query();

        if (isset($filters['title'])) {
            $query->titleLike($filters['title']);
        }

        if (isset($filters['from_date']) && isset($filters['to_date'])) {
            $query->dateRange($filters['from_date'], $filters['to_date']);
        }

        if (isset($filters['categories'])) {
            $query->categories($filters['categories']);
        }

        if (isset($filters['sources'])) {
            $query->sources($filters['sources']);
        }

        if (isset($filters['authors'])) {
            $query->authors($filters['authors']);
        }

        return $query->get();
    }
}
