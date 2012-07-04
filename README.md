

Add this to routes.php.

    // Needed to support sitemap.xml and sitemap.xml.gz
    // should be improved :)
    'sitemap.xml|sitemap.xml.gz|robots.txt' => 'sitemap/index',

Controller:

    <?php

    \Package::load('sitemap');

    class Controller_Sitemap extends \Sitemap\Controller {

    	private function _sitemap()
    	{
    		// Maybe do an HMVC request from here...?
    		return 'controller _sitemap.xml(.gz)';
    	}

    	private function _robots()
    	{
    		return 'controller robots.txt';
    	}

    }
