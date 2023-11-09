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
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        }

        if (isset($filters['from_date']) && isset($filters['to_date'])) {
            $query->whereBetween('date', [$filters['from_date'], $filters['to_date']]);
        }

        if (isset($filters['categories']) ) {

            $query->whereIn('category', $filters['categories']);
        }

        if (isset($filters['sources'])) {

            $query->whereIn('source', $filters['sources']);
        }

        if (isset($filters['authors'])) {

            $query->whereIn('author', $filters['authors']);
        }


        return $query->get();
    }
}
