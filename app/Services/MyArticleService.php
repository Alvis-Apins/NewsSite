<?php

namespace App\Services;

use App\Repositories\AddArticleRepository;

class MyArticleService
{
  private AddArticleRepository $addArticleRepository;

  public function __construct(AddArticleRepository $addArticleRepository)
  {
    $this->addArticleRepository = $addArticleRepository;
  }

  public function execute(): array
  {
    return $this->addArticleRepository->getArticles();
  }

}
