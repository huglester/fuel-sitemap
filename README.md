

Add this to routes.php.

    // Needed to support sitemap.xml and sitemap.xml.gz
    // should be improved :)
    'sitemap.xml|sitemap.xml.gz|robots.txt' => 'sitemap/index',
