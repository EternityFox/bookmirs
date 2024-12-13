<?php
$token = '7474814466:AAESVh7WLwXBSrad6MrxrhaOHYFUHJMSNOk';
$channelId = "@testovik96"; // Постоянная ссылка на канал
//$channelId = "@your_channel_id"; // Замените на ID вашего канала
$data = file_get_contents('php://input'); // Получаем данные от Telegram
$update = json_decode($data, true); // Декодируем JSON

$prizes = [
    ['name' => 'Приз на 5000 руб.', 'count' => 10],
    ['name' => 'Приз на 10000 руб.', 'count' => 5],
    ['name' => 'Приз на 20000 руб.', 'count' => 3],
    ['name' => 'Главный приз на 50000 руб.', 'count' => 1],
];

// Проверяем тип входящего обновления
if (isset($update['message'])) {
    $chatId = $update['message']['chat']['id'];
    $message = trim($update['message']['text']); // Убираем лишние пробелы
    // Команда /start
    if ($message === '/start') {
        sendKeyboard($chatId, "👋 Добро пожаловать! Выберите действие:", [
            ['text' => '🥉 Выявить победителей на 5 т.р.'],
            ['text' => '🥈 Выявить победителей на 10 т.р.'],
            ['text' => '🏅 Выявить победителей на 20 т.р.'],
            ['text' => '🏆 Выявить победителей на главный приз.'],
            ['text' => '📢 Отправить результат на канал']
        ]);
    }
    // Выявление победителей
    elseif (in_array($message, [
        '🥉 Выявить победителей на 5 т.р.',
        '🥈 Выявить победителей на 10 т.р.',
        '🏅 Выявить победителей на 20 т.р.',
        '🏆 Выявить победителей на главный приз.'
    ])) {
        $index = null;
        if ($message === '🥉 Выявить победителей на 5 т.р.') $index = 0;
        elseif ($message === '🥈 Выявить победителей на 10 т.р.') $index = 1;
        elseif ($message === '🏅 Выявить победителей на 20 т.р.') $index = 2;
        elseif ($message === '🏆 Выявить победителей на главный приз.') $index = 3;

        if ($index !== null) {
            $winners = getWinnersFromAPI($index, $prizes[$index]['count']);
            $prizeName = $prizes[$index]['name'];
            $winnersText = implode("\n", array_map(function($w, $i) {
                return "🎉 Победитель #" . ($i + 1) . ": " . $w['code'];
            }, $winners, array_keys($winners)));
            sendMessage($chatId, "🏆 Итоги для \"$prizeName\":\n\n$winnersText");
        }
    }
    // Отправить результат на канал
    elseif ($message === '📢 Отправить результат на канал') {
        $resultText = fetchAllResults();
        if ($resultText) {
            sendMessageToChannel($channelId, $resultText);
            sendMessage($chatId, "✅ Все результаты успешно отправлены на канал: $channelId");
        } else {
            sendMessage($chatId, "⚠️ Не удалось получить результаты. Попробуйте ещё раз.");
        }
    } else {
        sendMessage($chatId, "🤖 Неизвестная команда. Используйте /start для начала.");
    }
}

// Функция отправки сообщений
function sendMessage($chatId, $text)
{
    global $token;
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $postData = ['chat_id' => $chatId, 'text' => $text, 'parse_mode' => 'Markdown'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

    curl_exec($ch);
    curl_close($ch);
}

// Функция отправки клавиатуры
function sendKeyboard($chatId, $text, $buttons)
{
    global $token;
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $keyboard = ['keyboard' => [$buttons], 'resize_keyboard' => true, 'one_time_keyboard' => false];
    $postData = ['chat_id' => $chatId, 'text' => $text, 'reply_markup' => json_encode($keyboard)];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

    curl_exec($ch);
    curl_close($ch);
}

// Функция получения результатов через API
function fetchAllResults()
{
    $url = 'https://bookmirs.ru/functions/ajax_show_wins.php';
    $resultText = "📢 *Итоги розыгрыша:*\n\n";

    for ($i = 0; $i <= 3; $i++) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . '?prizeIndex=' . $i);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        $response = curl_exec($ch);
        curl_close($ch);

        $winners = json_decode($response, true);
        if (!$winners || empty($winners)) {
            $resultText .= "🏆 *" . getPrizeName($i) . "*:\n⚠️ Нет данных о победителях.\n\n";
            continue;
        }

        $resultText .= "🏆 *" . getPrizeName($i) . "*:\n";
        foreach ($winners as $winner) {
            $resultText .= "🎉 Код купона: `{$winner['code']}`\n";
        }
        $resultText .= "\n";
    }
    return $resultText;
}
function getPrizeName($index)
{
    global $prizes;
    return $prizes[$index]['name'];
}
function getWinnersFromAPI($prizeIndex, $count)
{
    $url = 'https://bookmirs.ru/functions/ajax_calculate_win.php';
    $winners = [];
    for ($i = 0; $i < $count; $i++) {
        $postData = json_encode(['prizeIndex' => $prizeIndex]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);
        if (isset($result['code'])) {
            $winners[] = [
                'code' => $result['code']
            ];
        }
    }
    return $winners;
}

// Функция отправки сообщения в канал
function sendMessageToChannel($channelId, $text)
{
    global $token;
    $url = "https://api.telegram.org/bot$token/sendMessage";
    $postData = ['chat_id' => $channelId, 'text' => $text, 'parse_mode' => 'Markdown'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

    curl_exec($ch);
    curl_close($ch);
}
?>
