<?php

namespace App\Repositories;

interface ArticlesRepository
{
  public function getArticles(string $category):array;
}
