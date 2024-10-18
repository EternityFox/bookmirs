<?php
defined('IS_I_SITE') or die('Access to model denied');

function getNews($limit='')
{
    $where = ' WHERE active = 1';
    if($limit) {$limit = ' LIMIT '.$limit;}
    if($cat)
    {
        $where .= " and category = '".$cat."'";
    }
    $order = ' ORDER BY event_date DESC';
    $query = 'SELECT news_id, title, short_desc, event_date, hits, img FROM news'.$where.$order.$limit;
    $res = mysql_query($query) or die(mysql_query());
    $news = array();
    $i=0;
    while($row = mysql_fetch_assoc($res))
    {
        $news[$i]['news_id'] = $row['news_id'];
        $news[$i]['title'] = $row['title'];
        $news[$i]['short_desc'] = $row['short_desc'];
        $news[$i]['event_date'] = $row['event_date'];
        $news[$i]['hits'] = $row['hits'];
        $news[$i]['img'] = $row['img'];
        $news[$i]['user'] = getUserName($row['user_id']);
        $i++;
    }
    return $news;
}
function getOtherNews($news_id, $count) {
    $query = "SELECT news_id, title, short_desc, img FROM news  WHERE news_id<>'".$news_id."' ORDER BY event_date DESC LIMIT ".$count;
    $res = mysql_query($query) or die(mysql_query());
    $otherNews = array();
    while($row = mysql_fetch_assoc($res))
    {
        $otherNews[] = $row;
    }
    return $otherNews;
}
function addHit($table, $ident, $id) {
    $query = "UPDATE ".$table." SET hits = hits + 1 WHERE ".$ident." = ".$id;
    $res = mysql_query($query) or die(mysql_query());
    return $res;

}
function getVacancies()
{
    //$query = 'SELECT vacancy_id, title, city, add_date FROM vacancies';
    $query = 'SELECT * FROM vacancies';
    $res = mysql_query($query) or die(mysql_query());
    $vacancies = array();
    while($row = mysql_fetch_assoc($res))
    {
        $vacancies[] = $row;
    }
    return $vacancies;
    
}
function getUserName($user_id)
{
    $query = mysql_query("SELECT name FROM users WHERE user_id='".$user_id."'");
    $user = mysql_fetch_array($query);
    return $user['name'];
}
function getVacancy($vacancy_id)
{
    $query = "SELECT * FROM vacancies WHERE vacancy_id='".$vacancy_id."' LIMIT 1";
    $res = mysql_query($query);
    $vacancy = mysql_fetch_assoc($res);
    return $vacancy;
}
function getNewsDetail($news_id)
{
    $query = "SELECT * FROM news WHERE news_id='".$news_id."' LIMIT 1";
    $res = mysql_query($query);
    $newsDetail = mysql_fetch_assoc($res);
    $newsDetail['user'] = getUserName($newsDetail['user_id']);
    return $newsDetail;
}
function getPage($page_id)
{
    $query = "SELECT * FROM pages WHERE page_id='".$page_id."' LIMIT 1";
    $res = mysql_query($query);
    $page = mysql_fetch_assoc($res);
    return $page;
}
function GetListOfCategories() 
{
    $result = mysql_query ("SELECT name, category_id, parent, xml_id FROM categories WHERE active='1'"); 
    $cats = array(); 
    while($cat =  mysql_fetch_assoc($result)) $cats[$cat['parent']][] =  $cat;
    return $cats;
}
function createTree($cats,$parent){
   if(is_array($cats) and  isset($cats[$parent])){
    $tree = '<ul class="sf-menu sf-vertical sf-js-enabled sf-arrows">';
    foreach($cats[$parent] as $cat){
        $tree .= '<li><a href="?view=books&amp;category='.$cat['category_id'];
        $tree .= '">'.$cat['name'].'</a>';
        $tree .=  createTree($cats,$cat['category_id']);
        $tree .= '</li>';         
    }
    $tree .= '</ul>';
   } 
   else return null;          
return $tree;        
}
/* ====Каталог - получение массива=== */
function getCategories(){
    $query = "SELECT * FROM categories ORDER BY parent, name";
    $res = mysql_query($query) or die(mysql_query());

    //массив категорий
    $cat = array();
    while($row = mysql_fetch_assoc($res)){
        if(!$row['parent']){
            $cat[$row['category_id']][] = $row['name'];
        }else{
            $cat[$row['parent']]['sub'][$row['category_id']] = $row['name'];
        }
    }
    return $cat;
}
function getParentCategory($category)
{
    $query = mysql_query("SELECT parent FROM categories WHERE category_id='".$category."'");
    $data = mysql_fetch_array($query);
    return $data['parent'];
}
function getCategoryName($category)
{
    $query = mysql_query("SELECT name FROM categories WHERE category_id='".$category."'");
    $data = mysql_fetch_array($query);
    return $data['name'];
}
function getChildCategories($category){
    $query = "SELECT name, category_id FROM categories WHERE parent='".$category."'";
    $res = mysql_query($query) or die(mysql_query());
    $cat = array();
    $i=0;
    while($row = mysql_fetch_assoc($res)){
        $list_categories = getFullCategories($row['category_id']);
        $count_rows = countRows($list_categories);
        $cat[$i]['name'] = $row['name'];
        $cat[$i]['category_id'] = $row['category_id'];
        $cat[$i]['count_rows'] = $count_rows;
        $i++;
    }
    return $cat;
}
function getProductTitleById($pid)
{
    $query = mysql_query("SELECT title FROM products WHERE product_id='".$pid."'");
    $data = mysql_fetch_array($query);
    return $data['title'];
}
function getFullCategories($category)
{
    $listOfCat=array();
    $list = $category;
    $listOfCat[]=$category;
    for ($i=0; $i<4; $i++)
    {
        foreach($listOfCat as $value)
        {
            $result = mysql_query("SELECT category_id FROM categories WHERE parent = '".$value."'");
            while($row = mysql_fetch_array($result))
            {
                if (in_array($row['category_id'],$listOfCat)) {}
                else {$listOfCat[]= $row['category_id'];}
            }
        }
    }
    foreach($listOfCat as $value)
    {
        $list .= ",".$value;
    }
    
    return $list;
}
function getBreadcrumbCategories($category)
{
    $fullCategories = $category;
    while ($cat=getParentCategory($category))
    {
        $fullCategories .= ','.$cat;
        $category = $cat;
    }
    return $fullCategories;

}
/* ===Получение кол-ва товаров для навигации=== */
function countRows($categories){
    $WHERE = " category_id IN ($categories)";
    if ($_SESSION['filter']['title']){
        $WHERE.= " AND title LIKE '%".$_SESSION['filter']['title']."%'";
    }
    if ($_SESSION['filter']['isbn']){
        $WHERE.= " AND sku LIKE '%".$_SESSION['filter']['isbn']."%'";
    }
    if  ($_SESSION['filter']['authors']) {
        $WHERE.= " AND author='".$_SESSION['filter']['authors']."'";
    }
    if  ($_SESSION['filter']['publishes']) {
        $WHERE.= " AND publish='".$_SESSION['filter']['publishes']."'";
    }
    if  ($_SESSION['filter']['year-min']) {
        $WHERE .= " AND publishYear>='".$_SESSION['filter']['year-min']."'";
    }
    if  ($_SESSION['filter']['year-max']) {
        $WHERE .= " AND publishYear<='".$_SESSION['filter']['year-max']."'";
    }
    $query = "SELECT COUNT(product_id) as count_rows FROM products WHERE" . $WHERE;
    $res = mysql_query($query) or die(mysql_error());
    while($row = mysql_fetch_assoc($res)){
        if($row['count_rows']) $count_rows = $row['count_rows'];
    }
    return $count_rows;
}
/* ===Получение кол-ва товаров для навигации=== */

