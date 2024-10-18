<?php

defined('IS_I_SITE') or die('Access denied');
session_start();

// подключение модели
require_once '../model/model.php';
// подключение библиотеки функций
require_once '../functions/functions.php';

$view = empty($_GET['view']) ? 'main' : $_GET['view'];
switch($view){
    case('main'):
        $limit = 6;
        $news = getNews($limit);
        $shops = getShops();
        $banners = getBanners();
        $vacancies = getVacancies();
        break;
    default:
        // если из адресной строки получено имя несуществующего вида
        $view = 'main';
        $news = getNews();
        $shops = getShops();
}

// подключени вида
require_once '../views/test/index.php';