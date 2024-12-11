<?php
define('IS_I_SITE', TRUE);
require_once '../config.php';
header("Content-type: text/html; charset=UTF-8");


$prizeIndex = $_GET['prizeIndex']+1;
$query = "SELECT winner_code_id, win_date FROM winners WHERE prize_index = '$prizeIndex' ORDER BY win_date DESC";
$res = mysql_query($query) or die(mysql_error());
$winners = [];
if (mysql_num_rows($res) > 0) {
    while ($row = mysql_fetch_assoc($res)) {
        $winner_code_id = $row['winner_code_id'];
        $query_coupon = "SELECT code, name FROM coupons WHERE id='" . $winner_code_id . "' LIMIT 1";
        $res_coupon = mysql_query($query_coupon) or die(mysql_error());
        $coupon = [];
        while ($item = mysql_fetch_assoc($res_coupon)) {
            $coupon[] = $item;
        }
        $fio = isset(current($coupon)['name']) ? current($coupon)['name'] : 'Не указано';

        if (preg_match('/^([\p{L}-]+)\s+([\p{L}]+)(?:\s+([\p{L}]+))?$/u', $fio, $matches)) {
            $fullSurname = $matches[1]; // Полная фамилия или составная фамилия
            $name = $matches[2]; // Имя
            $surnameParts = preg_split('/-/', $fullSurname); // Разделяем составную фамилию по дефису

            $lastSurnamePart = end($surnameParts); // Последняя часть составной фамилии
            $initial = mb_substr($lastSurnamePart, 0, 1, 'UTF-8'); // Первая буква фамилии

            // Формируем результат
            $fioFormatted = "{$name} {$initial}.";
        } elseif (preg_match('/^([\p{L}-]+)$/u', $fio)) {
            // Если это только одно слово (например, только фамилия или имя)
            $fioFormatted = $fio;
        } else {
            $fioFormatted = $fio; // Если формат не распознан, возвращаем как есть
        }



        $winners[] = [
            'name' => $fioFormatted,
            'code' => current($coupon)['code'],
            'date' => $row['win_date']
        ];
    }
} else {
    $winners = [];
}
echo json_encode($winners);
exit;