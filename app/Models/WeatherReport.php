<?php

namespace App\Models;

class WeatherReport
{
  private string $date;
  private float $temperature;
  private string $condition;
  private string $icon;
  private string $location;
  private float $humidity;
  private int $uv;
  private float $windSpeed;

  public function __construct(string $location, string $date, float $temperature, string $condition, float $windSpeed, string $icon, float $humidity, int $uv)
  {
    $this->date = $date;
    $this->temperature = $temperature;
    $this->condition = $condition;
    $this->icon = $icon;
    $this->location = $location;
    $this->humidity = $humidity;
    $this->uv = $uv;
    $this->windSpeed = $windSpeed;
  }

  public function getDate(): string
  {
    return $this->date;
  }

  public function getTemperature(): float
  {
    return $this->temperature;
  }

  public function getCondition(): string
  {
    return $this->condition;
  }

  public function getIcon(): string
  {
    return $this->icon;
  }

  public function getHumidity(): float
  {
    return $this->humidity;
  }

  public function getLocation(): string
  {
    return $this->location;
  }

  public function getUv(): int
  {
    return $this->uv;
  }

  public function getWindSpeed(): float
  {
    return $this->windSpeed;
  }

}
