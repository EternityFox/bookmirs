<?php

defined('IS_I_SITE') or die('Access to config denied');

// домен
define('PATH', 'https://bookmirs.ru/');

// модель
define('MODEL', 'model/model.php');

// контроллер
define('CONTROLLER', 'controller/controller.php');

// вид
define('VIEW', 'views/');

// активный шаблон
define('TEMPLATE', VIEW.'bookmirs/');

// активный шаблон
define('ADMINTEMPLATE', '../'.VIEW.'admin/');

//тестовый шаблон
define('TESTTEMPLATE', '../'.VIEW.'test/');

// папка с картинками контента
define('PRODUCTIMG', PATH.'media/');

// сервер БД
define('HOST', 'localhost');

// пользователь
define('USER', 'ooomirs_bookmirs');

// пароль
define('PASS', 'A%*K5IN!');

// БД
define('DB', 'ooomirs_bookmirs');

// название магазина - title
define('TITLE', 'Книготорговая компания МИРС');

// email администратора
define('ADMIN_EMAIL', 'web@bookmirs.ru');

mysql_connect(HOST, USER, PASS) or die('No connect to Server');
mysql_select_db(DB) or die('No connect to DB');
mysql_query("SET NAMES 'UTF8'") or die('Cant set charset');