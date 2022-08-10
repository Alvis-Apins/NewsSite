<?php

namespace App\Controllers;

use App\Services\AddArticleService;
use App\Services\AddArticleServiceRequest;
use App\Views\View;

class AddArticleController
{
  private AddArticleService $addArticleService;

  public function __construct(AddArticleService $addArticleService)
  {
    $this->addArticleService = $addArticleService;
  }

  public function addArticleView(): View
  {
    return new View('addArticle.twig', []);
  }

  public function addArticle()
  {
    $title = $_POST["title"];
    $url = $_POST["url"];
    $picture_url = $_POST["picture"];
    $content = $_POST["content"];

    $this->addArticleService->execute(new AddArticleServiceRequest($title, $url, $picture_url, $content));

    header('Location: /add-article');
  }
}
