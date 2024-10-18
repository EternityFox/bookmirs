<?php
//   __ _       _   _____ _ _      _    _           _   
//  / _| |     | | |  ___(_) |    | |  | |         | |  
// | |_| | __ _| |_| |__  _| | ___| |__| | ___  ___| |_ 
// |  _| |/ _` | __|  __|| | |/ _ \  __  |/ _ \/ __| __|
// | | | | (_| | |_| |   | | |  __/ |  | | (_) \__ \ |_ 
// |_| |_|\__,_|\__|_|   |_|_|\___|_|  |_|\___/|___/\__|
// by Jim (www.j-fx.ws)                   version 1.15.0
////////////////////////////////////////////////////////

include("./config.php");
include("./header.php");
echo '<div id="wrapper">';
$bans=file("./bans.txt");
foreach($bans as $line)
{
  if ($line==$_SERVER['REMOTE_ADDR']){
    echo "You are not allowed to download files.";
    include("./footer.php");
    die();
  }
}

if(isset($_GET['file'])) {
  $filecrc = $_GET['file'];
} else {
  echo "Invalid download link.<br />";
  include("./footer.php");
  die();
}

$checkfiles=file("./files.txt");
$foundfile=0;
foreach($checkfiles as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0]==$filecrc){
    $foundfile=$thisline;
  }
}

if(isset($_GET['del'])) {

$fc=file("./files.txt");
$f=fopen("./files.txt","w");
$deleted=0;
foreach($fc as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0] == $_GET['file']){
    if($thisline[2] == $_GET['del']){
	$deleted=1;
    } else {
    fputs($f,$line);
    }
  } else {
    fputs($f,$line);
  }
}
fclose($f);
if($deleted==1){
unlink("./storage/".$_GET['file']);
echo "Your file was deleted.<br />";
} else {
echo "Invalid delete link.<br />";
}
include("./footer.php");
die();

}

if(isset($_GET['deltoup'])) {

$fc=file("./files.txt");
$f=fopen("./files.txt","w");
$finded=0;
foreach($fc as $line)
{
  $thisline = explode('|', $line);
  if ($thisline[0] == $_GET['file']){
    if($thisline[2] == $_GET['deltoup']){
	$finded=1;
	$setcrc=$_GET['file'];
	$setname=$thisline[1];
	 fputs($f,$line);
    } else {
    fputs($f,$line);
    }
  } else {
    fputs($f,$line);
  }
}
fclose($f);
if($finded==1){
unlink("./storage/".$_GET['file']);
echo "Your file was deleted.<br />";
} else {
echo "Invalid delete link.<br />";
}
include("./footer.php");
die();

}

if($foundfile==0) {
  echo "Invalid download link.<br />";
  include("./footer.php");
  die();
}

if(isset($foundfile[7]) && $foundfile[7]!=md5("") && (!isset($_POST['pass']) || $foundfile[7] != md5($_POST['pass']))){
echo "<form action=\"download.php?file=".$foundfile[0]."\" method=\"post\">Password Protected: <input type=\"password\" name=\"pass\"><input type=\"submit\" /></form>";
include("./footer.php");
die();
}

$filesize = filesize("./storage/".$foundfile[0]);
$filesize = $filesize / 1048576;

if($filesize > $nolimitsize) {

$userip=$_SERVER['REMOTE_ADDR'];
$time=time();
$downloaders = fopen("./downloaders.txt","r+");
flock($downloaders,2);
while (!feof($downloaders)) { 
$user[] = chop(fgets($downloaders,65536));
}
fseek($downloaders,0,SEEK_SET);
ftruncate($downloaders,0);
foreach ($user as $line) {
list($savedip,$savedtime) = explode("|",$line);
if ($savedip == $userip) {
if ($time < $savedtime + ($downloadtimelimit*60)) {
echo "You're trying to download again too soon!";
include("./footer.php");
die();
}
}
if ($time < $savedtime + ($downloadtimelimit*60)) {
  fputs($downloaders,"$savedip|$savedtime\n");
}
}

}

echo "<h1>".$foundfile[1]." - ".round($filesize,2)." MB</h1>";
if(isset($foundfile[6])){ echo "<br /><br />".$foundfile[6]."<br /><br />"; }
$randcounter = rand(100,999);
?>
<div id="dl" align="center">
<?php 
if($downloadtimer == 0) {
echo "<h3><a href=\"" .$scripturl. "download2.php?a=" . $filecrc . "&b=" . md5($foundfile[2].$_SERVER['REMOTE_ADDR']) . "\">Скачать</a></h3>";
} else { ?>
If you're seeing this message, you need to enable JavaScript
<?php } ?>
</div>
<script language="Javascript">
x<?php echo $randcounter; ?>=<?php echo $downloadtimer; ?>;
function countdown() 
{
 if ((0 <= 100) || (0 > 0))
 {
  x<?php echo $randcounter; ?>--;
  if(x<?php echo $randcounter; ?> == 0)
  {
   document.getElementById("dl").innerHTML = '<h3><a href="<?php echo $scripturl . "download2.php?a=" . $filecrc . "&b=" . md5($foundfile[2].$_SERVER['REMOTE_ADDR']) ?>">Скачать</a></h3>';
  }
  if(x<?php echo $randcounter; ?> > 0)
  {
   document.getElementById("dl").innerHTML = 'Пожалуйста, подождите <b>'+x<?php echo $randcounter; ?>+'</b> секунд..';
   setTimeout('countdown()',1000);
  }
 }
}
countdown();
</script>

<?php
echo '</div>';
include("./footer.php");
?>