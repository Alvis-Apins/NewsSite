<?php

namespace App\Services;

use App\Repositories\AddArticleRepository;

class AddArticleService
{

  private AddArticleRepository $addArticleRepository;

  public function __construct(AddArticleRepository $addArticleRepository)
  {
    $this->addArticleRepository = $addArticleRepository;
  }

  public function execute(AddArticleServiceRequest $addArticleServiceRequest): void
  {
    $this->addArticleRepository->addArticle($addArticleServiceRequest);
  }

}
