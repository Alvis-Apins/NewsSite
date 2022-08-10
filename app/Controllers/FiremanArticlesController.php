<?php

namespace App\Controllers;

use App\Services\AllArticlesService;
use App\Services\WeatherDataService;
use App\Views\View;

class FiremanArticlesController
{

  private AllArticlesService $allArticlesService;
  private WeatherDataService $weatherDataService;

  public function __construct(AllArticlesService $allArticlesService, WeatherDataService $weatherDataService)
  {
    $this->allArticlesService = $allArticlesService;
    $this->weatherDataService = $weatherDataService;
  }

  public function getAllArticles(): View
  {
    return new View('all-news-report.twig', [
      'articles' => $this->allArticlesService->getArticlesData('fireman'),
      'weatherData' => $this->weatherDataService->getWeatherData()
    ]);
  }

}
