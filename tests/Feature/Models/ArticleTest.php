<?php

namespace Tests\Feature\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase, ModelHelperTesting;

    protected function model(): Model
    {
//        $this->withoutExceptionHandling();
        return new Article();
    }
}
