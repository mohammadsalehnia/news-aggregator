<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class SourcesFilter implements FilterInterface
{

    public function apply(Builder $query, $value): Builder
    {
        return $query->whereIn('source', $value);
    }
}
