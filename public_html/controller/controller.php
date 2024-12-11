<?php

defined('IS_I_SITE') or die('Access denied');

session_start();
// подключение модели
require_once MODEL;
// подключение библиотеки функций
require_once 'functions/functions.php';
//require_once 'functions/image-toolkit/AcImage.php';
/*
if($_SESSION['city'])
{
    $city = ($_SESSION['city']);
}
else
{
// подключаем определятор города
    include("functions/SxGeo.php");
    $SxGeo = new SxGeo('functions/SxGeoCity.dat');
    $city = $SxGeo->get($_SERVER['REMOTE_ADDR']);
    $_SESSION['city']['auto'] = $city['city']['name_ru'];
}
*/
// получение массива каталога
$cats = GetListOfCategories();
$breadcrumb = '<li><a href="/">Главная</a></li>';

$promotions = true;

// регистрация
if ($_POST['reg']) {
    registration();
    redirect();
}
//$authError = $_POST;
// авторизация
if ($_POST['authenticate']) {
    $authData = authorization();
    if ($_SESSION['auth']['role'] == 8) {
        redirect('http://bookmirs.ru/?view=books&cf=true');
    }
}
if ($_POST['clear_filter']) {
    clearFilter();
    redirect();
}
if ($_POST['removeFilter']) {
    removeFilter($_POST['removeFilter']);
    redirect();
}
if ($_POST['setFilter']) {
    getFilterParams(getMaxMinYears());
    if ($_GET['cf']) {
        $redirect = '?view=books';
        header("Location: $redirect");
        exit;
    } else {
        redirect();
    }
}
if ($_POST['promotion']) {
    header("Location: /?view=promotion");
    exit;
}
//отправка формы со страницы детального описания книги (view=page), показывает все книги по автору или по издательству

