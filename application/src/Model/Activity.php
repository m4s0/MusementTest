<?php

namespace App\Model;

class Activity
{
    /**
     * @var string
     */
    protected $url;

    public function __construct(array $cityActivities)
    {
        $this->url = (string)$cityActivities['url'];
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}