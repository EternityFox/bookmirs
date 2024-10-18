<?php

defined('IS_I_SITE') or die('Access denied');

/* ===Подготовка массива городов=== */
function prepareShopsArray($data){
    $result = array(); $j = 0;
    foreach($data as $i => $item){
            if($i && $i != ''){    
            $result['city'][$j] = $i;
            $result['shops'][$i] = $item;
            $j++;
        }
    }
    return $result;
}
/* ===Подготовка массива городов=== */

/* ===Распечатка массива=== */
function print_arr($arr){
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}
/* ===Распечатка массива=== */

/* ===Фильтрация входящих данных=== */
function clear($var){
    $var = mysql_real_escape_string(strip_tags(trim($var)));
    return $var;
}
function dateFormat($date) {
	$month = array(1=>'января',2=>'февраля',3=>'марта',4=>'апреля',5=>'мая',6=>'июня',7=>'июля',8=>'августа',9=>'сентября',10=>'октября',11=>'ноября',12=>'декабря',);
	$d = date( 'j', strtotime($date) );
	$m = date( 'n', strtotime($date) );
	$y = date( 'Y', strtotime($date) );
	return $d . ' ' .$month[$m] . ' ' .$y;
}
/* ===Фильтрация входящих данных=== */

/* ===Редирект=== */
function redirect($url){
    if(!$url){$redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;}
    else{ $redirect = $url; }
    header("Location: $redirect");
    exit;
}

/* ===Редирект=== */

/* ===Выход пользователя=== */
function logout(){
    unset($_SESSION['auth']);
}
/* ===Выход пользователя=== */

/* ===Добавление в корзину=== */
function addtocart($product_id, $qty = 1){
    if(isset($_SESSION['cart'][$product_id])){
        // если в массиве cart уже есть добавляемый товар
        $_SESSION['cart'][$product_id]['qty'] += $qty;
        return $_SESSION['cart'];
    }else{
        // если товар кладется в корзину впервые
        $_SESSION['cart'][$product_id]['qty'] = $qty;
        return $_SESSION['cart'];
    }
}
/* ===Добавление в корзину=== */

/* ===Удаление из корзины=== */
function delete_from_cart($id){
    if($_SESSION['cart']){
        if(array_key_exists($id, $_SESSION['cart'])){
            $_SESSION['total_quantity'] -= $_SESSION['cart'][$id]['qty'];
            $_SESSION['total_sum'] -= $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
            unset($_SESSION['cart'][$id]);
        }
    }
}
/* ===Удаление из корзины=== */

/* ===кол-во товара в корзине + защита от ввода несуществующего ID товара=== */
function total_compare(){
    $_SESSION['total_compare'] = 0;
	if($_SESSION['compare'])
	{
		foreach($_SESSION['compare'] as $key => $value){
			if(isset($value)){
				// если получена цена товара из БД - суммируем кол-во
				$_SESSION['total_compare']++;
			}else{
				// иначе - удаляем такой ID из сессиии (корзины)
				unset($_SESSION['compare'][$key]);
			}
		}
	}
}
function total_feautured(){
    $_SESSION['total_feautured'] = 0;
	if($_SESSION['feautured'])
	{
		foreach($_SESSION['feautured'] as $key => $value){
			if(isset($value)){
				// если получена цена товара из БД - суммируем кол-во
				$_SESSION['total_feautured']++;
			}else{
				// иначе - удаляем такой ID из сессиии (корзины)
				unset($_SESSION['feautured'][$key]);
			}
		}
	}
}
/* ===кол-во товара в корзине + защита от ввода несуществующего ID товара=== */


/* ===Постраничная навигация=== */
function pagination($page, $pages_count){
    if($_SERVER['QUERY_STRING']){ // если есть параметры в запросе
        foreach($_GET as $key => $value){
            // формируем строку параметров без номера страницы... номер передается параметром функции
           if($key != 'page') $uri .= "{$key}={$value}&amp;";
        }  
    }
    
    // формирование ссылок
    $back = ''; // ссылка НАЗАД
    $forward = ''; // ссылка ВПЕРЕД
    $startpage = ''; // ссылка В НАЧАЛО
    $endpage = ''; // ссылка В КОНЕЦ
    $page2left = ''; // вторая страница слева
    $page1left = ''; // первая страница слева
    $page2right = ''; // вторая страница справа
    $page1right = ''; // первая страница справа
    
    if($page > 1){
        $back = "<li><a class='nav_link' href='?{$uri}page=" .($page-1). "'>&lt;</a></li>";
    }
    if($page < $pages_count){
        $forward = "<li><a class='nav_link' href='?{$uri}page=" .($page+1). "'>&gt;</a></li>";
    }
    if($page > 3){
        $startpage = "<li><a class='nav_link' href='?{$uri}page=1'>&laquo;</a></li>";
    }
    if($page < ($pages_count - 2)){
        $endpage = "<li><a class='nav_link' href='?{$uri}page={$pages_count}'>&raquo;</a></li>";
    }
    if($page - 2 > 0){
        $page2left = "<li><a class='nav_link' href='?{$uri}page=" .($page-2). "'>" .($page-2). "</a></li>";
    }
    if($page - 1 > 0){
        $page1left = "<li><a class='nav_link' href='?{$uri}page=" .($page-1). "'>" .($page-1). "</a></li>";
    }
    if($page + 2 <= $pages_count){
        $page2right = "<li><a class='nav_link' href='?{$uri}page=" .($page+2). "'>" .($page+2). "</a></li>";
    }
    if($page + 1 <= $pages_count){
        $page1right = "<li><a class='nav_link' href='?{$uri}page=" .($page+1). "'>" .($page+1). "</a></li>";
    }
    
    // формируем вывод навигации
    echo '<ul class="pagination">' .$startpage.$back.$page2left.$page1left.'<li class="active"><a href="#">'.$page.'<span class="sr-only">(current)</span></a></li>'.$page1right.$page2right.$forward.$endpage. '</ul>';
}
/* ===Постраничная навигация=== */

