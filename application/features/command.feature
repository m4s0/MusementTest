Feature:
  In order to create a SiteMap
  As a command
  I want to generate a sitemap.xml

  Scenario: It builds a sitemap.xml
    When run command 'app:build-sitemap --locale=it-IT'
    Then the output should be
    """
    <?xml version="1.0" encoding="utf-8"?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc>https://www.musement.com/it/amsterdam/</loc>
        <lastmod>@string@.isDateTime()</lastmod>
        <changefreq>always</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>https://www.musement.com/it/amsterdam/biglietti-salta-fila-al-museo-van-gogh-651/</loc>
        <lastmod>@string@.isDateTime()</lastmod>
        <changefreq>always</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>https://www.musement.com/it/amsterdam/biglietti-per-la-heineken-experience-2224/</loc>
        <lastmod>@string@.isDateTime()</lastmod>
        <changefreq>always</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>https://www.musement.com/it/amsterdam/ingresso-al-museo-di-van-gogh-e-crociera-sui-canali-di-amsterdam-27941/</loc>
        <lastmod>@string@.isDateTime()</lastmod>
        <changefreq>always</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>https://www.musement.com/it/parigi/</loc>
        <lastmod>@string@.isDateTime()</lastmod>
        <changefreq>always</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>https://www.musement.com/it/parigi/orsay-museum-ticket-with-downloadable-audioguide-152147/</loc>
        <lastmod>@string@.isDateTime()</lastmod>
        <changefreq>always</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>https://www.musement.com/it/parigi/biglietti-aperti-per-la-collezione-permanente-del-centre-pompidou-9462/</loc>
        <lastmod>@string@.isDateTime()</lastmod>
        <changefreq>always</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>https://www.musement.com/it/parigi/biglietti-per-1-giorno-a-disneyland-r-paris-9707/</loc>
        <lastmod>@string@.isDateTime()</lastmod>
        <changefreq>always</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>https://www.musement.com/it/roma/</loc>
        <lastmod>@string@.isDateTime()</lastmod>
        <changefreq>always</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>https://www.musement.com/it/roma/biglietti-salta-fila-per-musei-vaticani-e-cappella-sistina-1-58754/</loc>
        <lastmod>@string@.isDateTime()</lastmod>
        <changefreq>always</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>https://www.musement.com/it/roma/biglietti-d-ingresso-vip-per-il-colosseo-il-foro-romano-e-il-palatino-con-visita-guidata-opzionale-52933/</loc>
        <lastmod>@string@.isDateTime()</lastmod>
        <changefreq>always</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>https://www.musement.com/it/roma/tour-guidato-salta-fila-dei-musei-vaticani-cappella-sistina-e-basilica-di-san-pietro-20598/</loc>
        <lastmod>@string@.isDateTime()</lastmod>
        <changefreq>always</changefreq>
        <priority>0.5</priority>
    </url>
    </urlset>
    """
