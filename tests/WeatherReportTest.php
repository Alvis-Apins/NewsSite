<?php

use App\Models\WeatherReport;

test('Weather report model test', function () {
  $report = new WeatherReport(
    'Riga',
    '20.08.2022 01:25',
    17.6,
    'windy',
    15,
    'icon.png',
    0.86,
    4
  );

  expect($report->getLocation())->toEqual('Riga');
  expect($report->getDate())->toEqual('20.08.2022 01:25');
  expect($report->getTemperature())->toEqual(17.6);
  expect($report->getCondition())->toEqual('windy');
  expect($report->getWindSpeed())->toEqual(15);
  expect($report->getIcon())->toEqual('icon.png');
  expect($report->getHumidity())->toEqual(0.86);
  expect($report->getUv())->toEqual(4);

});
