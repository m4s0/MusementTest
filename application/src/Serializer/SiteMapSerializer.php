<?php

namespace App\Serializer;

use App\Model\SiteMap;

class SiteMapSerializer
{
    private const URLSET_START = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
    private const URLSET_END   = '</urlset>';
    private const XML_HEAD     = '<?xml version="1.0" encoding="utf-8"?>';

    public function serialize(SiteMap $siteMap): string
    {
        $xml = self::XML_HEAD . PHP_EOL . self::URLSET_START . PHP_EOL;

        foreach ($siteMap->getUrls() as $url) {
            $xml .= '<url>' . PHP_EOL;
            $xml .= '    <loc>' . $url->getLoc() . '</loc>' . PHP_EOL;
            $xml .= '    <lastmod>' . $url->getLastmod() . '</lastmod>' . PHP_EOL;
            $xml .= '    <changefreq>' . $url->getChangefreq() . '</changefreq>' . PHP_EOL;
            $xml .= '    <priority>' . $url->getPriority() . '</priority>' . PHP_EOL;
            $xml .= '</url>';
            $xml .= PHP_EOL;
        }

        $xml .= self::URLSET_END;

        return $xml;
    }
}