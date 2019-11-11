<?php

namespace App\Tests\Mock\HttpClient;

use App\HttpClient\MusementClientInterface;
use App\Model\Activity;
use App\Model\City;
use Generator;

class MusementClient implements MusementClientInterface
{
    public function getCities(
        string $locale,
        int $offset,
        int $limit
    ): ?Generator {
        $cities = file_get_contents('tests/Mock/HttpClient/json/cities.json');

        foreach (json_decode($cities, true) as $city) {
            yield new City($city);
        }
    }

    public function getCityActivities(
        string $locale,
        string $city,
        int $offset,
        int $limit
    ): ?Generator {
        $activities = '{}';

        if ($city === '57') {
            $activities = file_get_contents('tests/Mock/HttpClient/json/amsterdam_activities.json');
        }
        if ($city === '40') {
            $activities = file_get_contents('tests/Mock/HttpClient/json/paris_activities.json');
        }
        if ($city === '2') {
            $activities = file_get_contents('tests/Mock/HttpClient/json/rome_activities.json');
        }

        foreach (json_decode($activities, true)['data'] as $activity) {
            yield new Activity($activity);
        }
    }
}