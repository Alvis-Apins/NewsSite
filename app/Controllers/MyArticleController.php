<?php

namespace App\Controllers;

use App\Services\MyArticleService;
use App\Services\WeatherDataService;
use App\Views\View;

class MyArticleController
{
  private MyArticleService $myArticleService;
  private WeatherDataService $weatherDataService;

  public function __construct(MyArticleService $myArticleService, WeatherDataService $weatherDataService)
  {

    $this->myArticleService = $myArticleService;
    $this->weatherDataService = $weatherDataService;
  }

  public function getMyArticles(): View
  {
    return new View('myl-news-report.twig', [
      'articles' => $this->myArticleService->execute(),
      'weatherData' => $this->weatherDataService->getWeatherData()
    ]);
  }

}
