<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SearchArticlesRequest;
use App\Repositories\ArticleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    private ArticleRepository $articleRepository;

    /**
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }


    public function filter(SearchArticlesRequest $request): JsonResponse
    {
        $articles = $this->articleRepository->searchFilters($request->all());

        return response()->json($articles);
    }
}