/* ===Получение массива товаров по категории=== */
function getBooks($categories, $sortby='', $start_pos, $perpage){
    if (!$sortby){
        $SORTBY = " ORDER BY title ASC";
    } else{
        switch($sortby){
            case('titleA'):
                $SORTBY = " ORDER BY title ASC";
            break;
            case('titleZ'):
                $SORTBY = " ORDER BY title DESC";
            break;
            case('authorA'):
                $SORTBY = " ORDER BY author ASC";
            break;
            case('authorZ'):
                $SORTBY = " ORDER BY author DESC";
            break;
            case('publishA'):
                $SORTBY = " ORDER BY publish ASC";
            break;
            case('publishZ'):
                $SORTBY = " ORDER BY publish DESC";
            break;
            case('publishYearA'):
                $SORTBY = " ORDER BY publishYear DESC";
            break;
            case('publishYearZ'):
                $SORTBY = " ORDER BY publishYear ASC";
            break;
        }
    }
    $LIMIT = " LIMIT $start_pos, $perpage";
    $WHERE = " category_id IN ($categories) AND active=1";
    if ($_SESSION['filter']['title']){
        $WHERE.= " AND title LIKE '%".$_SESSION['filter']['title']."%'";
    }
    if ($_SESSION['filter']['isbn']){
        $WHERE.= " AND sku LIKE '%".$_SESSION['filter']['isbn']."%'";
    }
    if  ($_SESSION['filter']['authors']) {
        $WHERE.= " AND author='".$_SESSION['filter']['authors']."'";
    }
    if  ($_SESSION['filter']['publishes']) {
        $WHERE.= " AND publish='".$_SESSION['filter']['publishes']."'";
    }
    if  ($_SESSION['filter']['year-min']) {
        $WHERE .= " AND publishYear>='".$_SESSION['filter']['year-min']."'";
    }
    if  ($_SESSION['filter']['year-max']) {
        $WHERE .= " AND publishYear<='".$_SESSION['filter']['year-max']."'";
    }
/*
    //Позволяет выдавать в каталог только книги для текущего магазина    
    if( $_SESSION['auth']['shop_id'] && $_SESSION['auth']['shop_id'] != '' ){
        $productByShop = getProductByShop( $_SESSION['auth']['shop_id'] );
        $WHERE .= " AND product_id IN (".$productByShop.")";
    }
*/   
    //$_SESSION['auth']['shop_xml_id']
    
    //$GROUPBY = ' GROUP BY product_id';
    $query = "SELECT * FROM products WHERE ".$WHERE.$SORTBY.$LIMIT;
    $res = mysql_query($query) or die(mysql_error());
    $books = array();
    $i=0;
    while($row = mysql_fetch_assoc($res)){
        $books[] = $row;
        $i++;
    }
    return $books;
}


