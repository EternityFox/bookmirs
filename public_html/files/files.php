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
if(isset($_GET['act'])){$act = $_GET['act'];}else{$act = "null";}
session_start();
include("./header.php");

if($enable_filelist==false){
echo "This page is disabled.";
include("./footer.php");
die();
}
?>
<h1>Uploaded Files</h1>
<p><table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr><td width="50%"><b>filename</b></td><td><b>size</b></td><td><b>last download</b></td><td><b># downloads</b></td></tr>
<?php

$checkfiles=file("./files.txt");
foreach($checkfiles as $line)
{
  $thisline = explode('|', $line);
  
  echo "<tr><td><a href=\"download.php?file=".$thisline[0]."\">".$thisline[1]."</td>";

  $filesize = filesize("./storage/".$thisline[0]);
  $filesize = ($filesize / 1048576);

  if ($filesize < 1)
  {
     $filesize = round($filesize*1024,0);
     echo "<td>".$filesize." KB</td>";

  }
  else
    {
     $filesize = round($filesize,2);
     echo "<td>".$filesize." MB</td>";
     
  }
echo "<td>".date('Y-m-d G:i', $thisline[4])."</td><td>".$thisline[5]."</tr>";
}
echo "</table></p>";
include("./footer.php");
?>