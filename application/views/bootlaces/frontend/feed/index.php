<?php echo '<?xml version="1.0" encoding="'.$encoding.'"?>' . "\n"; ?>
<rss version="2.0"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:admin="http://webns.net/mvcb/"
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns:content="http://purl.org/rss/1.0/modules/content/">

<channel>

 <title><?php echo $feed_name; ?></title>

 <link><?php echo $feed_url; ?></link>
 <description><?php echo $page_description; ?></description>
 <dc:language><?php echo $lang; ?></dc:language>
 <dc:creator><?php echo $creator_email; ?></dc:creator>
 <image>
	<url><?php echo base_url('assets/img/'.$logo) ?></url>
	<title><?php echo $feed_name ?></title>
	<link><?php echo base_url(); ?></link>
 </image>
 
 <dc:rights>CIFullCalendar by Sir.Dre Copyright <?php echo gmdate("Y", time()); ?></dc:rights>
 <admin:generatorAgent rdf:resource='<?php echo base_url(); ?>' />

 <?php foreach($posts->result() as $entry): ?><item>
  <title><?php echo xml_convert($entry->title); ?></title>
  <link><?php echo site_url($entry->username) ?></link>
  <guid><?php echo md5(site_url($entry->username)); ?></guid><?php if(($entry->description) != ''):  ?>
  
  <description><![CDATA[ <?php echo character_limiter($entry->description, 200); ?> ]]></description><?php endif ?><?php foreach ($allcategories as $category): ?><?php if(($entry->category) == ($category->category_id)):  ?>    
  <category><?php echo $category->category_name ?></category><?php endif ?><?php endforeach ?><?php if(($entry->url) != ''):  ?>    
  <source url="<?php echo $entry->url ?>" ><?php echo $entry->url ?></source><?php endif ?>  
  <lastBuildDate><?php echo date('D, M Y h:i:s a', strtotime($entry->pubDate)); ?></lastBuildDate>
  <pubDate><?php echo date('D, M Y h:i:s a', strtotime($entry->start)); ?> - <?php echo (date('YYYY-MM-DD', strtotime($entry->start)) < date('YYYY-MM-DD', strtotime($entry->end))) ? date('D, M Y h:i:s a', strtotime($entry->end)) : date('h:i:s a', strtotime($entry->end)); ?></pubDate>  
  <author><?php echo $entry->username ?></author>    
</item>       
<?php endforeach; ?>
    
 </channel>
</rss> 
