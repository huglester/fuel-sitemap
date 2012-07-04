

Add this to routes.php.

    // Needed to support sitemap.xml and sitemap.xml.gz
    // should be improved :)
    'sitemap.xml|sitemap.xml.gz|robots.txt' => 'sitemap/index',

Controller:

    <?php

    \Package::load('sitemap');

    class Controller_Sitemap extends \Sitemap\Controller {

        protected function _sitemap()
        {
            $result = \DB::select('url', 'updated_at')
                ->from('profiles')
                ->where('completed_step', 3)
                ->where('status', '<', 2)
                ->where('active', '<', 2)
                ->order_by('id', 'desc')
                ->execute()->as_array();

            foreach ($result as $k => $r)
            {
                $result[$k]['url'] = \Uri::base().$r['url'];
            }

            return $result;
        }

        protected function _robots()
        {
            return 'controller robots.txt';
        }

    }
