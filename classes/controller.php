<?php

namespace Sitemap;


/**
 * Sitemap Controller
 *
 * @package    FuelPHP/Sitemap
 * @category   Controller
 * @author     huglester
 * @copyright  (c) 2012 huglester
 * @license    http://webas.lt
 */

abstract class Controller extends \Controller
{
	public function before()
	{
		parent::before();

		// Load the configuration for this provider
		\Config::load('sitemap', true);
	}

	public function router()
	{
		/*
		 * robots.txt or sitemap.xml(.gz)
		 * */
		$filename = null;

		foreach (\Config::get('sitemap.detect_order') as $key)
		{
			if ($filename = \Input::server($key))
			{
				$filename = basename($filename);
				break 1;
			}
		}

		if ( ! $filename)
		{
			exit('sitemap.xml(.gz)/robots.txt not set. Maybe allow some dummy sitemap to return?');
		}


		switch ($filename)
		{
			case 'robots.txt':

				$headers = array('Content-Type' => 'text/plain');
				$robots = ($robots = $this->_robots()) ? $robots : \Config::get('sitemap.robots', array('User-agent: *', 'Allow: /' ));

				// implode the robot.txt array
				is_array($robots) and $robots = implode("\n", $robots);

				return \Response::forge($robots, 200, $headers);
				break;

			case 'sitemap.xml':

				$headers = array('Content-Type' => 'text/xml');
				$sitemap = $this->_sitemap();

				return \Response::forge($sitemap, 200, $headers);

				break;

			case 'sitemap.xml.gz':

				$headers = array(
					'Content-Disposition' => 'attachment; filename=sitemap.xml.gz',
					'Content-Type' => 'application/x-gzip',
				);

				$sitemap = $this->_sitemap();

				if (function_exists('gzencode'))
				{
					$sitemap = gzencode($sitemap, 9);
				}

				return \Response::forge($sitemap, 200, $headers);

				break;
		}

	}

	/*
	 * need to think
	 * */
	abstract protected function _sitemap();

	abstract protected function _robots();

}