function getProductByShop($id){
    if(!$id || $id == ''){ return false; }
    $query = "SELECT product_id FROM offers WHERE shop_id = ".$id;
    $res = mysql_query($query) or die(mysql_error());
    $result = array();
    while($row = mysql_fetch_assoc($res)){
        $result[] = $row['product_id'];
    }
    
    $result = implode(',',$result);
    return $result;
}

/* ===Получение массива товаров по категории=== */
function getCompareData($compare_books) {
    if($compare_books) {
        foreach($compare_books as $item)
        {
            if($books){
                $books .= ','.$item;
            }
            else{
                $books = $item;
            }
        }
        $query = "SELECT * FROM products WHERE product_id IN (".$books.")";
        $res = mysql_query($query) or die(mysql_error());
        $compare_list = array();
        $i=0;
        while($row = mysql_fetch_assoc($res)){
            $compare_list[$i]['product_id'] = $row['product_id'];
            $compare_list[$i]['title'] = $row['title'];
            $compare_list[$i]['img'] = $row['img'];
            $compare_list[$i]['author'] = $row['author'];
            $compare_list[$i]['publish'] = $row['publish'];
            $compare_list[$i]['publishYear'] = $row['publishYear'];
            $compare_list[$i]['sku'] = $row['sku'];
            $cat_name = mysql_fetch_assoc(mysql_query("SELECT name FROM categories WHERE category_id=".$row['category_id'] . " LIMIT 1 "));
            $maxMinPrice = mysql_fetch_assoc(mysql_query("SELECT MAX(price) as maxprice, MIN(price) as minprice FROM offers WHERE product_id=".$row['product_id'] . " LIMIT 1"));
            if($maxMinPrice['maxprice'] == $maxMinPrice['minprice']) {
                $price = $maxMinPrice['minprice'];
            }
            else {
                $price = $maxMinPrice['minprice'] . ' - ' . $maxMinPrice['maxprice'];
            }
            $stock = mysql_fetch_assoc(mysql_query("SELECT COUNT(quantity) as cq FROM offers WHERE product_id=".$row['product_id'] ));
            $compare_list[$i]['category'] = $cat_name['name'];
            $compare_list[$i]['price'] = $price;
            $compare_list[$i]['stock'] = $stock['cq'];
            $i++;
        }
    }
    else {
        $compare_list = '';
    }
    return $compare_list;
}
function getBook($book_id)
{
    $query = "SELECT * FROM products WHERE product_id='".$book_id."' LIMIT 1";
    $res = mysql_query($query);
    $book = mysql_fetch_assoc($res);
    return $book;
}
function getBookOffer($book_id)
{
    $query = "SELECT offers.price as price, offers.quantity as quantity, shops.shop_id as shop_id, shops.name as name, shops.adress as adress, shops.coordinates as coordinates, shops.re_name as re_name, shops.re_adress as re_adress, shops.re_coordinates as re_coordinates, shops.ip_address as ip FROM offers LEFT JOIN shops ON offers.shop_id=shops.shop_id WHERE product_id ='".$book_id."' AND offers.quantity>0 ORDER BY shops.shop_id";
    $res = mysql_query($query);
    $book_offer = array();
    $i=0;
    $del_char = array('г. ', 'м-н', '"');
    while($row = mysql_fetch_assoc($res)){
	$address = "";
        $shop_adress = $row['adress'];
        $shop_name = trim(str_replace($del_char, '', $row['name']));
        $shop_coordinates = $row['coordinates'];
        if($row['re_adress']) {$shop_adress=$row['re_adress'];}
        if($row['re_name']) {$shop_name = $row['re_name'];}
        if($row['re_coordinates']) {$shop_coordinates = $row['re_coordinates'];}
        $shop_id = $row['shop_id'];
	$sql_addr = mysql_query("SELECT address FROM addresses WHERE shop_id = '$shop_id' AND prod_id = '$book_id'");
        while($res_addr = mysql_fetch_assoc($sql_addr)) {
		$addres = $res_addr['address'];
	        $address .= "$addres ";
	}
        $ap = explode('телефон', $shop_adress);
        $adress = explode(",", $ap[0]);
        $city = trim(str_replace($del_char, '', $adress[0]));
        if ((isShop() && $row['ip'] != isShop()['ip_address']) || !isShop())
        {
            $book_offer[$city][$i]['name'] = $shop_name;
            $book_offer[$city][$i]['adress'] = trim($adress[1]) . ' ' .trim($adress[2]);
            $book_offer[$city][$i]['phone'] = trim($ap[1]);
            $book_offer[$city][$i]['coordinates'] = $shop_coordinates;
            
            $book_offer[$city][$i]['price'] = $row['price'];
            $book_offer[$city][$i]['quantity'] = $row['quantity'];
            $book_offer[$city][$i]['shop_id'] = $row['shop_id'];
	    $book_offer[$city][$i]['address'] = $address;
            $i++;
        }
        else
        {
            $book_offer['current']['name'] = $shop_name;
            $book_offer['current']['adress'] = trim($adress[1]) . ' ' .trim($adress[2]);
            $book_offer['current']['phone'] = trim($ap[1]);
            $book_offer['current']['coordinates'] = $shop_coordinates;
            
            $book_offer['current']['price'] = $row['price'];
            $book_offer['current']['quantity'] = $row['quantity'];
            $book_offer['current']['city'] = $city;
            $i++;
        }
    }
    
    return $book_offer;

}
function getAuthors() {
    $query = "SELECT DISTINCT author FROM products ORDER BY author";
    $res = mysql_query($query);
    $authors = array();
    while($row = mysql_fetch_assoc($res)){
        if($row['author']) {
            $authors[] = $row['author'];
        }
    }
    return $authors;
}
function getPublish() {
    $query = "SELECT DISTINCT publish FROM products order by publish";
    $res = mysql_query($query);
    $publishes = array();
    while($row = mysql_fetch_assoc($res)){
        if($row['publish']) {
            $publishes[] = $row['publish'];
        }
    }
    return $publishes;
}
function getMaxMinYears() {
    $query =  mysql_query("SELECT MAX(publishYear) as max, MIN(publishYear) as min FROM products WHERE publishYear<>'' AND publishYear LIKE '____'");
    $years = mysql_fetch_assoc($query);
    return $years;
}

