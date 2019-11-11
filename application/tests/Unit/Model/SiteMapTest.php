<?php

use App\Model\SiteMap;
use App\Model\Url;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class SiteMapTest extends TestCase
{
    /**
     * @test
     */
    public function shouldCreateAValidSiteMap()
    {
        $siteMap = new SiteMap();
        $siteMap->addUrl(
            new Url(
                'https://example.com/url',
                new DateTime('01-01-2019'),
                Url::ALWAYS,
                0.891
            )
        );

        Assert::assertCount(1, $siteMap->getUrls());
    }

    /**
     * @test
     */
    public function shouldAddAnUrlToASiteMap()
    {
        $siteMap = new SiteMap();
        $siteMap->addUrl(
            new Url(
                'https://example.com/url-1',
                new DateTime('01-01-2019'),
                Url::ALWAYS,
                0.891
            )
        );

        Assert::assertCount(1, $siteMap->getUrls());

        $siteMap->addUrl(
            new Url(
                'https://example.com/url-2',
                new DateTime('01-01-2019'),
                Url::ALWAYS,
                0.891
            )
        );

        Assert::assertCount(2, $siteMap->getUrls());
    }
}
