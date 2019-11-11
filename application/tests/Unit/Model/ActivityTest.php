<?php

namespace App\Tests\Unit\Model;

use App\Model\Activity;
use PHPUnit\Framework\TestCase;

class ActivityTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateAValidActivity()
    {
        $activity = new Activity(
            [
                'url' => 'url'
            ]
        );

        $this->assertEquals('url', $activity->getUrl());
    }
}
