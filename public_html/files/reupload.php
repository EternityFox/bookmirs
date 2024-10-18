<?php

include("./config.php");
include("./header.php");

echo '<div id="wrapper">';
$setsrc = $_GET['filecrc'];
$settempname = "./tmpfile/tmpfile";
$movefile = "./storage/" . $setsrc;
unlink("./storage/".$setsrc);


if (rename($settempname, $movefile)) {
echo "Ваш файл заменён<br />";
echo "Ссылка для скачиавания: <a href=\"" . $scripturl . "http://bookmirs.ru/files/download.php?file=" . $setsrc . "\">". $scripturl . "http://bookmirs.ru/files/download.php?file=" . $setsrc . "</a><br />";
/*echo "Ссылка для удаления: <a href=\"" . $scripturl . "download.php?file=" . $filecrc . "&del=" . $passkey . "\">". $scripturl . "download.php?file=" . $filecrc . "&del=" . $passkey . "</a><br />";
echo "Пожалуйста, запомните эти ссылки";*/
} else {
    echo "Ошибка\n";
}

echo '</div';
include("./footer.php");
?>