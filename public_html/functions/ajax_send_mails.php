<?php
session_start();
if ($_POST) {
    $name = htmlspecialchars($_POST["name"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $email = htmlspecialchars($_POST["email"]);
    $sender = htmlspecialchars($_POST["sender"]);
    $message = htmlspecialchars($_POST["message"]);

    $json = array();
    if (!$email) {
        $json['error'] = 'Укажите свой e-mail=, чтобы мы могли с вами связаться!';
        echo json_encode($json);
        die();
    }
    if ($phone) {
        $message = $message . ' <br><br><br><-> Обратный e-mail: ' . $email . ' <-> Обратный номер телефона: ' . $phone . ' <-> Имя отправителя: ' . $name;
    } else {
        $message = $message . '<br><br><br> <-> Обратный e-mail: ' . $email . ' <-> Имя отправителя: ' . $name;
    }

    $host = 'smtp.bookmirs.ru';
    $port = 587;
    $username = 'tochka24';
    $password = 'QWERTY';
    $from = 'robot@bookmirs.ru';

    $socket = fsockopen($host, $port, $errno, $errstr, 30);
    if (!$socket) {
        die("Не удалось подключиться: $errstr ($errno)");
    }

    function sendCommand($socket, $command)
    {
        fputs($socket, $command . "\r\n");
        return fgets($socket, 512);
    }

    echo sendCommand($socket, "HELO localhost");
    echo sendCommand($socket, "AUTH LOGIN");
    echo sendCommand($socket, base64_encode($username));
    echo sendCommand($socket, base64_encode($password));
    echo sendCommand($socket, "MAIL FROM: <$from>");
    echo sendCommand($socket, "RCPT TO: <$sender>");
    echo sendCommand($socket, "DATA");

    $headers = "From: $from\r\n";
    $headers .= "To: $sender\r\n";
    $headers .= "Subject: Ответ на ваш вопрос на сайте bookmirs.ru\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";

    $fullMessage = $headers . "\r\n" . $message . "\r\n.";
    echo sendCommand($socket, $fullMessage);
    echo sendCommand($socket, "QUIT");

    fclose($socket);


} else {
    echo 'GET LOST!';
}
?>
