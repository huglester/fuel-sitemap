<?php

return array(

	/**
	 * Default settings
	 */

	// available are daily, weekly, monthly
	'changefreq' => 'weekly',

	// priority, not used yet
	'priority' => 0.8,

	/*
	 * Aliases
	 * */

	'aliases' => array(
		'loc' => 'url',
		'lastmod' => 'updated_at',
		//'priority' => 'url',
	),

	/*
	 * Cache
	 * false - no cache
	 * null - no expiration, you will have to handle purge from you application login
	 * (int) 60 - 60 seconds etc.
	 * */
	'cache' => null,

	/**
	 * Selects and order in which to search thre $_SERVER array for current url
	 * since FuelPHP cuts off everything after last dot. (thinking it is an extension)
	 */
	'detect_order'	=> array (
		'REQUEST_URI',
		'PATH_INFO',
		'PHP_SELF',
	),

	/*
	 * robots.txt file contents
	 * */
	'robots' => array(
		'User-agent: *',
		'Disallow: /admin/',
		'Disallow: /assets/',
	),

	// Allow all would be:
	/*
	  'robots' => array(
		'User-agent: *',
		'Allow: /',
	),
	*/

	/*
	 * Headers based on the $filename
	 * */
	'headers' => array(
		'robots.txt' => array('Content-Type' => 'text/plain'),
		'sitemap.xml' => array('Content-Type' => 'text/xml'),
		'sitemap.xml.gz' => array(
			'Content-Disposition' => 'attachment; filename=sitemap.xml.gz',
			'Content-Type' => 'application/x-gzip',
		),
	),
);
