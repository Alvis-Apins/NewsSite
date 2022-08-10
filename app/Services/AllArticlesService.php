<?php

namespace App\Services;

use App\Repositories\ArticlesRepository;

class AllArticlesService
{

  private ArticlesRepository $articlesRepository;

  public function __construct(ArticlesRepository $articlesRepository)
  {
    $this->articlesRepository = $articlesRepository;
  }

  public function getArticlesData(string $category): array
  {
    return $this->articlesRepository->getArticles($category);
  }
}
