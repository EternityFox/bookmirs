<?php

defined('IS_I_SITE') or die('Access denied');
session_start();

// подключение модели
require_once '../model/admin_model.php';
// подключение библиотеки функций
require_once '../functions/functions.php';

// авторизация
if ($_POST['auth']) {
    authorization();
    redirect();
}
if (!($_SESSION['auth']['user'])) {
    require_once '../views/admin/login.php';
    die();
}

checkRole();
// получение динамичной части шаблона #content
$view = empty($_GET['view']) ? 'dash' : $_GET['view'];
if ($_POST['add_news']) {
    addNews();
    header("Location: /admin/?view=news");
    exit;
} elseif ($_POST['delete_news']) {
    deleteNews();
    redirect();
} elseif ($_POST['edit_news']) {
    editNews();
    header("Location: /admin/?view=news");
} elseif ($_POST['add_vacancy']) {
    addVacancy();
    header("Location: /admin/?view=vacancies");
    exit;
} elseif ($_POST['delete_vacancy']) {
    deleteVacancy();
    redirect();
} elseif ($_POST['edit_vacancy']) {
    editVacancy();
    header("Location: /admin/?view=vacancies");
} elseif ($_POST['add_question']) {
    addQuestion();
    header("Location: /admin/?view=questions");
    exit;
} elseif ($_POST['delete_question']) {
    deleteQuestion();
    redirect();
} elseif ($_POST['edit_question']) {
    editQuestion();
    header("Location: /admin/?view=questions");
} elseif ($_POST['add_shop']) {
    addShop();
    header("Location: /admin/?view=shops");
} elseif ($_POST['edit_shop']) {
    editShop();
    header("Location: /admin/?view=shops");
    exit;
} elseif ($_POST['user_edit']) {
    if ($_POST['pwd'] == $_POST['pwd2']) {
        $res = saveUser();
        if ($res !== true) {
            $error = $res;
            $user = $_POST;
        } else
            header("Location: /admin/?view=users");
    } else $error = "Не совпадают пароли";
} elseif ($_POST['page_edit']) {
    updatePage();
}
switch ($view) {
    case('dash'):


        $stat = array();
        $stat['shops'] = countShops();
        $stat['products'] = countProducts();
        $stat['offers'] = countOffers();
        $stat['vacancies'] = countVacancies();
        $stat['news'] = countNews();
        $stat['users'] = countUsers();

        $news = getNews(3, 'hits');
        $vacancies = getVacancies(5, 'vacancies.hits');
        $products = getProducts(10, 'hits');
        break;
    case('news'):
        $news = getNews();
        break;
    case('add_news'):
        break;
    case('edit_news'):
        $news_id = abs((int)$_GET['news_id']);
        $news = getNewsDetail($news_id);
        break;

    case('questions'):
        $questions = getQuestions();
        break;
    case('add_question'):
        break;
    case('edit_question'):
        $question_id = $_GET['question_id'];
        $question = getQuestionDetail($question_id);
        break;
    case('vacancies'):
        $vacancies = getVacancies();
        break;
    case('add_vacancy'):
        break;
    case('edit_vacancy'):
        $vacancy_id = abs((int)$_GET['vacancy_id']);
        $vacancy = getVacancyDetail($vacancy_id);
        break;
    case('shops'):
        $shops = getShops();
        break;
    case('add_shop'):
        break;
    case('edit_shop'):
        $shop_id = abs((int)$_GET['shop_id']);
        $shop = getShopDetail($shop_id);
        break;
    case('help'):
        break;
    case('import'):
        //по какой-то причине временной интервал пока не считает
        //$interval = checkImportActuality();
        $logs = getImportLog();
        break;
    case('search_setting'):
        $products['all'] = countProducts();
        $products['empty'] = countSearchEmptyProducts();
        $percentage = percent($products['all'], $products['empty']);
        $lastQueries = getLastSearchQuery();
        break;
    case 'users':
        $users = getUsers();
        $users_count = countUsers();
        $per_page = isset($_GET['limit']) ? $_GET['limit'] : 15;
        $page_count = ceil($users_count / $per_page);
        $cur_page = isset($_GET['page']) ? $_GET['page'] : 1;
        break;
    case 'add_user':
        if (isset($_GET['id']))
            $user = getUser($_GET['id']);
        $shops = getShops();
        $shops = prepareShopsArray($shops);
        break;
    case 'delete_user':
        deleteUser($_GET['id']);
        header("Location: ?view=users");
        break;
    case 'edit_page':
        $page = getPage($_GET['id']);
        break;
    case 'equipment':
        $equipment = getEquipment();

        if (isset($_POST['delete'])) {
            deleteEquipment($_POST['id']);
        }
        break;
    case 'edit_equipment':
        if (isset($_GET['id'])) {
            $equipment = getEquipmentById($_GET['id']);
        }

        if (isset($_POST['save'])) {
            saveEquipment($_POST, $_FILES);
        }
        break;
    case 'banners':
        $banners = getBanners();

        if (isset($_POST['delete'])) {
            deleteBanner($_POST['id']);
        }
        break;
    case 'banner':
        if (isset($_GET['id'])) {
            $banner = getBanner($_GET['id']);
        }

        if (isset($_POST['save'])) {
            saveBanner($_POST, $_FILES);
        }
        break;
    default:
        $view = 'dash';
}

// подключени вида
require_once '../views/admin/index.php';