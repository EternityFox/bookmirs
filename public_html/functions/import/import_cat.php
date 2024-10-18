<?php
/* define('IS_I_SITE', TRUE); ?>
<?php
require_once '../../config.php';

function dbLog($action, $status, $description){
	$date = date("Y-m-d H:i:s");
	$res=mysql_query("INSERT INTO import (action, status, description, event_date) VALUES('$action', $status, '$description','$date')");
}

function getGroupData($group,$index,$parent) 
{		
		$xml_id=$group->Ид;
		$gname=$group->Наименование;
		$query = mysql_query("SELECT category_id FROM categories WHERE xml_id = '".$xml_id."' LIMIT 1");
		$isInBase = mysql_fetch_assoc($query);
		if ($isInBase['category_id'])
		{
			$res=mysql_query("UPDATE categories SET name='".$gname."', parent='".$parent."' WHERE category_id='".$isInBase['category_id']."'"); 
			$cat_id = $isInBase['category_id'];
		}
		else
		{
			$res=mysql_query("INSERT INTO categories (xml_id, name, parent) VALUES ('".$xml_id."','".$gname."','".$parent."')");
			$cat_id = mysql_insert_id();
			
		}
		$parent=$cat_id;
		if ($group->Группы->Группа) 
		{
			$index++;
			foreach ($group->Группы->Группа as $group)
			{
				getGroupData($group,$index,$parent);
			}
		}
}

$filename = '../../import/import.xml';
if (file_exists($filename)) 
{
	$xml = simplexml_load_file($filename);
	foreach ($xml->Классификатор->Группы->Группа as $item) 
	{ 
		$index='0';
		$parent=0;
		getGroupData($item,$index,$parent);
	}
	dbLog('category','1','<strong>Категории:</strong> Успешно');
} 
else 
{	
	dbLog('category','0','<strong>Категории:</strong> Ошибка - отсутсвует файл import.xml');
}
*/
?>
