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


function offersImport($filename)
{	
	if (file_exists($filename)) 
	{
		//$res=mysql_query("DELETE FROM offers");
		//if($res) {dbLog("offers", 1, "<strong>Предложения:</strong> MySQL удалены все записи предложений");}
		//else {dbLog("offers", 1, "<strong>Предложения:</strong> ошибка MySQL: записи о предложениях не удалены");}
		
		$i=0;$k=0;$j=0;$c=0;
		$xml = simplexml_load_file($filename);
		$insertPacket="('0','0','0','0','0')";
		foreach ($xml->ПакетПредложений->Предложения->Предложение as $item) { 
			$xml_id='';$price='';$quantity='';$shop='';
			$xml_id = $item->Ид;
			$price = $item->Цены->Цена->ЦенаЗаЕдиницу;
			$quantity = $item->Количество;
			$shop = $item->Склад['ИдСклада'];
			$query = mysql_query("SELECT shop_id FROM shops WHERE xml_id = '$shop' LIMIT 1");
			$isInBase = mysql_fetch_assoc($query);
			if($isInBase['shop_id'])
			{$shop_id = $isInBase['shop_id'];}
			else{$shop_id = '25';}
			$query = mysql_query("SELECT product_id FROM products WHERE xml_id = '$xml_id' LIMIT 1");
			$isInBase = mysql_fetch_assoc($query);
			$product_id = $isInBase['product_id'];
			if ($product_id){
				$res=mysql_query("UPDATE products SET active='1' WHERE product_id='".$product_id."'");
				$query = mysql_query("SELECT offer_id FROM offers WHERE xml_id = '$xml_id' and shop_id='$shop_id' LIMIT 1");
				$isInBase = mysql_fetch_assoc($query);
				$offer_id = $isInBase['offer_id'];
				if($offer_id){
					$res = mysql_query("UPDATE offers SET price='".$price."', quantity='".$quantity."' WHERE xml_id='".$xml_id."' and shop_id='$shop_id' ");
					if(!$res){
						dbLog("offers", 0, "<strong>Предложения:</strong> MySQL ошибка обновления предложения. Xml_id: $xml_id");
					}
					++$k;
				}else{
					$insertPacket .= ",('".$xml_id."', '".$product_id."', '".$price."', '".$quantity."', '".$shop_id."')";
					++$i;++$j;
				}
			}
			else{
				//$res=mysql_query("INSERT INTO out_of_products (xml_id) VALUES ('".$xml_id."')");
				//dbLog("offers", 0, "<strong>Предложения:</strong> Предложение $xml_id не найдено в номенклатурной таблице products");
			}
			$c++;
			//echo $c."\n";
			if($j==200) {
				$res=mysql_query("INSERT INTO offers (xml_id, product_id, price, quantity, shop_id) VALUES" . $insertPacket);
				$j=0;$insertPacket="('0','0','0','0','0')";
				//echo $c."\n";
			}
		}
		if($j>0){
			$res=mysql_query("INSERT INTO offers (xml_id, product_id, price, quantity, shop_id) VALUES" . $insertPacket);
				//echo $c."\n";
		}
		dbLog("offers", 1, "<strong>Предложения:</strong> Успешно. Добавлено: $i, Обновлено: $k");
	} 
	else 
	{
		dbLog("offers", 0, "<strong>Предложения:</strong> Ошибка - отсутсвует файл offers.xml");
	}
}

$i = 1;
while (file_exists('../../import/offers_'.$i.'.xml'))
{
	if ($i == 1)
	{
		$res = mysql_query("UPDATE offers SET quantity='0'");
		$res = mysql_query("UPDATE products SET active='0'");
	}
	offersImport('../../import/offers_'.$i.'.xml');
	$i++;
}


?>