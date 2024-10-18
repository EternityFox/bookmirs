<?php
header("Content-type: text/html; charset=utf-8");
include("./config.php");
include("./header.php");
ini_set('display_errors', '1');
/*
//delete old files
$deleteseconds = time() - ($deleteafter * 24 * 60 * 60);

$fc=file("./files.txt");
$f=fopen("./files.txt","w");
foreach($fc as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[4] > $deleteseconds)
    fputs($f,$line);
  else
    unlink("./storage/".$thisline[0]);
}
fclose($f);
//done deleting old files
*/
$fileshosted=sizeof(file("./files.txt")); //get the # of files hosted


$sizehosted = 0; //get the storage size hosted
$handle = opendir("./storage/");
while($file = readdir($handle)) {
$sizehosted = $sizehosted + filesize ("./storage/".$file);
/*
  if((is_dir("./storage/".$file.'/')) && ($file != '..')&&($file != '.'))
  {
  $sizehosted = $sizehosted + total_size("./storage/".$file.'/');
  }
 */
}
$sizehosted = round($sizehosted/1024/1024,2);

if(isset($allowedtypes)){ //get allowed filetypes.
  $types = implode(", ", $allowedtypes);
  $filetypes = "<b>allowed file types:</b> ".$types."<br /><br />";
} else { $filetypes = ""; }

if(isset($categories)){ //get categories
  $categorylist = "Category: <select name=\"category\">";
  foreach($categories as $category){
    $categorylist .= "<option value=\"".$category."\">".$category."</option>";
  }
  $categorylist .= "</select><br />";
} else { $filetypes = ""; }

if(isset($_GET['page']))
  $p = $_GET['page'];
else
  $p = "0";

switch($p) {
case "tos": include("./pages/tos.php"); break;
case "faq": include("./pages/faq.php"); break;
default: include("./pages/upload.php"); break;
}

include("./footer.php");
?>