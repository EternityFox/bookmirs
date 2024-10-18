<?php
function compressImage($ext,$uploadedfile,$path,$actual_image_name,$newwidth)
 {

if($ext=="jpg" || $ext=="jpeg" )
 {
 $src = imagecreatefromjpeg($uploadedfile);
 }
else if($ext=="png")
 {
 $src = imagecreatefrompng($uploadedfile);
 }
else if($ext=="gif")
 {
 $src = imagecreatefromgif($uploadedfile);
 }
else
 {
 $src = imagecreatefrombmp($uploadedfile);
 }

list($width,$height)=getimagesize($uploadedfile);
 $newheight=($height/$width)*$newwidth;
 $tmp=imagecreatetruecolor($newwidth,$newheight);
imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
 $filename = $path.$newwidth.'_'.$actual_image_name; //PixelSize_TimeStamp.jpg
imagejpeg($tmp,$filename,100);
imagedestroy($tmp);
return $filename;
 }
 
 function getExtension($str)
 {
 $i = strrpos($str,".");
 if (!$i)
 {
return "";
 }
 $l = strlen($str) - $i;
 $ext = substr($str,$i+1,$l);
return $ext;
 }
 
 $path = "../../media/images/";

 $valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
 {
 $imagename = $_FILES['photoimg']['name'];
 $size = $_FILES['photoimg']['size'];
if(strlen($imagename))
 {
 $ext = strtolower(getExtension($imagename));
if(in_array($ext,$valid_formats))
 {
if($size<(1024*4096)) // Image size max 1 MB
 {
 $actual_image_name = time().$session_id.".".$ext;
 $uploadedfile = $_FILES['photoimg']['tmp_name'];

//Re-sizing image. 
 $widthArray = array(100,260,300); //You can change dimension here.
foreach($widthArray as $newwidth)
 {
 $filename=compressImage($ext,$uploadedfile,$path,$actual_image_name,$newwidth);
 }

//Original Image
if(move_uploaded_file($uploadedfile, $path.$actual_image_name))
 {

//Insert upload image files names into user_uploads table
//mysqli_query($db,"UPDATE users SET profile_image='$actual_image_name' WHERE uid='$session_id';");
echo "<img src='".$path.$actual_image_name."' class='img-thumbnail preview'><input type='hidden' name='uploaded-image' value='".$actual_image_name."'>";
 }
else
echo "failed";
 }
else
echo "Image file size max 1 MB"; 
 }
else
echo "Invalid file format.."; 
 }
else
echo "Please select image..!";
exit;
 }
?>