<?php

return array(

	/**
	 * Default settings
	 */

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


);
