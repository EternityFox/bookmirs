<?php 
define('IS_I_SITE', TRUE);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 ?>
<?php
require_once '../../config.php';

function dbLog($action, $status, $description){
	$date = date("Y-m-d H:i:s");
	$res=mysql_query("INSERT INTO import (action, status, description, event_date) VALUES('$action', $status, '$description','$date')");
}

function productImport()
{
	$filename = '../../import/import.xml';
	if (file_exists($filename)) 
	{
		$countI=0;$countU=0;
		$xml = simplexml_load_file($filename);
		foreach ($xml->Каталог->Товары->Товар as $item) { 
			$xml_id='';$sku='';$title='';$img='';$category='';$author=''; $publish=''; $publishYear='';
			$xml_id=$item->Ид;
			$sku=$item->Артикул;
			$title=htmlspecialchars($item->Наименование, ENT_QUOTES);
			$category=$item->Группы->Ид;
			$img=$item->Картинка;
			foreach ($item->ЗначенияРеквизитов->ЗначениеРеквизита as $field) {
				if ($field->Наименование=='Автор') {
					$author=htmlspecialchars($field->Значение, ENT_QUOTES);
				}
				if ($field->Наименование=='Издательство') {
					$publish=htmlspecialchars($field->Значение, ENT_QUOTES);
				}
				if ($field->Наименование=='ГодВыпуска') {
					$publishYear=$field->Значение;
				}
				if ($field->Наименование=='Издательская серия') {
					$series=htmlspecialchars($field->Значение, ENT_QUOTES);
				}
			}
			$query = mysql_query("SELECT category_id FROM categories WHERE xml_id = '".$category."' LIMIT 1");
			$category_data = mysql_fetch_assoc($query);
			$category_id = $category_data['category_id'];
			$query = mysql_query("SELECT product_id FROM products WHERE xml_id = '".$xml_id."' LIMIT 1");
			$isInBase = mysql_fetch_assoc($query);
			if ($isInBase['product_id']){
				$res = mysql_query("UPDATE products SET title='".$title."', author='".$author."', publish='".$publish."', publishYear='".$publishYear."', sku='".$sku."', category_id='".$category_id."', img='".$img."', series='".$series."' WHERE xml_id='".$xml_id."'");
				if(!$res){
					dbLog("nomenclature", 0, "<strong>Номенклатура:</strong> Ошибка обновления товара. Xml_id: $xml_id");
				}
				else $countU++;
				//if ($img) file_put_contents('1.txt', "'".$isInBase['product_id']."', ", FILE_APPEND);
			}
			else{
				$res=mysql_query("INSERT INTO products (xml_id, title, sku, category_id, img, author, publish, publishYear, series) VALUES ('".$xml_id."', '".$title."', '".$sku."', '".$category_id."', '".$img."', '".$author."', '".$publish."', '".$publishYear."', '".$series."')");
				if(!$res){
					dbLog("nomenclature", 0, "<strong>Номенклатура:</strong> Ошибка добавления товара. Xml_id: $xml_id");
				}
				else $countI++;
			}
		}
		dbLog("nomenclature", 1, "<strong>Номенклатура:</strong> Успешно. Добавлено: $countI, Обновлено: $countU");
	} 
	else{
	dbLog("nomenclature", 0, "<strong>Номенклатура:</strong> Ошибка - отсутсвует файл import.xml");
	}
}

productImport();

?>