function getShops() 
{
    $query = "SELECT * FROM shops WHERE active='1' ORDER by name ASC";
    $res = mysql_query($query);
    $shops = array();
    $i=0;
    $del_char = array('г. ', 'м-н', '"');
    while($row = mysql_fetch_assoc($res)){
        $shop_adress = $row['adress'];
        $shop_name = trim(str_replace($del_char, '', $row['name']));
        $shop_coordinates = $row['coordinates'];
        if($row['re_adress']) {$shop_adress=$row['re_adress'];}
        if($row['re_name']) {$shop_name = $row['re_name'];}
        if($row['re_coordinates']) {$shop_coordinates = $row['re_coordinates'];}
        $ap = explode('телефон', $shop_adress);
        $adress = explode(",", $ap[0]);
        $city = trim(str_replace($del_char, '', $adress[0]));
        $shops[$city][$i]['name'] = $shop_name;
        $shops[$city][$i]['adress'] = trim($adress[1]) . ' ' .trim($adress[2]);
        //$shops[$city][$i]['phone'] = trim($ap[1]);
        $shops[$city][$i]['phone'] = $row['phone'];
        $shops[$city][$i]['coordinates'] = $shop_coordinates;
        $i++;
    }
    return $shops;

}
function getShopInfo($shop_id)
{
    $query = mysql_query("SELECT adress, name FROM shops WHERE shop_id='".$shop_id."' LIMIT 1");
    $shop = mysql_fetch_assoc($query);
    return $shop;
}

