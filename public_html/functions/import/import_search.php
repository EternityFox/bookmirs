<?php 
define('IS_I_SITE', TRUE);
error_reporting(E_ALL);

require_once '../../config.php';

function dbLog($action, $status, $description){
	$date = date("Y-m-d H:i:s");
	$res=mysql_query("INSERT INTO import (action, status, description, event_date) VALUES('$action', $status, '$description','$date')");
}

//не будет работать на локальном хостинге из-за несоответсвия кодировки в выборке
function optimizate($param){
	if($param) {
		$query = "SELECT product_id, title, author, publish, publishYear, sku, series FROM products";
		if($param=='new'){
			$where = " WHERE search_content IS NULL";
		}
		elseif($param=='full'){
			$where = "";
		}
		else{
			dbLog("seacrh_optimization", 0, "<strong>Поисковая оптимизация:</strong>  Неверно задан параметр: $param");
			return 0;
		}
		$query = $query.$where;
		$result = mysql_query($query);
		$i=0;
		$del_char = array('\'', '"', ',');
		while($row = mysql_fetch_array($result)){ 
			$cont = $row['series'].' '.$row['title'] . ' '. $row['author'] . ' ' . $row['publish'] . ' ' . $row['publishYear'] . ' ' . $row['sku'];
			$cont = trim(str_replace($del_char, '', $cont));
			$sql = "UPDATE products SET search_content = '".$cont."' WHERE product_id = '".$row['product_id']."'";
			$update=mysql_query($sql)  or die(mysql_error());
			++$i;
			/*print $row['series'].' '.$row['product_id'];
			break;*/
		}
		dbLog("seacrh_optimization", 1, "<strong>Поисковая оптимизация:</strong>  Успешно ($param). Проиндексировано: $i");
	}
	else {
		dbLog("seacrh_optimization", 0, "<strong>Поисковая оптимизация:</strong>  Не задан параметр Полная/Для новых");
	}
}
$param='new';
if($_GET['param']) {
	$param = $_GET['param'];
}
optimizate($param);

?>