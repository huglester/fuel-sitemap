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

class Controller extends \Controller
{
	public function before()
	{
		parent::before();

		// Load the configuration for this provider
		\Config::load('sitemap', true);
	}

	public function router()
	{
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
			exit('sitemap not exits. probably introduce empty sitemap too ;)');
		}


		switch ($filename)
		{
			case 'robots.txt':
				$headers = array('Content-Type' => 'text/plain');

				$robots = \Config::get('sitemap.robots');
				$robots = implode("\n", $robots);
				
				return \Response::forge($robots, 200, $headers);

				break;

			case 'sitemap.xml':
				$this->_sitemap();
				$headers = array('Content-Type' => 'text/xml');
				$sitemap = 'generate body here';

				return \Response::forge($sitemap, 200, $headers);

				break;

			case 'sitemap.xml.gz':
				$headers = array(
					'Content-Disposition' => 'attachment; filename=sitemap.xml.gz',
					'Content-Type' => 'application/x-gzip',
				);

				$sitemap = 'generate GZ body here';

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
	private function _sitemap()
	{
		echo 'sitemap package';
	}

	private function _robots()
	{
		echo 'robots package';
	}


}