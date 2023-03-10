<?php
header('Content-type: application/xml; charset="ISO-8859-1"', true);
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
	<url>
		<loc><?= base_url() ?></loc>
		<changefreq>daily</changefreq>
		<priority>0.9</priority>
	</url>
	<?php foreach ($page as $p) : ?>
		<url>
			<loc><?= base_url($p->seo_slug) ?></loc>
			<lastmod><?= date('c', strtotime($p->created_at)) ?></lastmod>
			<changefreq>monthly</changefreq>
			<priority>0.8</priority>
		</url>
	<?php endforeach ?>
	<?php foreach ($anime_list as $al) : ?>
		<url>
			<loc><?= base_url($al->seo_slug) ?></loc>
			<lastmod><?= date('c', strtotime($al->created_at)) ?></lastmod>
			<changefreq>monthly</changefreq>
			<priority>0.8</priority>
		</url>
	<?php endforeach ?>
	<?php foreach ($anime_list as $al) :
		$row = $this->db->get_where('anime_video', ['id_anime' => $al->id])->result();
		foreach ($row as $row) {
	?>
			<url>
				<loc><?= base_url("$al->seo_slug/$row->id") ?></loc>
				<lastmod><?= date('c', strtotime($row->created_at)) ?></lastmod>
				<changefreq>monthly</changefreq>
				<priority>0.8</priority>
			</url>
	<?php }
	endforeach ?>

</urlset>