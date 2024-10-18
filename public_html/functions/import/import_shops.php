<?php 
define('IS_I_SITE', TRUE);
error_reporting(E_ALL);
 ?>
<?php
require_once '../../config.php';

function dbLog($action, $status, $description){
	$date = date("Y-m-d H:i:s");
	$res=mysql_query("INSERT INTO import (action, status, description, event_date) VALUES('$action', $status, '$description','$date')");
}

function shopsImport($filename)
{	
	$date = date("d.m.Y H:i:s");
	if (file_exists($filename)) 
	{
		$countI=0;
		$countU=0;
		$xml = simplexml_load_file($filename);
		foreach ($xml->ПакетПредложений->Склады->Склад as $item) 
		{ 
			$xml_id='';$name='';$adress='';
			$xml_id = $item->Ид;
			$name = $item->Наименование;
			$adress = $item->Адрес->Представление;
			
			$query = mysql_query("SELECT shop_id FROM shops WHERE xml_id = '$xml_id' LIMIT 1");
			$isInBase = mysql_fetch_assoc($query); 
			if ($isInBase['shop_id'])
			{
				$res = mysql_query("UPDATE shops SET name='$name', adress='$adress' WHERE xml_id='$xml_id'");
				if(!$res)
				{
					dbLog("shops", 0, "<strong>Магазины:</strong> MySQL ошибка обновления магазина. Xml_id: $xml_id");
				}
				$countU++;
				
			}
			else
			{
				$res=mysql_query("INSERT INTO shops (xml_id, name, adress) VALUES ('$xml_id', '$name', '$adress')");
				$countI++;
			}
		}
		dbLog("shops", 1, "<strong>Магазины:</strong> Успешно. Добавлено: $countI, Обновлено: $countU");
	} 
	else 
	{
		dbLog("shops", 0, "<strong>Магазины:</strong> Ошибка - отсутсвует файл offers.xml");
	}
}

$i = 1;
shopsImport('../../import/offers_1.xml');


?>