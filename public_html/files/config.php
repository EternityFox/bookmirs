<?php

$scripturl = "";
//// the URL to this script with a trailing slash

$adminpass = "777";
//// set this password to something other than default
//// it will be used to access the admin panel

$maxfilesize = 150;
//// the maximum file size allowed to be uploaded (in megabytes)

$downloadtimelimit = 0;
//// time users must wait before downloading another file (in minutes)

$uploadtimelimit = 0;
//// time users must wait before uploading another file (in minutes)

$nolimitsize = 0.5;
//// if a file is under this many megabytes, there is no time limit

$deleteafter = 0;
//// delete files if not downloaded after this many days

$downloadtimer = 0;
//// length of the timer on the download page (in seconds)

$enable_filelist = true;
//// allows users to see a list of uploaded files. set to false to disable

//$allowedtypes = array("txt","gif","jpg","jpeg");
//// remove the //'s from the above line to enable file extention blocking
//// only file extentions that are noted in the above array will be allowed

$emailoption = false;
//// set this to true to allow users to email themselves the download links

$passwordoption = false;
//// set this to true to allow users to password protect their uploads

$descriptionoption = false;
//// set this to true to disable the description field

//$categories = array("Documents","Applications","Audio","Misc");
//// remove the //'s from the above line to enable categories
//// Users will be able to choose from this list of categories

?>