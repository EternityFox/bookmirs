<?php
define('IS_I_SITE', TRUE);
require_once '../config.php';
header("Content-type: text/html; charset=UTF-8");
$agree = $_POST['agree'];
$ip = $_SERVER['REMOTE_ADDR'];
$time_limit = 300;
$max_attempts = 5;

function checkAttempts($ip, $time_limit, $max_attempts)
{
    $now = time();
    $recent_time = date('Y-m-d H:i:s', $now - $time_limit);
    $sql = "SELECT * FROM attempts WHERE ip_address = '$ip' AND attempt_time >= '$recent_time'";
    $query = mysql_query($sql);

    if (mysql_num_rows($query) > 0) {
        $row = mysql_fetch_assoc($query);
        if ($row['attempt_count'] >= $max_attempts) {
            return false; // Блокировка
        } else {
            $new_count = $row['attempt_count'] + 1;
            mysql_query("UPDATE attempts SET attempt_count = $new_count, attempt_time = NOW() WHERE id = " . $row['id']);
        }
    } else {
        mysql_query("INSERT INTO attempts (ip_address, attempt_time, attempt_count) VALUES ('$ip', NOW(), 1)");
    }
    return true; // Доступ разрешен
}

if (!checkAttempts($ip, $time_limit, $max_attempts)) {
    echo '{"success": false,"message":"Слишком много попыток. Попробуйте снова через 5 минут."}';
    exit();
}

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
                echo '{"success": true,"message":"Купон успешно зарегистрирован"}';
                if ($email) {
                    $message = "Здравствуйте, " . $name . "! <br><br><br>" . "Мы рады сообщить, что ваш купон под № " . $code . " успешно зарегистрирован в системе." . "<br><br><br>" .
                        "Теперь вы участвуете в розыгрыше призов, который пройдет 16.12.2024. Мы обязательно свяжемся с вами, если вы станете одним из победителей!"
                        . "<br><br><br>" . "Если у вас возникнут вопросы, вы всегда можете обратиться к нам по mirs@bookmirs.ru или по телефону: +7 (4212) 47-00-47"
                        . "<br><br><br>" . "Спасибо, что участвуете! Удачи в розыгрыше!"
                        . "<br><br><br>" . "С уважением, ООО «МИРС»";
                    sendMail($email, $message);
                }
            } else {
                echo 'Произошла ошибка, попробуйте чуть позже или свяжитесь с нами';
            }
        } else {
            if ($row['phone'] == $phone || $row['email'] == $email || $row['name'] == $name) {
                echo '{"success": true,"message":"Данный купон уже был зарегистрирован вами"}';
            } else {
                echo '{"success": false,"message":"Данный купон зарегистрирован на другого пользователя"}';
            }
        }
    } else {
        echo '{"success": false,"message":"Данного купона не существует"}';
    }
} else {
    echo '{"success": false,"message":"Нужно дать согласие на обработку персональных данных, иначе не получиться зарегистрировать купон"}';
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
        $headers .= "Subject: Ваш купон успешно зарегистрирован! 🎉\r\n";
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