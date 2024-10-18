<?php
define('IS_I_SITE', TRUE);
require_once '../config.php';
header("Content-type: text/html; charset=UTF-8");
function clean_data($data){
    $data = strip_tags($data);
    $data = strtolower($data);
    $data = preg_replace('~[^a-z0-9 \x80-\xFF]~i', "",$data); 
    return $data;
}
$search = clean_data($_GET['term']);
$sql = "SELECT DISTINCT(publish) FROM products p WHERE p.publish LIKE '%$search%'";
$query = mysql_query($sql);
$answer = '{"term":"'.$search.'","results":{"publishes":[';
$i=0;
if(mysql_num_rows($query)>0){
	$row = mysql_fetch_array($query);
	do{
		$i++;
		if($i!=1){$answer .= ',';}
		$answer .='{"term":"'.$row['publish'].'","id":"'.$row['publish'].'"}';
	}while($row = mysql_fetch_array($query));
}
$answer .= ']}}';
//$answer = '{"term":"'.$_GET['term'].'","results":{"authors":[{"term":"Crunch","id":14456}]}}';
echo $answer;
?>
