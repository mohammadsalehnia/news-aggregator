<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class CategoriesFilter implements FilterInterface
{

    public function apply(Builder $query, $value): Builder
    {
        return $query->whereIn('category', $value);
    }
}
