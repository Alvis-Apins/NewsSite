<?php

namespace App\Services;

use App\Repositories\WeatherApiRepository;

class WeatherDataService
{

  private WeatherApiRepository $weatherApiRepository;

  public function __construct(WeatherApiRepository $weatherApiRepository)
  {

    $this->weatherApiRepository = $weatherApiRepository;
  }

  public function getWeatherData(): array
  {
    return $this->weatherApiRepository->getWeatherData();
  }
}
