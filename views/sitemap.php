<?php echo '<?'; ?>xml version="1.0" encoding="UTF-8"<?php echo '?>'; ?>
<urlset
	xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

	<?php foreach ($sitemap as $i): ?>
		<?php if ($i[$loc]): ?>
			<url>
				<loc><?php echo $i[$loc];?></loc>
				<lastmod><?php echo date('c', $i[$lastmod]);?></lastmod>
				<?php //echo (isset($i[$changefreq])) ? "<changefreq>{$i[$changefreq]}</changefreq>" : ''; ?>
				<?php //echo ($i[$priority]) ? "<priority>{$i[$priority]}</priority>" : ''; ?>
			</url>
		<?php endif; ?>
	<?php endforeach; ?>

</urlset>