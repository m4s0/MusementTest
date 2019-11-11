<?php

namespace App\Service;

use App\HttpClient\MusementClientInterface;
use App\Model\Activity;
use App\Model\City;
use App\Model\SiteMap;
use App\Model\Url;
use App\Serializer\SiteMapSerializer;
use DateTime;
use DomainException;

class BuildSiteMap
{
    public const ALLOWED_LOCALE = [
        self::ES_LOCALE,
        self::FR_LOCALE,
        self::IT_LOCALE
    ];

    public const ES_LOCALE = 'es-ES';
    public const FR_LOCALE = 'fr-FR';
    public const IT_LOCALE = 'it-IT';

    /**
     * @var MusementClientInterface
     */
    private $musementClient;
    /**
     * @var SiteMapSerializer
     */
    private $siteMapSerializer;

    public function __construct(
        MusementClientInterface $musementClient,
        SiteMapSerializer $siteMapSerializer
    ) {
        $this->musementClient    = $musementClient;
        $this->siteMapSerializer = $siteMapSerializer;
    }

    public function execute(string $locale, int $citiesLimit, int $activitiesLimit): string
    {
        if (!in_array($locale, self::ALLOWED_LOCALE, true)) {
            throw new DomainException(sprintf('Locale %s is not allowed.', $locale));
        }

        $siteMap = new SiteMap();
        foreach ($this->musementClient->getCities($locale, 0, $citiesLimit) as $city) {
            /** @var City $city */
            $siteMap->addUrl(new Url($city->getUrl(), new DateTime(), Url::ALWAYS, 0.7));

            /** @var Activity $cityActivities */
            foreach ($this->musementClient->getCityActivities($locale, $city->getId(), 0, $activitiesLimit) as $cityActivities) {
                $siteMap->addUrl(new Url($cityActivities->getUrl(), new DateTime(), Url::ALWAYS, 0.5));
            }
        }

        return $this->siteMapSerializer->serialize($siteMap);
    }
}