function thumbler($file)
{
	if($file)
	{
		$savePath = 'media/product_img/thumbs/'.$file;
		if (file_exists($savePath)) {}
		else
		{
			$filePath = 'media/'.$file;
			$width = 240;
			$height = 240;
			$image = AcImage::createImage($filePath);
			$image
			->thumbnail($width, $height)
			->save($savePath);
		}
	}
	else 
	{
		$savePath='';
	}
	return $savePath;
}
function getFilterParams($year){
	if($_POST['title']){
		$_SESSION['filter']['title'] = clear($_POST['title']);
	}
	else {
		unset($_SESSION['filter']['title']);
	}
	if($_POST['isbn']){
		$_SESSION['filter']['isbn'] = clear($_POST['isbn']);
	}
	else {
		unset($_SESSION['filter']['isbn']);
	}
	if($_POST['authors']){
		$_SESSION['filter']['authors'] = clear($_POST['authors']);
	}
	else {
		unset($_SESSION['filter']['authors']);
	}
	if($_POST['publishes']){
		$_SESSION['filter']['publishes'] = clear($_POST['publishes']);
	}
	else {
		unset($_SESSION['filter']['publishes']);
	}
	if($_POST['year-min']){
		if($_POST['year-min']!=$year['min']){
			$_SESSION['filter']['year-min'] = clear($_POST['year-min']);
		}
		else {
			unset($_SESSION['filter']['year-min']);
		}
	}
	else {
		unset($_SESSION['filter']['year-min']);
	}
	if($_POST['year-max']){
		if($_POST['year-max']!=$year['max']){
			$_SESSION['filter']['year-max'] = clear($_POST['year-max']);
		}
		else {
			unset($_SESSION['filter']['year-max']);
		}
	}
	else {
		unset($_SESSION['filter']['year-max']);
	}
}
function setFilterParams(){
	unset($_SESSION['filter']);
	$_SESSION['filter'][$_POST['toFilter']] = $_POST['filter_value'];
}
function clearFilter() {
	unset($_SESSION['filter']);
}
function removeFilter($filter) {
	if($filter=='years') {
		unset($_SESSION['filter']['year-min']);
		unset($_SESSION['filter']['year-max']);
	}
	else {
		unset($_SESSION['filter'][$filter]);
	}
}
function screening($text) {
	$symbols = array('"','\"');
	$screenSymbols = array('&quot;','"');
	$text = str_replace($symbols, $screenSymbols, $text);
	return $text;
}

function getCurrentShop($array, $shopID){
    $result = false;
    foreach( $array as $key => $city ){
        foreach($city as $item){
            if( $item['shop_id'] ==  $shopID){
                $result = $item;
                $result['city'] = $key;
            }   
        }
    }
    return $result;
}

function getIP()
{
	if (getenv("HTTP_CLIENT_IP") and strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
		$ip = getenv("HTTP_CLIENT_IP"); 
	elseif (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"),"unknown"))
		$ip = getenv("HTTP_X_FORWARDED_FOR"); 
	elseif (getenv("REMOTE_ADDR") and strcasecmp(getenv("REMOTE_ADDR"),"unknown"))
		$ip = getenv("REMOTE_ADDR"); 
	elseif (!empty($_SERVER['REMOTE_ADDR']) and strcasecmp($_SERVER['REMOTE_ADDR'],"unknown"))
		$ip = $_SERVER['REMOTE_ADDR'];
	else
		$ip = "unknown";
 
	return($ip);
}

function isShop()
{
	$res = mysql_query("SELECT * FROM shops WHERE ip_address='".getIP()."'");
	if ($res) return mysql_fetch_assoc($res);
	return false;
}
