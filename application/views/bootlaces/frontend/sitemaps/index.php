<?php echo '<?xml version="1.0" encoding="'.$encoding.'"?>' . "\n";?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= base_url();?></loc> 
        <priority>1.0</priority>
    </url>
 
    <?php foreach($allpages as $pages): ?> 
    <url>
        <loc><?php echo site_url($pages->seo); ?></loc>
        <lastmod><?php echo date('Y-m-d', strtotime($pages->pubdates)); ?></lastmod>
        <priority>0.5</priority>
    </url>
    <?php endforeach; ?>

</urlset>

