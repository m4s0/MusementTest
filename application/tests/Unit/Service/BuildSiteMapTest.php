<?php

use App\HttpClient\MusementClient;
use App\Model\Activity;
use App\Model\City;
use App\Serializer\SiteMapSerializer;
use App\Service\BuildSiteMap;
use Coduo\PHPMatcher\PHPUnit\PHPMatcherAssertions;
use PHPUnit\Framework\TestCase;

class BuildSiteMapTest extends TestCase
{
    use PHPMatcherAssertions;

    /**
     * @test
     */
    public function shouldBuildASitemap()
    {
        $musementClient    = $this->prophesize(MusementClient::class);
        $siteMapSerializer = new SiteMapSerializer();
        $buildSiteMap      = new BuildSiteMap($musementClient->reveal(), $siteMapSerializer);

        $musementClient->getCities(BuildSiteMap::IT_LOCALE, 0, 2)->willReturn($this->getCities());
        $musementClient->getCityActivities(BuildSiteMap::IT_LOCALE, '1', 0, 2)->willReturn($this->getCityActivities());

        $expectedSitemap =
            '<?xml version="1.0" encoding="utf-8"?>
            <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
            <url>
                <loc>https://www.example.com/url</loc>
                <lastmod>@string@.isDateTime()</lastmod>
                <changefreq>always</changefreq>
                <priority>0.7</priority>
            </url>
            <url>
                <loc>https://www.example.com/url-2</loc>
                <lastmod>@string@.isDateTime()</lastmod>
                <changefreq>always</changefreq>
                <priority>0.5</priority>
            </url>
            <url>
                <loc>https://www.example.com/url-3</loc>
                <lastmod>@string@.isDateTime()</lastmod>
                <changefreq>always</changefreq>
                <priority>0.5</priority>
            </url>
            </urlset>';

        $this->assertMatchesPattern($expectedSitemap, $buildSiteMap->execute(BuildSiteMap::IT_LOCALE, 2, 2));
    }

    public function getCities()
    {
        yield new City([
            'id'  => 1,
            'url' => 'https://www.example.com/url',
        ]);
    }

    public function getCityActivities()
    {
        yield new Activity([
            'url' => 'https://www.example.com/url-2',
        ]);
        yield new Activity([
            'url' => 'https://www.example.com/url-3',
        ]);
    }
}