/* ===Сумма заказа в корзине + атрибуты товара===*/
function total_sum($products){
    $total_sum = 0;
    
    $str_products = implode(',',array_keys($products));
    
    $query = "SELECT product_id, name, main_img, price
                FROM products
                    WHERE product_id IN ($str_products)";
    $res = mysql_query($query) or die(mysql_error());
    
    while($row = mysql_fetch_assoc($res)){
        $_SESSION['cart'][$row['product_id']]['name'] = $row['name'];
        $_SESSION['cart'][$row['product_id']]['price'] = $row['price'];
        $_SESSION['cart'][$row['product_id']]['img'] = $row['main_img'];
        $total_sum += $_SESSION['cart'][$row['product_id']]['qty'] * $row['price'];
    }
    return $total_sum;
}
/* ===Сумма заказа в корзине + атрибуты товара===*/

/* ===Регистрация=== */
function registration(){
    $error = ''; // флаг проверки пустых полей
    

    $email = clear($_POST['email']);
    if(empty($email)) $error .= '<li>Не указан Email</li>';
    
    if(empty($error)){
        // если все поля заполнены
        // проверяем нет ли такого юзера в БД
        $query = "SELECT user_id FROM users WHERE email = '$email' LIMIT 1";
        $res = mysql_query($query) or die(mysql_error());
        $row = mysql_num_rows($res); // 1 - такой юзер есть, 0 - нет
        if($row){
            // если такой логин уже есть
            $_SESSION['reg']['res'] = "Пользователь с таким e-mail уже зарегистрирован на сайте. <a href=\"?view=user&section=remind_password\">Напомнить пароль</a>.";
        }else{
            // если все ок - регистрируем
            $pass = md5($pass);
            $query = "INSERT INTO users (name, email, phone, address, login, pwd)
                        VALUES ('$name', '$email', '$phone', '$address', '$login', '$pass')";
            $res = mysql_query($query) or die(mysql_error());
            if(mysql_affected_rows() > 0){
                // если запись добавлена
                $_SESSION['reg']['res'] = "<div class='success'>Регистрация прошла успешно.</div>";
                $_SESSION['auth']['user'] = $name;
                $_SESSION['auth']['user_id'] = mysql_insert_id();
                $_SESSION['auth']['email'] = $email;
            }
        }
    }else{
        // если не заполнены обязательные поля
        $_SESSION['reg']['res'] = "<div class='error'>Не заполнены обязательные поля: <ul> $error </ul></div>";
        $_SESSION['reg']['login'] = $login;
        $_SESSION['reg']['name'] = $name;
        $_SESSION['reg']['email'] = $email;
        $_SESSION['reg']['phone'] = $phone;
        $_SESSION['reg']['addres'] = $address;
    }
}
/* ===Регистрация=== */

