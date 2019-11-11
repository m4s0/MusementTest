<?php

use App\Model\Url;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateAValidUrl()
    {
        $url = new Url(
            'https://example.com/url1',
            new DateTime('01-01-2019'),
            Url::ALWAYS,
            0.891
        );

        Assert::assertEquals('https://example.com/url1', $url->getLoc());
        Assert::assertEquals('2019-01-01T00:00:00+00:00', $url->getLastmod());
        Assert::assertEquals('always', $url->getChangefreq());
        Assert::assertEquals('0.9', $url->getPriority());
    }

    /**
     * @test
     * @expectedException DomainException
     */
    public function shouldThowAnExceptionIfChangefreqIsNotValid()
    {
        new Url(
            'https://example.com/url',
            new DateTime('01-01-2019'),
            'not-valid',
            0.891
        );
    }

    /**
     * @test
     */
    public function shouldSetPriorityTo0IfLowerThan0()
    {
        $url = new Url(
            'https://example.com/url',
            new DateTime('01-01-2019'),
            Url::ALWAYS,
            -0.891
        );

        Assert::assertEquals('0', $url->getPriority());
    }

    /**
     * @test
     */
    public function shouldSetPriorityTo1IfGreaterThan1()
    {
        $url = new Url(
            'https://example.com/url',
            new DateTime('01-01-2019'),
            Url::ALWAYS,
            1.891
        );

        Assert::assertEquals('1', $url->getPriority());
    }
}
