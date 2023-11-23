<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SearchArticlesRequest;
use App\Services\ArticleService;
use Illuminate\Http\JsonResponse;

class ArticlesController extends Controller
{
    private ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function filter(SearchArticlesRequest $request): JsonResponse
    {
        $articles = $this->articleService->filter($request->all());
        return response()->json($articles);
    }
}
