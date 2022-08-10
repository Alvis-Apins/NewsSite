<?php

namespace App\Repositories;

use App\Models\ArticleContents;
use GuzzleHttp\Client;

class NewsDataApiRepository implements ArticlesRepository
{
  private array $categories = [
    'all' => '&country=lv&language=lv',
    'fireman' => '&q=VUGD&country=lv',
    'police' => '&q=Policija&country=lv',
    'environment' => '&country=lv&category=environment'
  ];

  public function getArticles(string $category): array
  {
    $client = new Client();
    $response = $client->request('GET', 'https://newsdata.io/api/1/news?apikey=' . $_ENV["NEWS_API_KEY"] . $this->categories[$category]);
    $newsData = $response->getBody();
    $newsData = json_decode($newsData);

    $articles = [];
    foreach ($newsData->results as $article) {

      if ($article->content == null) {
        $article->content = $article->description;
      }
      if ($article->image_url == null) {
        $article->image_url = " no picture ";
      }
      $article->content = substr($article->content, 0, 400) . "...";

      $articles[] = new ArticleContents(
        $article->title,
        $article->content,
        $article->pubDate,
        $article->image_url,
        $article->source_id,
        $article->link
      );
    }
    return $articles;
  }
}
