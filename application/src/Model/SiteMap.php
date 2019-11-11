<?php

namespace App\Model;

class SiteMap
{
    /**
     * @var Url[]
     */
    private $urls;

    public function __construct()
    {
        $this->urls = [];
    }

    /**
     * @param Url $url
     *
     * @return SiteMap
     */
    public function addUrl(Url $url): SiteMap
    {
        $this->urls[] = $url;

        return $this;
    }

    /**
     * @return Url[]
     */
    public function getUrls(): array
    {
        return $this->urls;
    }
}