/* ===Авторизация=== */
function authorization(){
    $login = mysql_real_escape_string(trim($_POST['login']));
    $pass = trim($_POST['pass']);
    
    
    if(empty($login) OR empty($pass)){
        // если пусты поля логин/пароль
        $_SESSION['auth']['error'] = "Поля логин/пароль должны быть заполнены!";
        return array('error' => 'Поля логин/пароль должны быть заполнены!'); 
    }else{
        // если получены данные из полей логин/пароль
        
        $pwd_res = mysql_query("SELECT pwd FROM users WHERE login = '$login'") or die(mysql_error());
        $pwd_row = mysql_fetch_row($pwd_res);
        $pwdEncoded = $pwd_row['0'];
        $salt = substr($pwdEncoded, 0,8);
        $pwd = $salt.md5($salt.$pass); 
        $query = "SELECT user_id, name, email, role_id, shop_id FROM users WHERE login = '$login' AND pwd = '$pwd' LIMIT 1";
        $res = mysql_query($query) or die(mysql_error());
        if(mysql_num_rows($res) == 1){
            // если авторизация успешна
            $row = mysql_fetch_row($res);
            $_SESSION['auth']['user_id'] = $row[0];
            $_SESSION['auth']['user'] = $row[1];
            $_SESSION['auth']['email'] = $row[2];
            $_SESSION['auth']['role'] = $row[3];
            $_SESSION['auth']['shop_id'] = $row[4];
            return false;
        }else{
            // если неверен логин/пароль
            $_SESSION['auth']['error'] = "Логин/пароль введены неверно!";
            return array('error' => 'Логин/пароль введены неверно!'); 
        }
    }
}

/* ===Авторизация=== */

/* ===Способы доставки=== */
function getShippingMethod(){
    $query = "SELECT * FROM shipping";
    $res = mysql_query($query);
    
    $shipping = array();
    while($row = mysql_fetch_assoc($res)){
        $shipping[] = $row;
    }
    
    return $shipping;
}
/* ===Способы доставки=== */


/* ===Проверка по наличию пользователя по контакту=== */
function isUserInBase($contact)
{
    $query = mysql_query("SELECT user_id, name, email FROM users WHERE ((login = $contact) OR (email=$contact) OR (phone=$contact))  LIMIT 1");
    $user = mysql_fetch_assoc($query);
    return $user;
}
/* ===Проверка по наличию пользователя по контакту=== */

/* ===Отправка уведомлений о заказе на email=== */
function mail_order($order_id, $email){
    //mail(to, subject, body, header);
    // тема письма
    $subject = "Заказ в интернет-магазине";
    // заголовки
    $headers .= "Content-type: text/plain; charset=utf-8\r\n";
    $headers .= "From: bigavto.ru";
    // тело письма
    $mail_body = "Благодарим Вас за заказ!\r\nНомер Вашего заказа - {$order_id}
    \r\n\r\nЗаказанные товары:\r\n";
    // атрибуты товара
    foreach($_SESSION['cart'] as $goods_id => $value){
        $mail_body .= "Наименование: {$value['name']}, Цена: {$value['price']}, Количество: {$value['qty']} шт.\r\n";
    }
    $mail_body .= "\r\nИтого: {$_SESSION['total_quantity']} на сумму: {$_SESSION['total_sum']}";
    
    // отправка писем
    mail($email, $subject, $mail_body, $headers);
    mail(ADMIN_EMAIL, $subject, $mail_body, $headers);
}
/* ===Отправка уведомлений о заказе на email=== */

function search_count($search_word){
    $query = "SELECT products.product_id, MATCH (products.search_content) AGAINST ('$search_word') as score FROM products WHERE MATCH (products.search_content) AGAINST ('$search_word') GROUP BY product_id AND active='1'";
    $res = mysql_query($query) or die(mysql_error());
    $rows_num = mysql_num_rows($res);
    return $rows_num;
}

/*
старый dариант поиска. в новом убрал группировку.
function search_count($search_word){
    $query = "SELECT products.product_id, MATCH (products.search_content) AGAINST ('$search_word') as score FROM products WHERE MATCH (products.search_content) AGAINST ('$search_word') GROUP BY product_id AND active='1';
    $res = mysql_query($query) or die(mysql_error());
    $rows_num = mysql_num_rows($res);
    return $rows_num;
}
*/



