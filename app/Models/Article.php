<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'category', 'source', 'date', 'url', 'image_url', 'author'];

    public function scopeTitleLike(Builder $query, $title): void
    {
        $query->where('title', 'like', '%' . $title . '%');
    }

    public function scopeDateRange(Builder $query, $fromDate, $toDate): void
    {
        $query->whereBetween('date', [$fromDate, $toDate]);
    }

    public function scopeCategories(Builder $query, $categories): void
    {
        $query->whereIn('category', $categories);
    }

    public function scopeSources(Builder $query, $sources): void
    {
        $query->whereIn('source', $sources);
    }

    public function scopeAuthors(Builder $query, $authors): void
    {
        $query->whereIn('author', $authors);
    }

}
