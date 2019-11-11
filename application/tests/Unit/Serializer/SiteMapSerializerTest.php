<?php

namespace App\Tests\Unit\Serializer;

use App\Model\SiteMap;
use App\Model\Url;
use App\Serializer\SiteMapSerializer;
use DateTime;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class SiteMapSerializerTest extends TestCase
{
    /**
     * @test
     */
    public function shouldSerializeSiteMap()
    {
        $siteMap = new SiteMap();
        $siteMap->addUrl(
            new Url(
                'https://example.com/url-1',
                new DateTime('01-01-2019'),
                Url::ALWAYS,
                0.7
            )
        );

        Assert::assertCount(1, $siteMap->getUrls());

        $siteMap->addUrl(
            new Url(
                'https://example.com/url-2',
                new DateTime('01-01-2019'),
                Url::ALWAYS,
                0.5
            )
        );

        $expected =
            '<?xml version="1.0" encoding="utf-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<url>
    <loc>https://example.com/url-1</loc>
    <lastmod>2019-01-01T00:00:00+00:00</lastmod>
    <changefreq>always</changefreq>
    <priority>0.7</priority>
</url>
<url>
    <loc>https://example.com/url-2</loc>
    <lastmod>2019-01-01T00:00:00+00:00</lastmod>
    <changefreq>always</changefreq>
    <priority>0.5</priority>
</url>
</urlset>';

        $siteMapSerializer = new SiteMapSerializer();
        Assert::assertEquals($expected, $siteMapSerializer->serialize($siteMap));
    }
}