if ($_POST['toFilter']) {
    setFilterParams();
    $redirect = '?view=books';
    header("Location: $redirect");
    exit;
}
if ($_POST['addtocompare']) {
    $pid = mysql_real_escape_string(trim($_POST['product_id']));
    if ($pid) {
        total_compare();
        if ($_SESSION['total_compare'] > 4) {
            $_SESSION['error'] = '<div class="alert alert-danger">В список сравнения можно поместить не более 5 товаров!</div>' . $notauth;
            echo $_SESSION['error'];
            exit;
        } else {
            $title = getProductTitleById($pid);
            if ($_SESSION['compare']) {
                if (in_array($pid, $_SESSION['compare'])) {
                    $_SESSION['error'] = '<div class="alert alert-warning"><a href="?view=book&book_id=' . $pid . '"><strong>' . $title . '</strong></a> уже в списке для сравнения. <a href="?view=compare">Показать список сравнения</a></div>';
                    echo $_SESSION['error'];
                    exit;
                } else {
                    $_SESSION['compare'][] = $pid;
                    echo '<div class="alert alert-success"><a href="?view=book&book_id=' . $pid . '"><strong>' . $title . '</strong></a> добавлен  список сравнения. <a href="?view=compare">Показать список сравнения</a></div>';
                    exit;
                }
            } else {
                $_SESSION['compare'][] = $pid;
                echo '<div class="alert alert-success"><a href="?view=book&book_id=' . $pid . '"><strong>' . $title . '</strong></a> добавлен  список сравнения. <a href="?view=compare">Показать список сравнения</a></div>';
                exit;
            }
        }
    } else {
        $_SESSION['error'] = '<div class="alert alert-danger">Ошибка добавления в список сравнения</div>';
        echo $_SESSION['error'];
        exit;
    }
} elseif ($_POST['removefromcompare']) {
    $pid = mysql_real_escape_string(trim($_POST['product_id']));
    foreach ($_SESSION['compare'] as $key => $item) {
        if ($item == $pid) {
            unset($_SESSION['compare'][$key]);
            echo 'Удалено';
            exit;
        }
    }
    exit;
} elseif ($_POST['addtofavorites']) {
    $pid = mysql_real_escape_string(trim($_POST['product_id']));

    if ($pid) {


        $title = getProductTitleById($pid);
        if (!$_SESSION['auth']['user']) {
            $notauth = '<div class="alert alert-warning"><strong>Внимание!</strong> Ваш список избранного будет очищен после закрытия браузера. Авторизуйтесь, что бы иметь возможность хранить избранные.</div>';
        }
        if ($_SESSION['favorites']) {
            if (in_array($pid, $_SESSION['favorites'])) {
                $_SESSION['error'] = '<div class="alert alert-warning"><a href="?view=book&book_id=' . $pid . '"><strong>' . $title . '</strong></a> уже в избранном. <a href="?view=favorites">Показать список избранного</a></div>' . $notauth;
                echo $_SESSION['error'];
                exit;
            } else {
                $_SESSION['favorites'][] = $pid;
                echo '<div class="alert alert-success"><a href="?view=book&book_id=' . $pid . '"><strong>' . $title . '</strong></a> добавлен  список избранного. <a href="?view=favorites">Показать список избранного</a></div>' . $notauth;
                exit;
            }
        } else {
            $_SESSION['favorites'][] = $pid;
            echo '<div class="alert alert-success"><a href="?view=book&book_id=' . $pid . '"><strong>' . $title . '</strong></a> добавлен  список избранного. <a href="?view=favorites">Показать список избранного</a></div>' . $notauth;
            exit;
        }
    } else {
        $_SESSION['error'] = '<div class="alert alert-danger">Ошибка добавления в список избранного</div>' . $notauth;
        echo $_SESSION['error'];
        exit;
    }
} elseif ($_POST['sortBy']) {
    $_SESSION['sortby'] = $_POST['sortBy'];
} elseif ($_POST['searchSortBy']) {
    $_SESSION['search']['sortby'] = $_POST['searchSortBy'];
} elseif ($_POST['onPage']) {
    $_SESSION['onpage'] = $_POST['onPage'];
} elseif ($_POST['new_rent']) {
    $errors = array();
    $mail = '';
    foreach (['type' => 'Вид предложения', 'region' => 'Регион', 'city' => 'Город', 'address' => 'Улица, дом', 'area' => 'Предлагаемая площадь', 'contacts' => 'Ф.И.О. и контактный тел.', 'email' => 'Адрес электронной почты', 'extra' => 'Дополнительная информация'] as $code => $name) {
        if (empty($_POST[$code])) $errors[] = '<li>Не заполнено поле "' . $name . '"</li>';
        $mail .= '<strong>' . $name . '</strong>: ' . $_POST[$code] . '<br>';
    }
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array('secret' => '6LcncBsTAAAAAAnwkR0-GI_SNeqozkqK0SuKqORQ', 'response' => $_POST['g-recaptcha-response']);

    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context = stream_context_create($options);
    $result = json_decode(file_get_contents($url, false, $context));
    if (!$result->success) $errors[] = '<li>Неверный результат проверки reCAPTCHA</li>';
    if ($errors) $rent_message = ['mess' => '<ul>' . implode('', $errors) . '</ul>', 'type' => 'error'];
    else {
        unset($_POST);
        mail('nevzorova@bookmirs.ru', 'Заполнена форма "Аренда"', $mail, 'Content-Type: text/html;');
        $rent_message = ['mess' => 'Сообщение успешно отправлено', 'type' => 'ok'];
    }
}
// выход пользователя
if ($_GET['do'] == 'logout') {
    logout();
    redirect();
}

// получение динамичной части шаблона #content
$view = empty($_GET['view']) ? 'main' : $_GET['view'];

