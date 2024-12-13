<?php
$token = '7474814466:AAESVh7WLwXBSrad6MrxrhaOHYFUHJMSNOk';
$webhookUrl = 'https://bookmirs.ru/functions/telegram_bot.php';

$setWebhookUrl = "https://api.telegram.org/bot$token/setWebhook?url=$webhookUrl";
file_get_contents($setWebhookUrl);
?>
