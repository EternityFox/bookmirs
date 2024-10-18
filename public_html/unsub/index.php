<?php
$url = parse_url($_SERVER['REQUEST_URI']);
$a = file_get_contents('http://send.bookmirs.ru/?'.$url['query']);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Отмена рассылки</title>
	</head>
	<body>
<?php
if (strpos($a, 'Рассылка на данный адрес удалена') !== false) print 'Рассылка на данный адрес удалена';
else print 'Ошибка отмены рассылки';
?>
	</body>
</html>