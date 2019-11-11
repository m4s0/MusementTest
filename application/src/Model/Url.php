<?php

namespace App\Model;

use DateTime;

class Url
{
    public const CHANGE_FREQ = [
        self::ALWAYS,
        self::HOURLY,
        self::DAILY,
        self::WEEKLY,
        self::MONTHLY,
        self::YEARLY,
        self::NEVER
    ];

    public const ALWAYS  = 'always';
    public const HOURLY  = 'hourly';
    public const DAILY   = 'daily';
    public const WEEKLY  = 'weekly';
    public const MONTHLY = 'monthly';
    public const YEARLY  = 'yearly';
    public const NEVER   = 'never';

    /**
     * @var string
     */
    private $loc;
    /**
     * @var DateTime
     */
    private $lastmod;
    /**
     * @var string
     */
    private $changefreq;
    /**
     * @var float
     */
    private $priority;

    public function __construct(
        string $loc,
        DateTime $lastmod,
        string $changefreq = null,
        float $priority = null
    ) {
        if (null !== $changefreq && !in_array($changefreq, self::CHANGE_FREQ, true)) {
            throw new \DomainException(sprintf('changefreq %s is not allowed', $changefreq));
        }

        $this->loc        = $loc;
        $this->lastmod    = $lastmod;
        $this->changefreq = $changefreq;
        $this->priority   = $priority;

        if ($this->priority > 1) {
            $this->priority = 1;
        }
        if ($this->priority < 0) {
            $this->priority = 0;
        }
    }

    /**
     * @return string
     */
    public function getLoc(): string
    {
        return $this->loc;
    }

    /**
     * @return string
     */
    public function getLastmod(): string
    {
        return $this->lastmod->format(DateTime::ATOM);
    }

    /**
     * @return string
     */
    public function getChangefreq(): string
    {
        return $this->changefreq;
    }

    /**
     * @return string
     */
    public function getPriority(): string
    {
        return (string)round($this->priority, 1);
    }
}