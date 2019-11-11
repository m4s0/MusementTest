<?php

namespace App\Tests\Unit\HttpClient;

use App\HttpClient\MusementClient;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class MusementClientTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGetCities()
    {
        $httpClient = $this->prophesize(HttpClientInterface::class);
        $musementClient = new MusementClient($httpClient->reveal());

        $locale = 'it-IT';
        $offset = 0;
        $limit  = 20;

        $response = $this->prophesize(ResponseInterface::class);
        $cities = [
            [
                'id'  => 1,
                'url' => 'https://url-1/'
            ],
            [
                'id'  => 2,
                'url' => 'https://url-2/'
            ]
        ];
        $response->toArray()->willReturn($cities);

        $httpClient->request(
            Request::METHOD_GET,
            MusementClient::CITIES_ENDPOINT,
            [
                'headers' => [
                    'Accept-Language' => $locale,
                ],
                'query'   => [
                    'offset' => $offset,
                    'limit'  => $limit,
                ],
            ]
        )->willReturn($response->reveal());

        $cities = [];
        foreach ($musementClient->getCities($locale, $offset, $limit) as $city) {
            $cities[] = $city;
        }

        Assert::assertCount(2, $cities);
        Assert::assertEquals(1, $cities[0]->getId());
        Assert::assertEquals('https://url-1/', $cities[0]->getUrl());
        Assert::assertEquals(2, $cities[1]->getId());
        Assert::assertEquals('https://url-2/', $cities[1]->getUrl());
    }

    /**
     * @test
     */
    public function shouldGetActivities()
    {
        $httpClient = $this->prophesize(HttpClientInterface::class);
        $musementClient = new MusementClient($httpClient->reveal());

        $locale = 'it-IT';
        $offset = 0;
        $limit  = 20;

        $response = $this->prophesize(ResponseInterface::class);
        $activities =
            [
                'data' =>
                    [
                        [
                            'url' => 'https://url-1/'
                        ],
                        [
                            'url' => 'https://url-2/'
                        ]
                    ]
            ];
        $response->toArray()->willReturn($activities);

        $httpClient->request(
            Request::METHOD_GET,
            str_replace('{ID}', '1', MusementClient::CITIES_ACTIVITIES_ENDPOINT),
            [
                'headers' => [
                    'Accept-Language' => $locale,
                ],
                'query'   => [
                    'offset' => $offset,
                    'limit'  => $limit,
                ],
            ]
        )->willReturn($response->reveal());

        $activities = [];
        foreach ($musementClient->getCityActivities($locale, '1', $offset, $limit) as $activity) {
            $activities[] = $activity;
        }

        Assert::assertCount(2, $activities);
        Assert::assertEquals('https://url-1/', $activities[0]->getUrl());
        Assert::assertEquals('https://url-2/', $activities[1]->getUrl());
    }
}