function search($search_word, $sortby='', $start_pos, $perpage, $count = false){
    if (!$sortby){
        $SORTBY = "";
    }
    else{
        switch($sortby){
            case('titleA'):
                $SORTBY = " ORDER BY title ASC";
            break;
            case('titleZ'):
                $SORTBY = " ORDER BY title DESC";
            break;
            case('authorA'):
                $SORTBY = " ORDER BY author ASC";
            break;
            case('authorZ'):
                $SORTBY = " ORDER BY author DESC";
            break;
            case('publishA'):
                $SORTBY = " ORDER BY publish ASC";
            break;
            case('publishZ'):
                $SORTBY = " ORDER BY publish DESC";
            break;
            case('publishYearA'):
                $SORTBY = " ORDER BY publishYear DESC";
            break;
            case('publishYearZ'):
                $SORTBY = " ORDER BY publishYear ASC";
            break;
            case('score'):
                $SORTBY = "";
            break;
        }
    }
    if ($start_pos !== false) $LIMIT = " LIMIT $start_pos, $perpage";
    else $LIMIT = '';
    $WHERE = " WHERE MATCH (products.search_content) AGAINST ('$search_word') AND active=1" ;
    $GROUPBY = " GROUP BY product_id";
    
/*    $query = "SELECT products.*, MATCH (products.search_content) AGAINST ('$search_word') as score FROM products ".$WHERE.$GROUPBY.$SORTBY.$LIMIT;
*/
$query = "SELECT products.*, MATCH (products.search_content) AGAINST ('$search_word') as score FROM products ".$WHERE.$SORTBY.$LIMIT;

    $res = mysql_query($query) or die(mysql_error());
    if ($count) return mysql_num_rows($res);
    $books = array();
    $i=0;
    while($row = mysql_fetch_assoc($res)){
        $books[] = $row;
        $i++;
    }
    return $books;
}
function logSearch($search_word,$ip){
    $etime = date("Y-m-d H:i:s");
    $res=mysql_query("INSERT INTO search_log (search_query, etime, ip) VALUES('$search_word', '$etime', '$ip')");
}

function getFavorites()
{
    if (!isset($_SESSION['favorites']) || empty($_SESSION['favorites'])) return false;
    $res = mysql_query("SELECT * FROM products WHERE product_id IN (".implode(', ', $_SESSION['favorites']).")");
    print '<!--'."SELECT * FROM products WHERE product_id IN (".implode(', ', $_SESSION['favorites']).")".'-->';
    while ($item = mysql_fetch_assoc($res)) $books[] = $item;
    return $books;
}

function removeFavorite($id)
{
    $key = array_search($id, $_SESSION['favorites']);
    unset($_SESSION['favorites'][$key]);
}

function getEquipment()
{
    $limit = $_SESSION['onpage'] ? $_SESSION['onpage'] : 15;
    $sort = 'id';
    if (isset($_SESSION['sortbye'])) {
        switch ($_SESSION['sortbye']) {
            case 'idDesc': 
            case 'idAsc': 
                $sort = 'id';
                break;
            case 'titleDesc': 
            case 'titleAsc': 
                $sort = 'name';
                break;
        }
    }
    $order= 'DESC';
    if (isset($_SESSION['sortbye'])) {
        switch ($_SESSION['sortbye']) {
            case 'idDesc': 
            case 'titleDesc': 
                $order = 'DESC';
                break;
            case 'idAsc': 
            case 'titleAsc': 
                $order = 'ASC';
                break;
        }
    }
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $res = mysql_query("SELECT * FROM equipment");
    $equipment['count'] = ceil(mysql_num_rows($res) / $limit);
    $res = mysql_query("SELECT * FROM equipment ORDER BY $sort $order LIMIT ".(($page - 1) * $limit).", $limit");
    while ($item = mysql_fetch_assoc($res)) $equipment['items'][] = $item;

    return $equipment;
}

function getEquipmentById($id)
{
    $res = mysql_query("SELECT * FROM equipment WHERE id=$id");

    return mysql_fetch_assoc($res);
}

function getBanners()
{
    $res = mysql_query("SELECT * FROM banners");
    while ($item = mysql_fetch_assoc($res)) $banners[] = $item;

    return $banners;
}
