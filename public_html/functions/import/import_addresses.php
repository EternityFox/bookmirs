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


function addressImport($filename)
{
	$query = mysql_query("TRUNCATE addresses");
	$date = date("d.m.Y H:i:s");
	if (file_exists($filename))
	{
		$countI=0;
		$xml = simplexml_load_file($filename);
		foreach ($xml->Адрес as $item)
		{
			$xml_sklad=''; $xml_prod=''; $xml_address='';
			$xml_sklad = $item->ИдСклада;
                        $sql_shop = mysql_query("SELECT shop_id FROM shops WHERE xml_id = '$xml_sklad' LIMIT 1");
                        $res_shop = mysql_fetch_assoc($sql_shop);
			$shop_id = $res_shop['shop_id'];
			$xml_prod = $item->ИдНоменклатуры;
			$sql_prod = mysql_query("SELECT product_id FROM products WHERE xml_id = '$xml_prod' LIMIT 1");
                        $res_prod = mysql_fetch_assoc($sql_prod);
			$product_id = $res_prod['product_id'];
			$xml_address = $item->Ячейка;
			$query = mysql_query("INSERT INTO addresses (shop_id, prod_id, address) VALUES('$shop_id', '$product_id', '$xml_address')");
			$countI++;
		}
		dbLog("address", 1, "<strong>Адресная система:</strong> Успешно. Добавлено: $countI");
	}
	else
	{
		dbLog("address", 0, "<strong>Адресная система:</strong> Ошибка - отсутсвует файл offers.xml");
	}
}

addressImport('../../import/addresses.xml');
//addressImport("./addresses.xml");

?>
