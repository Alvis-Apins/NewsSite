<?php

namespace App\Repositories;

use App\Models\ArticleContents;
use App\Services\AddArticleServiceRequest;
use Doctrine\DBAL\DriverManager;
use Exception;

class AddArticleRepository
{

  public function addArticle(AddArticleServiceRequest $addArticleServiceRequest)
  {
    $connectionParams = [
      'dbname' => 'Articles',
      'user' => $_ENV["MYSQL_USER"],
      'password' => $_ENV["MYSQL_PASS"],
      'host' => 'localhost',
      'driver' => 'pdo_mysql',
    ];

    $conn = DriverManager::getConnection($connectionParams);
    try {
      if ($conn->connect()) {
        $conn->insert('news_articles', [
          'title' => $addArticleServiceRequest->getTitle(),
          'url' => $addArticleServiceRequest->getUrl(),
          'picture_url' => $addArticleServiceRequest->getPictureUrl(),
          'content' => $addArticleServiceRequest->getContent()
        ]);
      }
    } catch (Exception $e) {
      echo "Failed connection to Database";
    }
  }

  public function getArticles()
  {
    $connectionParams = [
      'dbname' => 'Articles',
      'user' => $_ENV["MYSQL_USER"],
      'password' => $_ENV["MYSQL_PASS"],
      'host' => 'localhost',
      'driver' => 'pdo_mysql',
    ];

    $conn = DriverManager::getConnection($connectionParams);
    try {
      if ($conn->connect()) {
        $queryBuilder = $conn->createQueryBuilder();
        $response = $queryBuilder
          ->select('*')
          ->from('news_articles')
          ->executeQuery();
      }
    } catch (Exception $e) {
      echo "Failed connection to Database";
    }

    $articles = [];
    foreach ($response->fetchAllAssociative() as $article) {
      $article['content'] = substr($article['content'], 0, 400) . "...";

      $articles[] = new ArticleContents(
        $article['title'],
        $article['content'],
        $article['created_at'],
        $article['picture_url'],
        $article = 'Self published',
        $article['url']
      );
    }
    return $articles;
  }
}

