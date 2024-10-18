<?php
define('IS_I_SITE', TRUE);
require_once '../config.php';
header("Content-type: text/html; charset=UTF-8");

$dmapptoken = "319483557c9f68efafe100b547ecbe0cc3727612";
$dmtoken = "fea64bd1a59778c28b09e8954b11665b0cff2662";
$card = $_POST['card'];

$url = "http://pos-api.dinect.com/20130701/users/?_dmapptoken=$dmapptoken&_dmtoken=$dmtoken&auto=$card&format=json";
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_URL, "$url");
$result = curl_exec($ch);
curl_close($ch);
$obj = json_decode($result);
$id = $obj[0]->id;

if ("$id" > "0") {
    $bonus = $obj[0]->bonus;
} else {
    unset($obj);
    unset($id);
    $dmtoken = "f6cdbd6e88ae82d39b5c6bcb4128f8931eb30818";
    $url = "http://pos-api.dinect.com/20130701/users/?_dmapptoken=$dmapptoken&_dmtoken=$dmtoken&auto=$card&format=json";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_URL, "$url");
    $result = curl_exec($ch);
    curl_close($ch);
    $obj = json_decode($result);
    $id = $obj[0]->id;
    if ("$id" > "0") {
        $bonus = $obj[0]->bonus;
    } else {
        $bonus = "Карта с таким номером не найдена";
    }
}
echo $bonus;
