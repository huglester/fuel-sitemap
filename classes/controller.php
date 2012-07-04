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

		$cache_filename = 'sitemap_'.md5($filename);
		$output = null;

		if (\Config::get('sitemap.cache', 3600) !== false)
		{
			try
			{
				$output = \Cache::get($cache_filename);

			}
			catch (\Exception $e)
			{
				// cache not found
			}
		}

		if ($output === null)
		{
			switch ($filename)
			{
				case 'robots.txt':
					$output = ($output = $this->_robots()) ? $output : \Config::get('sitemap.robots', array('User-agent: *', 'Allow: /' ));

					// implode the robot.txt array
					is_array($output) and $output = implode("\n", $output);
					break;

				case 'sitemap.xml':
					$sitemap = $this->_sitemap();

					$data = array(
						'sitemap' => $sitemap,
					);

					$fields = array('loc', 'lastmod', 'changefreq', 'priority');

					foreach ($fields as $f)
					{
						$data[$f] = \Config::get('sitemap.aliases.'.$f, $f);
					}

					$output = \View::forge('sitemap', $data);
					break;

				case 'sitemap.xml.gz':
					$output = $this->_sitemap();

					if (function_exists('gzencode'))
					{
						$output = gzencode($output, 9);
					}

					//return \Response::forge($sitemap, 200, $headers);

					break;
			}

			\Cache::set($cache_filename, $output, \Config::get('sitemap.cache', 3600));
		}

		$headers = \Config::get('sitemap.headers', array());
		return \Response::forge($output, 200, $headers[$filename]);
	}

	/*
	 * need to think
	 * */
	abstract protected function _sitemap();

	abstract protected function _robots();

}