<?php

namespace App\Tests\Unit\Model;

use App\Model\City;
use PHPUnit\Framework\TestCase;

class CityTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateAValidCity()
    {
        $city = new City(
            [
                'id'  => 1,
                'url' => 'url'
            ]
        );

        $this->assertEquals(1, $city->getId());
        $this->assertEquals('url', $city->getUrl());
    }
}