if (isShop() && !in_array($view, ['books', 'search', 'shops', 'book', 'vacancies', 'contacts', 'vacancy', 'compare', 'favorites'])) header("Location: /?view=books");
switch ($view) {
    case('main'):
        $limit = 6;
        $promotion_modal = getPromoModal();
        if (isset($promotion_modal) && $promotion_modal)
            if (!isset($_SESSION['promotion']) && $_SESSION['promotion'] !== false)
                $_SESSION['promotion'] = true;
        $news = getNews($limit);
        $shops = getShops();
        $banners = getBanners();
        $vacancies = getVacancies();
        break;
    case('news'):
        $limit = 50;
        $news = getNews($limit);
        $breadcrumb .= '<li class="active"><a href="?view=news">Новости</a</li>';
        break;
    case('news_detail'):
        $news_id = abs((int)$_GET['news_id']);
        addHit('news', 'news_id', $news_id);
        $otherNews = getOtherNews($news_id, '3');
        $newsDetail = getNewsDetail($news_id);
        $breadcrumb .= '<li><a href="?view=news">Новости</a</li><li class="active"><a href="?view=news_detail&news_id=' . $news_id . '">' . $newsDetail['title'] . '</a></li>';
        break;
    case('user'):
        // Страница пользователя
        break;
    case('contacts'):
        // Контакты
        break;
    case('promotion'):
        $view = 'promotion';
        $shops = getShops();
        $questions = getQuestions();
        $winners = getWinnersAll();
        $coupons_chance = getChanceWin();
        $_SESSION['promotion'] = false;
        break;
    case('compare'):
        $compare_books = getCompareData($_SESSION['compare']);
        break;
    case('vacancies'):
        // Вакансии
        $vacancies = getVacancies();
        $breadcrumb .= '<li><a class="active" href="?view=vacancies">Вакансии</a></li>';
        break;
    case('vacancy'):
        $vacancy_id = abs((int)$_GET['vacancy_id']);
        addHit('vacancies', 'vacancy_id', $vacancy_id);
        $vacancy = getVacancy($vacancy_id);
        $breadcrumb .= '<li><a href="?view=vacancies">Вакансии</a></li><li><a href="?view=vacancy&vacancy_id=' . $vacancy_id . '">' . $vacancy['title'] . '</a></li>';
        break;

    case('books'):
        // параметры для навигации
        total_compare();
        total_feautured();
        if ($_GET['cf'] == true) {
            unset($_SESSION['filter']);
            unset($_SESSION['sortby']);
        }
        if ($_SESSION['onpage']) {
            $perpage = $_SESSION['onpage'];
        } else {
            $perpage = 25;
        }
        $books_category = abs((int)$_GET['category']);
        //возвращает список всех категорий, вклюячая родительские
        if (!$books_category) {
            $book_category = 0;
        }
        $category_name = getCategoryName($books_category);
        $category_list = getFullCategories($books_category);
        $child_categories = getChildCategories($books_category);

        if (isset($_GET['page'])) {
            $page = (int)$_GET['page'];
            if ($page < 1) $page = 1;
        } else {
            $page = 1;
        }
        $count_rows = countRows($category_list); // общее кол-во товаров
        $pages_count = ceil($count_rows / $perpage); // кол-во страниц
        if (!$pages_count) $pages_count = 1; // минимум 1 страница
        if ($page > $pages_count) $page = $pages_count; // если запрошенная страница больше максимума
        $start_pos = ($page - 1) * $perpage; // начальная позиция для запроса
        // каталог книжек
        // ДАННЫЕ ДЛЯ ФИЛЬТРА //
        //список авторов для выбора в фильтре
        $authors = getAuthors();
        //список издательств для выбора в фильтре
        $publishes = getPublish();
        //минимальный/макимальный год издания в базе
        $years = getMaxMinYears();
        if (($_SESSION['filter']['authors']) && (count($_SESSION['filter']) == 1) && (!$_GET['category'])) {
            $filterOnly = "author";
        } elseif (($_SESSION['filter']['publishes']) && (count($_SESSION['filter']) == 1) && (!$_GET['category'])) {
            $filterOnly = "publish";
        }
        $books = getBooks($category_list, $_SESSION['sortby'], $start_pos, $perpage);

//        $breadcrumb .= '<li><a href="?view=books">Каталог</a></li>';
//        if ($books_category) {
//            $breadcrumb .= '<li class="active"><a href="?view=books&category='.$books_category.'">'.$category_name.'</a></li>';
//        }
        break;
    /*    case('book'):
            $book_id = abs( (int)$_GET['book_id'] );
            if($book_id)
            {
                addHit('products', 'product_id', $book_id);
                $book = getBook($book_id);
                $category_name = getCategoryName($book['category_id']);
                $book_offer = getBookOffer($book_id);
                $breadcrumb .= '<li><a href="?view=books">Каталог</a></li><li><a href="?view=books&category='.$book['category_id'].'">'.$category_name.'</a></li><li><a class="active" href="?view=book&book_id='.$book_id.'">'.$book['title'].'</a></li>';
            }
        break;
    */
    case('page'):
        $page_id = abs((int)$_GET['page_id']);
        $page = getPage($page_id);
        if (($page_id >= 4) && ($page_id <= 8)) {
            $subcat = '<li><a href="?view=page&page_id=1#stationary">Канцтовары</a></li>';
        }
        $breadcrumb .= $subcat . '<li><a class="active" href="?view=page&page_id=' . $page_id . '">' . $page['title'] . '</a></li>';
        break;
    case('shops'):
        $shops = getShops();
        $breadcrumb .= '<li><a class="active" href="?view=shops">Адреса магазинов</a></li>';
        break;
    case('addtocart'):
        // добавление в корзину
        $product_id = abs((int)$_GET['product_id']);
        addtocart($product_id);
        $_SESSION['total_sum'] = total_sum($_SESSION['cart']);
        // кол-во товара в корзине + защита от ввода несуществующего ID товара
        total_quantity();
        redirect();
        break;

    case('cart'):
        /* корзина */
        // получение способов доставки
        $shipping = getShippingMethod();

        // пересчет товаров в корзине
        if (isset($_GET['id'], $_GET['qty'])) {
            $product_id = abs((int)$_GET['id']);
            $qty = abs((int)$_GET['qty']);

            $qty = $qty - $_SESSION['cart'][$product_id]['qty'];
            addtocart($product_id, $qty);

            $_SESSION['total_sum'] = total_sum($_SESSION['cart']); // сумма заказа

            total_quantity(); // кол-во товара в корзине + защита от ввода несуществующего ID товара
            redirect();
        }
        // удаление товара из корзины
        if (isset($_GET['delete'])) {
            $id = abs((int)$_GET['delete']);
            if ($id) {
                delete_from_cart($id);
            }
            redirect();
        }
        if ($_POST['make_order']) {
            add_order();
            redirect();
        }
        break;

    case('reg'):
        // регистрация
        break;
    case('search'):
        $search_word = clear($_GET['q']);
        if ($search_word) {
            logSearch($search_word, getIP());
            if ($_SESSION['onpage']) {
                $perpage = $_SESSION['onpage'];
            } else {
                $perpage = 25;
            }
            if (isset($_GET['page'])) {
                $page = (int)$_GET['page'];
                if ($page < 1) $page = 1;
            } else {
                $page = 1;
            }
            $count_rows = search($search_word, $_SESSION['search']['sortby'], false, false, true); // общее кол-во товаров
            $pages_count = ceil($count_rows / $perpage); // кол-во страниц
            if (!$pages_count) $pages_count = 1; // минимум 1 страница
            if ($page > $pages_count) $page = $pages_count; // если запрошенная страница больше максимума
            $start_pos = ($page - 1) * $perpage; // начальная позиция для запроса
            $books = search($search_word, $_SESSION['search']['sortby'], $start_pos, $perpage);
        }
        print '<!--hhh' . $count_rows . '-->';
        $breadcrumb .= '<li><a href="?view=search">Поиск</a></li>';
        break;
    case('city_change'):
        if ($_GET['city']) {
            $_SESSION['city']['current'] = $_GET['city'];
        }
        redirect();
        break;
    case 'favorites':
        if (isset($_GET['id'])) removeFavorite($_GET['id']);
        $books = getFavorites();
        break;
    case 'equipment':
        if ($_POST['sortByEquipment']) {
            $_SESSION['sortbye'] = $_POST['sortByEquipment'];
        } elseif ($_POST['onPageEquipment']) {
            $_SESSION['onpagee'] = $_POST['onPageEquipment'];
        }
        $equipment = getEquipment();
        break;
    case 'equipment_detail':
        $equipment = getEquipmentById($_GET['id']);
        break;
    default:
        // если из адресной строки получено имя несуществующего вида
        $view = 'main';
        $news = getNews();
        $shops = getShops();
        $vacancies = getVacancies();
}

// подключени вида
require_once TEMPLATE . 'index.php';
