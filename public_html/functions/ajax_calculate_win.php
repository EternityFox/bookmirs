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
    $input = json_decode(file_get_contents('php://input'), true);
    $prizeIndex = isset($input['prizeIndex']) ? (int)$input['prizeIndex'] : null;

    if ($prizeIndex === null || !isset($prizes[$prizeIndex])) {
        echo json_encode(['error' => 'Invalid prize index']);
        exit;
    }
    $where = 'WHERE phone IS NOT NULL';
    $query = 'SELECT id as vid, code, name, email, phone, updated_at 
              FROM coupons 
              ' . $where . ' 
              ORDER BY RAND()';
    $res = mysql_query($query) or die(mysql_error());
    $coupons = array();
    while ($row = mysql_fetch_assoc($res)) {
        $coupons[] = $row;
    }
    $availableCoupons = array_column($coupons, 'code');
    $winnerIndex = array_rand($availableCoupons);
    $winnerCode = $availableCoupons[$winnerIndex];
    $winner = $coupons[$winnerIndex];
    $now = time();
    $win_date = date('Y-m-d H:i:s', $now);
    $win_id = (int)$winner['vid'];
    $priz_id = $prizeIndex+1;
    $insert_query = "INSERT INTO winners (prize_index, winner_code_id, win_date) VALUES('$priz_id', '$win_id', '$win_date')";
    $res_winners = mysql_query($insert_query);
    if ($winner['email']) {
        $message = "Поздравляем, " . $winner['name'] . "! <br><br><br>" . "Мы рады сообщить, что вы стали победителем нашего розыгрыша!". "<br><br>" .
            "Ваш выигрыш: ".$prizes[$prizeIndex]['name']. "<br><br>" .
            "Ваш купон: ".$winner['code']. "<br><br>"
            . "<br><br><br>" . "Спасибо за участие! Мы свяжемся с вами для передачи приза."
            . "<br><br><br>" . "С уважением, ООО «МИРС»";
        //sendMail($winner['email'], $message);
    }

    // Возвращаем данные победителя

    echo json_encode([
        'code' => $winner['code'],
        'name' => $winner['name'],
        'priz_id' => $priz_id,
        'win_id' => $win_id,
        'win_date' => $win_date,
        'prize' => $prizes[$prizeIndex]['name']
    ]);
    exit;
}

function sendMail($email, $message)
{
    $host = 'smtp.bookmirs.ru';
    $port = 587;
    $username = 'tochka24';
    $password = 'QWERTY';
    $from = 'kds@bookmirs.ru';

    try {
        $socket = fsockopen($host, $port, $errno, $errstr, 30);
        function sendCommand($socket, $command)
        {
            fputs($socket, $command . "\r\n");
            return fgets($socket, 512);
        }

        sendCommand($socket, "HELO localhost");
        sendCommand($socket, "AUTH LOGIN");
        sendCommand($socket, base64_encode($username));
        sendCommand($socket, base64_encode($password));
        sendCommand($socket, "MAIL FROM: <$from>");
        sendCommand($socket, "RCPT TO: <$email>");
        sendCommand($socket, "DATA");

        $headers = "From: $from\r\n";
        $headers .= "To: $email\r\n";
        $headers .= "Subject: Поздравляем с победой в розыгрыше!!! 🎉\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=UTF-8\r\n";

        $fullMessage = $headers . "\r\n" . $message . "\r\n.";
        sendCommand($socket, $fullMessage);
        sendCommand($socket, "QUIT");

        fclose($socket);
    } catch (Exception $e) {
        return true;
    }
    return true;
}

die();