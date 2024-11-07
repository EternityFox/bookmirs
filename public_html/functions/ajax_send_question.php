<?php
define('IS_I_SITE', TRUE);
require_once '../config.php';
header("Content-type: text/html; charset=UTF-8");
$name = $_POST['name'];
$email = $_POST['email'];
$question = $_POST['question'];
$now = time();
$created_at = date('Y-m-d H:i:s', $now);
$query = "INSERT INTO questions (name, email, question, created_at, updated_at) VALUES ('$name', '$email', '$question', '$created_at', '$created_at')";
$res = mysql_query($query);
if ($res == 1) {
    echo 'Ваш вопрос был успешно отправлен!';
} else {
    echo 'Проверьте, что все поля были заполнены';
}
die();