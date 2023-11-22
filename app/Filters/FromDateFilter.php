<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class FromDateFilter implements FilterInterface
{

    public function apply(Builder $query, $value): Builder
    {
        return $query->where('created_at', '>=', $value);

    }
}
