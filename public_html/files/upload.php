<?php

include("./config.php");
include("./header.php");
echo '<div id="wrapper">';
$filename = $_FILES['upfile']['name'];
$filetempname = $_FILES['upfile']['tmp_name'];
$filesize = $_FILES['upfile']['size'];
if ($filename=='Price_Igrushki.xls') 
{
	$filecrc = Price_Igrushki_xls;
}
else if ($filename=='Price.exe') 
{
	$filecrc = Price_Igrushki_exe;
}
else if ($filename=='Price_Igrushki_OptovFilial.xls') 
{
	$filecrc = Price_Igrushki_OptovFilial;
}
else if ($filename=='Price_Igrushki_sakh.xls') 
{
	$filecrc = Price_Igrushki_sakh;
}
else if ($filename=='Price_Knigi.xls') 
{
	$filecrc = Price_Knigi;
}
else
{
	$filecrc = md5_file($_FILES['upfile']['tmp_name']);
}
$bans=file("./bans.txt");
foreach($bans as $line)
{
  if ($line==$filecrc."\n"){
    echo "That file is not allowed to be uploaded.";
    include("./footer.php");
    die();
  }
  if ($line==$_SERVER['REMOTE_ADDR']."\n"){
    echo "You are not allowed to upload files.";
    include("./footer.php");
    die();
  }
}

$checkfiles=file("./files.txt");
foreach($checkfiles as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0]==$filecrc){
    echo "<h3>Этот файл уже есть на сервере</h3>";
	$movefile = "./tmpfile/tmpfile";
	move_uploaded_file($filetempname, $movefile);
    echo "Ссылка на него: <a href=\"" . $scripturl . "http://bookmirs.ru/files/download.php?file=" . $filecrc . "\">". $scripturl . "http://bookmirs.ru/files/download.php?file=" . $filecrc . "</a><br />";
	echo "<br/>Вы хотите перезаписать файл?<br />";?>
	<div style="float:left;">
	<form enctype="multipart/form-data" action="reupload.php" id="form" method="GET" >
	<input type="hidden" name="reupload" />
	<? echo '<input type="hidden" name="filecrc" value="'.$filecrc.'"/>'; ?>
	<input type="submit" value="Да!" id="upload" />
	</form>
	</div>
	<div>
	<form enctype="multipart/form-data" action="index.php" id="form" method="GET" >
	<input type="submit" value="Отмена" id="cancel" />
	</form>
	</div>

	<?
    include("./footer.php");
    die();
  }
}

if(isset($allowedtypes)){
$allowed = 0;
foreach($allowedtypes as $ext) {
  if(substr($filename, (0 - (strlen($ext)+1) )) == ".".$ext)
    $allowed = 1;
}
if($allowed==0) {
   echo "Этот тип файла не разрешен к загрузке.";
   include("./footer.php");
   die();
}
}

if(isset($categorylist)){
$validcat = 0;
foreach($categories as $cat) {
  if($_POST['category']==$cat || $_POST['category'] = ""){ $validcat = 1; }
}
if($validcat==0) {
   echo "Invalid category was chosen..";
   include("./footer.php");
   die();
}
$cat = $_POST['category'];
} else { $cat = ""; }

if($filesize==0) {
echo "Вы не выбрали файл для загрузки.";
include("./footer.php");
die();
}

$filesize = $filesize / 1048576;

if($filesize > $maxfilesize) {
echo "Файл слишком большой.";
include("./footer.php");
die();
}

$userip = $_SERVER['REMOTE_ADDR'];
$time = time();

if($filesize > $nolimitsize) {

$uploaders = fopen("./uploaders.txt","r+");
flock($uploaders,2);
while (!feof($uploaders)) { 
$user[] = chop(fgets($uploaders,65536));
}
fseek($uploaders,0,SEEK_SET);
ftruncate($uploaders,0);
foreach ($user as $line) {
@list($savedip,$savedtime) = explode("|",$line);
if ($savedip == $userip) {
if ($time < $savedtime + ($uploadtimelimit*60)) {
echo "You're trying to upload again too soon!";
include("./footer.php");
die();
}
}
if ($time < $savedtime + ($uploadtimelimit*60)) {
  fputs($uploaders,"$savedip|$savedtime\n");
}
}
fputs($uploaders,"$userip|$time\n");

}

$passkey = rand(100000, 999999);

if($emailoption && isset($_POST['myemail']) && $_POST['myemail']!="") {
$uploadmsg = "Ваш файл (".$filename.") загружен.\n Ссылка на него: ". $scripturl . "http://bookmirs.ru/files/download.php?file=" . $filecrc . "\n Ссылка для удаления: ". $scripturl . "download.php?file=" . $filecrc . "&del=" . $passkey . "\n!";
}

if($passwordoption && isset($_POST['pprotect'])) {
  $passwerd = md5($_POST['pprotect']);
} else { $passwerd = md5(""); }

if($descriptionoption && isset($_POST['descr'])) {
  $description = strip_tags($_POST['descr']);
} else { $description = ""; }

$filelist = fopen("./files.txt","a+");
fwrite($filelist, $filecrc ."|". basename($_FILES['upfile']['name']) ."|". $passkey ."|". $userip ."|". $time."|0|".$description."|".$passwerd."|".$cat."|\n");

$movefile = "./storage/" . $filecrc;
move_uploaded_file($filetempname, $movefile);


echo "<h3>Ваш файл загружен</h3>";
echo "Ссылка для скачиавания: <a href=\"" . $scripturl . "http://bookmirs.ru/files/download.php?file=" . $filecrc . "\">". $scripturl . "http://bookmirs.ru/files/download.php?file=" . $filecrc . "</a><br />";
/*echo "Ссылка для удаления: <a href=\"" . $scripturl . "download.php?file=" . $filecrc . "&del=" . $passkey . "\">". $scripturl . "download.php?file=" . $filecrc . "&del=" . $passkey . "</a><br />";
echo "Пожалуйста, запомните эти ссылки";*/
echo '</div>';
include("./footer.php");

?>