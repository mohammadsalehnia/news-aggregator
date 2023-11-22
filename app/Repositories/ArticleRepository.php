<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ArticleRepository extends Repository
{
    public function model(): string
    {
        return Article::class;
    }

    public function existsByUrl($url): bool
    {
        return $this->model::where('url', $url)->exists();
    }

    public function searchFilters($filters): Collection
    {

        // Build query based on the criteria
        $query = Article::query();

        // Apply filters using Filter classes
        $this->applyFilters($query, $filters);

        return $query->get();
    }

    protected function applyFilters($query, $filters): void
    {
        $filterNamespace = 'Filters';

        $filterClasses = collect(File::allFiles(app_path($filterNamespace)))
            ->map(function ($file) use ($filterNamespace) {
                return pathinfo($file->getPathname(), PATHINFO_FILENAME);
            });

        foreach ($filters as $filterName => $value) {
            $filterClassName = ucfirst(Str::camel($filterName)) . 'Filter';

            if ($filterClasses->contains($filterClassName)) {
                $filter = app()->make('App' . '\\' . 'Filters' . '\\' . $filterClassName);
                $filter->apply($query, $value);
            }
        }
    }

}
