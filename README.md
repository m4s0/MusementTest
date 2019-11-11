# MusementTest

#### Docker

Build container
```
docker build
```

Run container
```
docker-composer up -d
```

Enter to php container
```
docker-compose run php bash
```

#### Tests

Enter to php container
```
docker-compose run php bash
```

Run unit tests
```
bin/phpunit
```

Run behat tests
```
./vendor/bin/behat
```

#### Symfony Command

How to use BuildSiteMapCommand
```
$ bin/console app:build-sitemap -l it-IT
```

#### BuildSiteMap Service

How to use BuildSiteMap Service
```
<?php

require './vendor/autoload.php';

use App\HttpClient\MusementClient;
use App\Service\BuildSiteMap;
use Symfony\Component\HttpClient\CurlHttpClient;

$httpClient      = new CurlHttpClient();
$musementClient  = new MusementClient($httpClient);
$buildSiteMap    = new BuildSiteMap($musementClient);
$citiesLimit     = 10;
$activitiesLimit = 10;

$siteMap = $buildSiteMap->execute('it-IT', $citiesLimit, $activitiesLimit);

file_put_contents('sitemap.xml', $siteMap);
```
