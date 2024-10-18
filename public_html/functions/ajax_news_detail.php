<?php
define('IS_I_SITE', TRUE);
require_once '../config.php';
header("Content-type: text/html; charset=UTF-8");
$query = "UPDATE news SET hits = hits + 1 WHERE news_id = ".$_POST['news_id'];
$res = mysql_query($query);
$query = "SELECT * FROM news WHERE news_id='".$_POST['news_id']."' LIMIT 1";
$res = mysql_query($query);
$newsDetail = mysql_fetch_assoc($res);
echo json_encode($newsDetail);
