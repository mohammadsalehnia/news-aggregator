<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class AuthorsFilter implements FilterInterface
{

    public function apply(Builder $query, $value): Builder
    {
        return $query->whereIn('author', $value);
    }
}
