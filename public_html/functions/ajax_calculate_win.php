<?php

define('IS_I_SITE', TRUE);
require_once '../config.php';
header("Content-type: text/html; charset=UTF-8");


// Призы
$prizes = [
    ['name' => 'Главный приз на 50000 руб.', 'count' => 1],
    ['name' => 'Приз на 20000 руб.', 'count' => 3],
    ['name' => 'Приз на 10000 руб.', 'count' => 5],
    ['name' => 'Приз на 5000 руб.', 'count' => 10]
];

// Выбираем случайного победителя
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем индекс приза
    $input = json_decode(file_get_contents('php://input'), true);
    $prizeIndex = isset($input['prizeIndex']) ? (int)$input['prizeIndex'] : null;
    if ($prizeIndex === null || !isset($prizes[$prizeIndex])) {
        echo json_encode(['error' => 'Invalid prize index']);
        exit;
    }
    // Выбираем купоны с рандомной сортировкой
    $query = "SELECT id as vid, code, name, email, phone, updated_at 
              FROM coupons 
              WHERE phone IS NOT NULL 
              ORDER BY RAND()";
    $res = mysql_query($query) or die(json_encode(['error' => mysql_error()]));
    $coupons = [];
    //Получаем данные
    while ($row = mysql_fetch_assoc($res)) {
        $coupons[] = $row;
    }
    if (empty($coupons)) {
        echo json_encode(['error' => 'No available coupons']);
        exit;
    }
    $availableCoupons = array_column($coupons, 'code');
    // Сортируем рандомно массив
    $winnerIndex = array_rand($availableCoupons);
    $winner = $coupons[$winnerIndex];

    $now = time();
    $win_date = date('Y-m-d H:i:s', $now);
    $win_id = (int)$winner['vid'];
    $priz_id = $prizeIndex + 1;
    // Записываем данные победителя в таблицу
    $insert_query = "INSERT INTO winners (prize_index, winner_code_id, win_date) VALUES ('$priz_id', '$win_id', '$win_date')";
    $res_winners = mysql_query($insert_query);

    if (!$res_winners) {
        echo json_encode(['error' => 'Failed to insert winner', 'mysql_error' => mysql_error()]);
        exit;
    }
    // Возвращаем данные победителя
    echo json_encode([
        'code' => $winner['code'],
        'name' => $winner['name'],
        'prize' => $prizes[$prizeIndex]['name']
    ]);
    exit;
}

die();
