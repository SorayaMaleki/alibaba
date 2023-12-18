<?php

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Responses\StandardResponse;
use App\Models\Article;
use App\Services\ArticleService;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ArticlesController extends Controller
{
    use StandardResponse;

    private const ROUTE = 'articles.';

    /**
     * Injects the ArticleService into the controller.
     */
    public function __construct(public ArticleService $articleService)
    {
        $this->authorizeResource(Article::class, 'article');
    }

    /**
     * Display a listing of articles.
     *
     * @return View
     * @throws Exception
     */
    public function index(): View
    {
        $articles = $this->articleService->getAllArticles();
        return $this->viewResponse('index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new article.
     *
     * @return View
     */
    public function create(): View
    {
        return $this->viewResponse('create');

    }

    /**
     * Store a newly created article in storage.
     *
     * @param CreateRequest $request
     * @return View
     * @throws Exception
     */
    public function store(CreateRequest $request): View
    {
        $payload = $request->validated();
        $article = $this->articleService->createArticle($payload);
        return $this->viewResponse('show',
            ['article' => $article], 'The article has been stored');
    }

    /**
     * Display the specified article.
     *
     * @param Article $article
     * @return View
     */
    public function show(Article $article): View
    {
        $article = $this->articleService->findArticle($article);
        return $this->viewResponse('show',
            ['article' => $article]);
    }

    /**
     * Show the form for editing the specified article.
     *
     * @param Article $article
     * @return View
     */
    public function edit(Article $article): View
    {
        return $this->viewResponse('edit',
            ['article' => $article]);
    }

    /**
     * Update the specified article in storage.
     *
     * @param UpdateRequest $request
     * @param Article $article
     * @return RedirectResponse
     * @throws Exception
     */
    public function update(UpdateRequest $request, Article $article): RedirectResponse
    {
        $payload = $request->validated();
        $article = $this->articleService->updateArticle($payload, $article);
        return $this->redirectResponse('show',
            ['article' => $article], 'The article has been updated');
    }

    /**
     * Remove the specified article from storage.
     *
     * @param Article $article
     * @return RedirectResponse
     */
    public function destroy(Article $article): RedirectResponse
    {
        $this->articleService->deleteArticle($article);
        return $this->redirectResponse('index',
            [], "The article has been destroyed");
    }

    /**
     * Remove the specified article from storage.
     *
     * @param Article $article
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function approve(Article $article): RedirectResponse
    {
        $this->authorize('approve', $article);
        $this->articleService->approveArticle($article);
        return $this->redirectResponse('index',
            [], "The article has been approved");
    }

    /**
     * Remove the specified article from storage.
     *
     * @return View
     * @throws Exception
     */
    public function trashed(): View
    {
        $articles = $this->articleService->getTrashedArticles();
        return $this->viewResponse('trash', ['articles' => $articles]);

    }

    /**
     * restore the specified article from storage.
     *
     * @param  $article
     * @return RedirectResponse
     */
    public function restore($article): RedirectResponse
    {
        $this->articleService->restoreArticle($article);
        return $this->redirectResponse('trashed',
            [], "The article has been restored");
    }
}
