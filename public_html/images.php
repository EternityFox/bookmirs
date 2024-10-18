<?php 
define('IS_I_SITE', true);
require 'config.php';
header('Content-disposition: attachment; filename=images.txt');
header('Content-type: text/plain');
$res = mysql_query("SELECT img, xml_id FROM products WHERE img <> ''");
$i = 0;
while ($item = mysql_fetch_assoc($res))
{
	if (file_exists('media/'.$item['img']) && !is_dir('media/'.$item['img']))
	{
		print $item['xml_id']."\n";
		$i++;
	}
}
print $i."\n";
?>