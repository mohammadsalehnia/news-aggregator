<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class TitleFilter implements FilterInterface
{

    public function apply(Builder $query, $value): Builder
    {
        return $query->where('title', 'like', '%' . $value . '%');
    }
}
