<?php

namespace App\HttpClient;

use App\Model\Activity;
use App\Model\City;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MusementClient implements MusementClientInterface
{
    public const CITIES_ENDPOINT            = 'https://api.musement.com/api/v3/cities';
    public const CITIES_ACTIVITIES_ENDPOINT = 'https://api.musement.com/api/v3/cities/{ID}/activities';

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getCities(
        string $locale,
        int $offset,
        int $limit
    ): ?\Generator {
        $response = $this->httpClient->request(
            Request::METHOD_GET,
            self::CITIES_ENDPOINT,
            [
                'headers' => [
                    'Accept-Language' => $locale,
                ],
                'query'   => [
                    'offset' => $offset,
                    'limit'  => $limit,
                ],
            ]
        );

        foreach ($response->toArray() as $city) {
            yield new City($city);
        }
    }

    public function getCityActivities(
        string $locale,
        string $city,
        int $offset,
        int $limit
    ): ?\Generator {
        $url = str_replace('{ID}', $city, self::CITIES_ACTIVITIES_ENDPOINT);

        $response = $this->httpClient->request(
            Request::METHOD_GET,
            $url,
            [
                'headers' => [
                    'Accept-Language' => $locale,
                ],
                'query'   => [
                    'offset' => $offset,
                    'limit'  => $limit,
                ],
            ]
        );

        foreach ($response->toArray()['data'] as $activity) {
            yield new Activity($activity);
        }
    }
}