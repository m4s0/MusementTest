<?php

namespace App\Model;

class City
{
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $url;

    public function __construct(array $city)
    {
        $this->id  = (string)$city['id'];
        $this->url = (string)$city['url'];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}