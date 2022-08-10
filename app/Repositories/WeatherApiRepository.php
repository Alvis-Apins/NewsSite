<?php

namespace App\Repositories;

use App\Models\WeatherReport;
use Dotenv\Dotenv;
use GuzzleHttp\Client;

class WeatherApiRepository
{

  public function getWeatherData(): array
  {
    date_default_timezone_set("Europe/Riga");

    $dotenv = Dotenv::createImmutable("/home/apo/PhpstormProjects/newsSite");
    $dotenv->load();

    $client = new Client();
    $response = $client->request('GET', 'http://api.weatherapi.com/v1/forecast.json?key=' . $_ENV["WEATHER_API_KEY"] . '&q=Staicele&days=2&aqi=no&alerts=no');
    $weatherData = $response->getBody();
    $weatherData = json_decode($weatherData);

    $h = date("H");
    $weatherReportData = [];

    if ($h < 12) {
      $yesterday = date('Y-m-d', strtotime("-1 days"));
      $weatherDataDayBefore = file_get_contents("http://api.weatherapi.com/v1/history.json?key=bb54d2efdf464be9963180655222107&q=Staicele&dt=$yesterday");
      $weatherDataDayBefore = json_decode($weatherDataDayBefore);

      for ($i = 23 - (12 - $h); $i <= 23; $i++) {
        $weatherReportData[] = new WeatherReport(
          $weatherDataDayBefore->location->name,
          $weatherDataDayBefore->forecast->forecastday[0]->hour[$i]->time,
          $weatherDataDayBefore->forecast->forecastday[0]->hour[$i]->temp_c,
          $weatherDataDayBefore->forecast->forecastday[0]->hour[$i]->condition->text,
          $weatherDataDayBefore->forecast->forecastday[0]->hour[$i]->wind_kph,
          $weatherDataDayBefore->forecast->forecastday[0]->hour[$i]->condition->icon,
          $weatherDataDayBefore->forecast->forecastday[0]->hour[$i]->humidity,
          $weatherDataDayBefore->forecast->forecastday[0]->hour[$i]->uv
        );
      }
      for ($i = 0; $i <= 23 - (12 - $h); $i++) {
        $weatherReportData[] = new WeatherReport(
          $weatherData->location->name,
          $weatherData->forecast->forecastday[0]->hour[$i]->time,
          $weatherData->forecast->forecastday[0]->hour[$i]->temp_c,
          $weatherData->forecast->forecastday[0]->hour[$i]->condition->text,
          $weatherData->forecast->forecastday[0]->hour[$i]->wind_kph,
          $weatherData->forecast->forecastday[0]->hour[$i]->condition->icon,
          $weatherData->forecast->forecastday[0]->hour[$i]->humidity,
          $weatherData->forecast->forecastday[0]->hour[$i]->uv
        );
      }
    } else {
      $hourFix = 0;
      $day = 0;
      for ($i = $h - 12; $i <= $h + 12; $i++) {
        $weatherReportData[] = new WeatherReport(
          $weatherData->location->name,
          $weatherData->forecast->forecastday[$day]->hour[$i - $hourFix]->time,
          $weatherData->forecast->forecastday[$day]->hour[$i - $hourFix]->temp_c,
          $weatherData->forecast->forecastday[$day]->hour[$i - $hourFix]->condition->text,
          $weatherData->forecast->forecastday[$day]->hour[$i - $hourFix]->wind_kph,
          $weatherData->forecast->forecastday[$day]->hour[$i - $hourFix]->condition->icon,
          $weatherData->forecast->forecastday[$day]->hour[$i - $hourFix]->humidity,
          $weatherData->forecast->forecastday[$day]->hour[$i - $hourFix]->uv
        );

        if ($i == 23) {
          $day++;
          $hourFix += 24;
        }
      }
    }
    return $weatherReportData;
  }
}
