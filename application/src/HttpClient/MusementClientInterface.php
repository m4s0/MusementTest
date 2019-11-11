<?php

namespace App\HttpClient;

use Generator;

interface MusementClientInterface
{
    public function getCities(string $locale, int $offset, int $limit): ?Generator;

    public function getCityActivities(string $locale, string $city, int $offset, int $limit): ?Generator;
}