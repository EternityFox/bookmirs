<?php
define('IS_I_SITE', TRUE);
require_once '../config.php';
header("Content-type: text/html; charset=UTF-8");
$agree = $_POST['agree'];
if ($agree === "true") {
    $code = $_POST['coupon'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $now = time();
    $updated_at = date('Y-m-d H:i:s', $now);
    $sql = "SELECT * FROM coupons WHERE code='" . $code . "'";
    $query = mysql_query($sql);
    if (mysql_num_rows($query) > 0) {
        $row = mysql_fetch_array($query);
        if ($row['phone'] == NULL && $row['email'] == NULL && $row['name'] == NULL) {
            $sql_update = "UPDATE coupons SET name = '$name', email = '$email', phone = '$phone', updated_at = '$updated_at' WHERE code = '" . $code . "'";
            $res = mysql_query($sql_update);
            if ($res == 1) {
                echo '{"success": true,"message":"Купон успешно зарегестрирован"}';
            } else {
                echo 'Произошла ошибка, попробуйте чуть позже или свяжитесь с нами';
            }
        } else {
            echo '{"success": false,"message":"Данный купон зарегестрирован на другого пользователя"}';
        }
    } else {
        echo '{"success": false,"message":"Данного купона не существует"}';
    }
} else {
    echo '{"success": false,"message":"Нужно дать согласие на обработку персональных данных, иначе не получиться зарегестрировать купон"}';
}