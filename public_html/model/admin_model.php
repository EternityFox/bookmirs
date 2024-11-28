<?php
defined('IS_I_SITE') or die('Access to model denied');
function getProducts($limit = '', $order = '')
{
    $products = array();
    if ($limit) {
        $limit = ' LIMIT ' . $limit;
    }
    if ($order) {
        $order = ' ORDER BY ' . $order . ' DESC';
    } else {
        $order = ' ORDER BY title ASC';
    }
    $WHERE = " WHERE active='1'";
    $GROUPBY = '';
    $query = "SELECT products.* FROM products  " . $WHERE . $GROUPBY . $order . $limit;
    $res = mysql_query($query) or die(mysql_error());
    while ($row = mysql_fetch_assoc($res)) {
        $products[] = $row;
    }
    return $products;
}

function getNews($limit = '', $order = '')
{
    if ($limit) {
        $limit = ' LIMIT ' . $limit;
    }
    if ($order) {
        $order = ' ORDER BY ' . $order . ' DESC';
    } else {
        $order = ' ORDER BY event_date DESC';
    }
    $query = 'SELECT news_id, title, short_desc, event_date, hits, img FROM news' . $order . $limit;
    $res = mysql_query($query) or die(mysql_query());
    $news = array();
    $i = 0;
    while ($row = mysql_fetch_assoc($res)) {
        $news[$i]['news_id'] = $row['news_id'];
        $news[$i]['title'] = $row['title'];
        $news[$i]['short_desc'] = $row['short_desc'];
        $news[$i]['event_date'] = $row['event_date'];
        $news[$i]['hits'] = $row['hits'];
        $news[$i]['img'] = $row['img'];
        $i++;
    }
    return $news;
}

function addNews()
{
    $error = '';
    $title = clear($_POST['title']);
    $event_date = $_POST['event_date'];
    $desc = $_POST['desc'];
    $active = $_POST['active'];
    $short_desc = clear($_POST['short_desc']);
    $img = $_POST['uploaded-image'];
    $query = "INSERT INTO news (title, event_date, full_desc, short_desc, img, active)
			VALUES ('$title', '$event_date', '$desc', '$short_desc', '$img', '$active')";
    $res = mysql_query($query) or die(mysql_error());
}

function editNews()
{
    $error = '';
    $title = clear($_POST['title']);
    $event_date = $_POST['event_date'];
    $active = $_POST['active'];
    $full_desc = $_POST['full_desc'];
    $short_desc = clear($_POST['short_desc']);
    $img = $_POST['uploaded-image'];
    $news_id = abs((int)$_GET['news_id']);

    if ($news_id) {
        $query = "UPDATE news SET title='$title', event_date='$event_date', full_desc='$full_desc', short_desc='$short_desc', img='$img',active='$active' WHERE news_id='$news_id'";
        $res = mysql_query($query) or die(mysql_error());
    }
}

function getNewsDetail($news_id)
{
    $query = "SELECT * FROM news WHERE news_id='" . $news_id . "' LIMIT 1";
    $res = mysql_query($query);
    $newsDetail = mysql_fetch_assoc($res);
    return $newsDetail;
}

function deleteNews()
{
    $news_id = abs((int)$_POST['news_id']);
    $query = "DELETE FROM news WHERE news_id='" . $news_id . "'";
    $res = mysql_query($query) or die(mysql_error());
}


function getVacancies($limit = '', $orderBy = 'vacancies.add_date')
{

    if ($limit) {
        $limit = " LIMIT " . $limit;
    }
    $query = 'SELECT vacancies.vacancy_id as vid,  vacancies.img as img, vacancies.title as title, vacancies.city as city, vacancies.add_date as add_date, vacancies.phone as phone, vacancies.email as email, vacancies.hits as hits, users.name as user FROM vacancies LEFT JOIN users ON vacancies.user_id=users.user_id ORDER by ' . $orderBy . ' DESC' . $limit;
    $res = mysql_query($query) or die(mysql_query());
    $vacancies = array();
    while ($row = mysql_fetch_assoc($res)) {
        $vacancies[] = $row;
    }
    return $vacancies;
}

function addVacancy()
{
    $error = '';
    $title = clear($_POST['title']);
    $add_date = $_POST['add_date'];
    $city = $_POST['city'];
    $sex = $_POST['sex'];
    $education = $_POST['education'];
    $expirience = $_POST['expirience'];
    $work = $_POST['work'];
    $wage = $_POST['wage'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $requirements = $_POST['requirements'];
    $responsibilities = $_POST['responsibilities'];
    $terms = $_POST['terms'];
    $img = $_POST['uploaded-image'];

    $query = "INSERT INTO vacancies (title, add_date, city, sex, education, expirience, work, wage, requirements, responsibilities, terms, img, phone, email)
			VALUES ('$title', '$add_date', '$city', '$sex', '$education', '$expirience', '$work', '$wage', '$requirements', '$responsibilities', '$terms', '$img', '$phone', '$email')";
    $res = mysql_query($query) or die(mysql_error());
}

function deleteVacancy()
{
    $vacancy_id = abs((int)$_POST['vacancy_id']);
    $query = "DELETE FROM vacancies WHERE vacancy_id='" . $vacancy_id . "'";
    $res = mysql_query($query) or die(mysql_error());
}

function getVacancyDetail($vid)
{
    $query = "SELECT * FROM vacancies WHERE vacancy_id='" . $vid . "' LIMIT 1";
    $res = mysql_query($query);
    $vacancyDetail = mysql_fetch_assoc($res);
    return $vacancyDetail;
}

function getCoupons($limit = 10, $offset = 0, $orderBy = 'updated_at', $search = '')
{
    $where = 'WHERE phone IS NOT NULL';
    if ($search !== '') {
        $search = mysql_real_escape_string($search);
        $where .= " AND (code LIKE '%$search%'";
        $where .= " OR name LIKE '%$search%'";
        $where .= " OR phone LIKE '%$search%'";
        $where .= " OR email LIKE '%$search%')";
    }

    $query = 'SELECT id as vid, code, name, email, phone, updated_at 
              FROM coupons 
              ' . $where . ' 
              ORDER BY ' . $orderBy . ' DESC 
              LIMIT ' . intval($limit) . ' OFFSET ' . intval($offset);
    $res = mysql_query($query) or die(mysql_error());
    $coupons = array();
    while ($row = mysql_fetch_assoc($res)) {
        $coupons[] = $row;
    }
    return $coupons;
}

function getCouponsPagingateCount($search = '')
{
    $where = 'WHERE phone IS NOT NULL';
    if ($search !== '') {
        $search = mysql_real_escape_string($search);
        $where .= " AND (code LIKE '%$search%'";
        $where .= " OR name LIKE '%$search%'";
        $where .= " OR phone LIKE '%$search%'";
        $where .= " OR email LIKE '%$search%')";
    }

    $query = 'SELECT COUNT(*) as count FROM coupons ' . $where;
    $res = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_assoc($res);
    return $row['count'];
}

function getCouponsCount()
{
    $where = 'WHERE phone IS NOT NULL';
    $query = 'SELECT COUNT(*) as count FROM coupons ' . $where;
    $res = mysql_query($query) or die(mysql_error());
    $row = mysql_fetch_assoc($res);
    return $row['count'];
}

function addCoupon()
{
    $error = '';
    $code = $_POST['code'];
    $now = time();
    $createt_add = date('Y-m-d H:i:s', $now);
    $query = "INSERT INTO coupons (code,  created_at)
			VALUES ('$code', '$createt_add')";
    $res = mysql_query($query) or die(mysql_error());
}

function getQuestions($limit = '', $orderBy = 'created_at')
{
    if ($limit) {
        $limit = " LIMIT " . $limit;
    }
    $query = 'SELECT id as vid, name, email, question, answer, created_at, active FROM questions ORDER by ' . $orderBy . ' DESC' . $limit;
    $res = mysql_query($query) or die(mysql_query());
    $questions = array();
    while ($row = mysql_fetch_assoc($res)) {
        $questions[] = $row;
    }
    return $questions;
}

function addQuestion()
{
    $error = '';
    $name = isset($_POST['name']) && $_POST['name'] ? $_POST['name'] : "Администратор";
    $email = isset($_POST['email']) && $_POST['email'] ? $_POST['email'] : "no-reply@bookmirs.ru";
    $question = $_POST['question'];
    $answer = $_POST['answer'];
    $now = time();
    $createt_add = date('Y-m-d H:i:s', $now);
    $updated_at = date('Y-m-d H:i:s', $now);
    $active = $_POST['active'];
    $query = "INSERT INTO questions (name, email, question, answer, created_at, updated_at, active)
			VALUES ('$name', '$email', '$question', '$answer', '$createt_add', '$updated_at', '$active')";
    $res = mysql_query($query) or die(mysql_error());
}

function editQuestion()
{
    $error = '';
    $name = isset($_POST['name']) && $_POST['name'] ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') : "Администратор";
    $email = isset($_POST['email']) && $_POST['email'] ? filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) : "no-reply@bookmirs.ru";
    $question = isset($_POST['question']) ? htmlspecialchars($_POST['question'], ENT_QUOTES, 'UTF-8') : '';
    $answer = isset($_POST['answer']) ? htmlspecialchars($_POST['answer'], ENT_QUOTES, 'UTF-8') : '';
    $send_mail = isset($_POST['send_mail']) ? $_POST['send_mail'] : '';
    $active = isset($_POST['active']) ? (int)$_POST['active'] : 0;
    $question_id = isset($_GET['question_id']) ? (int)$_GET['question_id'] : 0;
    if ($question_id) {
        $now = time();
        $updated_at = date('Y-m-d H:i:s', $now);
        $query = "UPDATE questions SET name='$name', email='$email', question='$question', answer='$answer', updated_at='$updated_at', active='$active' WHERE id='$question_id'";
        $res = mysql_query($query) or die(mysql_error());
        if ($res && $send_mail && $email) {
            $message = "Здравствуйте, " . $name . "! <br><br><br>" . "Спасибо за ваш вопрос на нашем сайте. Мы рады, что вы обратились к нам и готовы помочь вам с вашим вопросом: " . $question . ".<br><br><br>Наш ответ: " . $answer;
            sendMail($email, $message);
        }
    }
}

function sendMail($email, $message)
{
    $host = 'smtp.bookmirs.ru';
    $port = 587;
    $username = 'tochka24';
    $password = 'QWERTY';
    $from = 'kds@bookmirs.ru';

    $socket = fsockopen($host, $port, $errno, $errstr, 30);
    if (!$socket) {
        die("Не удалось подключиться: $errstr ($errno)");
    }

    function sendCommand($socket, $command)
    {
        fputs($socket, $command . "\r\n");
        return fgets($socket, 512);
    }

    echo sendCommand($socket, "HELO localhost");
    echo sendCommand($socket, "AUTH LOGIN");
    echo sendCommand($socket, base64_encode($username));
    echo sendCommand($socket, base64_encode($password));
    echo sendCommand($socket, "MAIL FROM: <$from>");
    echo sendCommand($socket, "RCPT TO: <$email>");
    echo sendCommand($socket, "DATA");

    $headers = "From: $from\r\n";
    $headers .= "To: $email\r\n";
    $headers .= "Subject: Ответ на ваш вопрос на сайте bookmirs.ru\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";

    $fullMessage = $headers . "\r\n" . $message . "\r\n.";
    echo sendCommand($socket, $fullMessage);
    echo sendCommand($socket, "QUIT");

    fclose($socket);
}

function getPromoModals($limit = '', $orderBy = 'created_at')
{
    if ($limit) {
        $limit = " LIMIT " . $limit;
    }
    $query = 'SELECT id as vid, name, title, description, filename, content, url_href, url_redirect, pop_up_type, data_start, data_end, action FROM promotions ORDER by ' . $orderBy . ' DESC' . $limit;
    $res = mysql_query($query) or die(mysql_query());
    $promotion_modals = array();
    while ($row = mysql_fetch_assoc($res)) {
        $promotion_modals[] = $row;
    }
    return $promotion_modals;
}

function editPromoModal()
{
    $error = '';
    $name = $_POST['name'];
    $data_start = $_POST['data_start'];
    $data_end = $_POST['data_end'];
    $pop_up_type = $_POST['animations'];
    $action = isset($_POST['action']) && $_POST['action'] ? $_POST['action'] : 0;
    $file_name = isset($_POST['uploaded-image']) && $_POST['uploaded-image'] ? $_POST['uploaded-image'] : NULL;
    $title = isset($_POST['title']) && $_POST['title'] ? $_POST['title'] : NULL;
    $url_href = isset($_POST['url_href']) && $_POST['url_href'] ? $_POST['url_href'] : NULL;
    $url_redirect = isset($_POST['url_redirect']) && $_POST['url_redirect'] ? $_POST['url_redirect'] : NULL;
    $description = isset($_POST['description']) && $_POST['description'] ? $_POST['description'] : NULL;
    $content = isset($_POST['content']) && $_POST['content'] ? $_POST['content'] : NULL;
    $promo_modal_id = isset($_GET['promo_modal_id']) ? (int)$_GET['promo_modal_id'] : 0;
    if ($promo_modal_id) {
        $now = time();
        $query = "SELECT * FROM promotions WHERE id='" . $promo_modal_id . "' LIMIT 1";
        $res = mysql_query($query);
        $promo_modal = mysql_fetch_assoc($res);
        if (isset($promo_modal) && $promo_modal && isset($promo_modal['filename']) && $promo_modal['filename'] && $promo_modal['filename'] != $file_name) {
            $path = __DIR__ . "..\..\media\images/";
            foreach ([100, 260, 300] as $index) {
                if (file_exists($path . $index . '_' . $promo_modal['filename']))
                    unlink($path . $index . '_' . $promo_modal['filename']);
            }
            if (file_exists($path . $promo_modal['filename']))
                unlink($path . $promo_modal['filename']);
        }
        $updated_at = date('Y-m-d H:i:s', $now);
        $query = "UPDATE promotions SET name='$name', title='$title', description='$description',filename='$file_name',content='$content',url_href='$url_href',url_redirect='$url_redirect',pop_up_type='$pop_up_type',data_start='$data_start',data_end='$data_end',action='$action',updated_at='$updated_at' WHERE id='$promo_modal_id'";
        $res = mysql_query($query) or die(mysql_error());
    }
}

function addPromoModal()
{
    $error = '';
    $name = $_POST['name'];
    $data_start = $_POST['data_start'];
    $data_end = $_POST['data_end'];
    $pop_up_type = $_POST['animations'];
    $action = isset($_POST['action']) && $_POST['action'] ? $_POST['action'] : 0;
    $file_name = isset($_POST['uploaded-image']) && $_POST['uploaded-image'] ? $_POST['uploaded-image'] : NULL;
    $title = isset($_POST['title']) && $_POST['title'] ? $_POST['title'] : NULL;
    $url_href = isset($_POST['url_href']) && $_POST['url_href'] ? $_POST['url_href'] : NULL;
    $url_redirect = isset($_POST['url_redirect']) && $_POST['url_redirect'] ? $_POST['url_redirect'] : NULL;
    $description = isset($_POST['description']) && $_POST['description'] ? $_POST['description'] : NULL;
    $content = isset($_POST['content']) && $_POST['content'] ? $_POST['content'] : NULL;
    $now = time();
    $createt_add = date('Y-m-d H:i:s', $now);
    $updated_at = date('Y-m-d H:i:s', $now);
    $query = "INSERT INTO promotions (name, title, description, filename, content, url_href, url_redirect, pop_up_type, data_start, data_end, action, created_at, updated_at)
			VALUES ('$name', '$title', '$description', '$file_name', '$content', '$url_href', '$url_redirect', '$pop_up_type', '$data_start', '$data_end', '$action', '$createt_add', '$updated_at')";
    $res = mysql_query($query) or die(mysql_error());
}

function deletePromoModal()
{
    $promo_modal_id = abs((int)$_POST['id']);
    $query = "DELETE FROM promotions WHERE id='" . $promo_modal_id . "'";
    $res = mysql_query($query) or die(mysql_error());
}

function getPromoModalDetail($vid)
{
    $query = "SELECT * FROM promotions WHERE id='" . $vid . "' LIMIT 1";
    $res = mysql_query($query);
    $promo_modal = mysql_fetch_assoc($res);
    return $promo_modal;
}

function deleteQuestion()
{
    $question_id = abs((int)$_POST['id']);
    $query = "DELETE FROM questions WHERE id='" . $question_id . "'";
    $res = mysql_query($query) or die(mysql_error());
}

function getQuestionDetail($vid)
{
    $query = "SELECT * FROM questions WHERE id='" . $vid . "' LIMIT 1";
    $res = mysql_query($query);
    $questionDetail = mysql_fetch_assoc($res);
    return $questionDetail;
}

function getShopDetail($shop_id)
{
    $query = "SELECT * FROM shops WHERE shop_id='" . $shop_id . "' LIMIT 1";
    $res = mysql_query($query);
    $shopDetail = mysql_fetch_assoc($res);
    return $shopDetail;
}

function editVacancy()
{
    $error = '';
    $title = clear($_POST['title']);
    $add_date = $_POST['add_date'];
    $city = $_POST['city'];
    $sex = $_POST['sex'];
    $education = $_POST['education'];
    $expirience = $_POST['expirience'];
    $work = $_POST['work'];
    $wage = $_POST['wage'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $requirements = $_POST['requirements'];
    $responsibilities = $_POST['responsibilities'];
    $terms = $_POST['terms'];
    $img = $_POST['uploaded-image'];
    $vacancy_id = abs((int)$_GET['vacancy_id']);
    if ($vacancy_id) {
        $query = "UPDATE vacancies SET title='$title', add_date='$add_date', city='$city', sex='$sex', education='$education', expirience='$expirience', work='$work', wage='$wage', requirements='$requirements', responsibilities='$responsibilities', terms='$terms', img='$img', phone='$phone', email='$email' WHERE vacancy_id='$vacancy_id'";
        $res = mysql_query($query) or die(mysql_error());
    }
}

function addShop()
{
    $error = '';
    //$log = date('Y-m-d H:i:s') . ' Запись в лог';
    //file_put_contents(__DIR__ . '/log.txt', $log . PHP_EOL, FILE_APPEND);
    echo $_SESSION['error'];
    if ($_POST['active']) {
        $active = 1;
    } else {
        $active = 0;
    }
    $xml_id = 'auto';
    $name = $_POST['name'];
    $adress = $_POST['adress'];
    $coordinates = $_POST['coordinates'];
    $phone = $_POST['phone'];
    $ip = $_POST['ip_address'];
    $query = "INSERT INTO shops (xml_id, name, adress, re_name, re_adress, coordinates, active, re_coordinates, ip_address, phone)
			VALUES ('$xml_id', '$name', '$adress', '$name', '$adress', '$coordinates', '$active', '$coordinates', '$ip', '$phone')";
    //file_put_contents($file, json_encode($query, JSON_UNESCAPED_UNICODE), LOCK_EX);
    $res = mysql_query($query) or die(mysql_error());
}

function editShop()
{
    $error = '';
    if ($_POST['active']) {
        $active = 1;
    } else {
        $active = 0;
    }
    $re_name = clear($_POST['re_name']);
    $re_adress = clear($_POST['re_adress']);
    $re_coordinates = clear($_POST['re_coordinates']);
    $coordinates = clear($_POST['coordinates']);
    $ip = clear($_POST['ip_address']);
    $shop_id = abs((int)$_GET['shop_id']);
    $phone = clear($_POST['phone']);
    if ($shop_id) {
        $query = "UPDATE shops SET re_name='$re_name', re_adress='$re_adress', re_coordinates='$re_coordinates', coordinates='$coordinates', active = '$active', ip_address='$ip', phone = '$phone' WHERE shop_id='$shop_id'";
        $res = mysql_query($query) or die(mysql_error());
    }
}

function getShops()
{
    $query = "SELECT * FROM shops";
    $res = mysql_query($query);
    $shops = array();
    $i = 0;
    $del_char = array('г. ', 'м-н', '"');
    while ($row = mysql_fetch_assoc($res)) {
        $ap = explode('телефон', $row['adress']);
        $adress = explode(",", $ap[0]);
        $city = trim(str_replace($del_char, '', $adress[0]));
        $shops[$city][$i]['name'] = trim(str_replace($del_char, '', $row['name']));
        $shops[$city][$i]['adress'] = trim($adress[1]) . ' ' . trim($adress[2]);
        $shops[$city][$i]['phone'] = trim($ap[1]);
        if ($row['re_name']) {
            $shops[$city][$i]['re_name'] = $row['re_name'];
        }
        if ($row['re_adress']) {
            $ep = explode('телефон', $row['re_adress']);
            $re_adress = explode(",", $ep[0]);
            $re_city = trim(str_replace($del_char, '', $re_adress[0]));
            $shops[$city][$i]['re_adress'] = trim($re_adress[1]) . ' ' . trim($re_adress[2]);
            $shops[$city][$i]['re_phone'] = trim($ep[1]);
        }

        $shops[$city][$i]['xml_id'] = $row['xml_id'];
        $shops[$city][$i]['shop_id'] = $row['shop_id'];
        $shops[$city][$i]['coordinates'] = $row['coordinates'];
        $shops[$city][$i]['re_coordinates'] = $row['re_coordinates'];
        $shops[$city][$i]['active'] = $row['active'];
        $shops[$city][$i]['ip_address'] = $row['ip_address'];
        $i++;
    }
    return $shops;


}


function checkRole()
{
    if ($_SESSION['auth']['role'] == 1) {
        header("Location: /");
    }
}

function authorization()
{
    $login = mysql_real_escape_string(trim($_POST['login']));
    $pass = trim($_POST['pass']);

    if (empty($login) or empty($pass)) {
        // если пусты поля логин/пароль
        $_SESSION['auth']['error'] = "Поля логин/пароль должны быть заполнены!";
    } else {
        // если получены данные из полей логин/пароль

        $pwd_res = mysql_query("SELECT pwd FROM users WHERE login = '$login'") or die(mysql_error());
        $pwd_row = mysql_fetch_row($pwd_res);
        $pwdEncoded = $pwd_row['0'];
        $salt = substr($pwdEncoded, 0, 8);
        $pwd = $salt . md5($salt . $pass);
        $query = "SELECT user_id, name, email, role_id FROM users WHERE login = '$login' AND pwd = '$pwd' LIMIT 1";
        $res = mysql_query($query) or die(mysql_error());
        if (mysql_num_rows($res) == 1) {
            $row = mysql_fetch_row($res);
            if ($row[3] > 1) {
                $_SESSION['auth']['user_id'] = $row[0];
                $_SESSION['auth']['user'] = $row[1];
                $_SESSION['auth']['email'] = $row[2];
                $_SESSION['auth']['role'] = $row[3];
            } else {
                $_SESSION['auth']['error'] = "Извините, но у Вас недостаточно прав для данного раздела";
            }

        } else {
            // если неверен логин/пароль
            $_SESSION['auth']['error'] = "Логин/пароль введены неверно!";
        }
    }
}

function countShops()
{
    $query = "SELECT * FROM shops";
    $res = mysql_query($query);
    $i = 0;
    $del_char = array('г. ', 'м-н', '"');
    while ($row = mysql_fetch_assoc($res)) {
        if ((!strpos($row['name'], 'БУМАГА')) && (!strpos($row['name'], 'Газеты')) && (!strpos($row['name'], 'Журналы'))) {
            $i++;
        }
    }
    return $i;

}

function countProducts()
{
    $query = "SELECT COUNT(product_id) as cid FROM products";
    $res = mysql_query($query);
    $product = mysql_fetch_assoc($res);
    return $product['cid'];
}

function countOffers()
{
    $query = "SELECT COUNT(offer_id) as cid FROM offers";
    $res = mysql_query($query);
    $offers = mysql_fetch_assoc($res);
    return $offers['cid'];
}

function countVacancies()
{
    $query = "SELECT COUNT(vacancy_id) as cid FROM vacancies";
    $res = mysql_query($query);
    $vacancies = mysql_fetch_assoc($res);
    return $vacancies['cid'];
}

function countNews()
{
    $query = "SELECT COUNT(news_id) as cid FROM news";
    $res = mysql_query($query);
    $news = mysql_fetch_assoc($res);
    return $news['cid'];
}

function countUsers()
{
    $query = "SELECT COUNT(user_id) as cid FROM users";
    $res = mysql_query($query);
    $users = mysql_fetch_assoc($res);
    return $users['cid'];
}

function checkImportActuality()
{
    $query = mysql_query("SELECT MAX(event_date) as mdate FROM import WHERE action = 'offers' and status='1' LIMIT 1");
    $last_date = mysql_fetch_assoc($query);
    $now = date("Y-m-d H:i:s");
    $d1 = new DateTime($last_date['mdate']);
    $d2 = new DateTime($now);
    $int = $d1->diff($d2);
    return $int;
}

function getImportLog()
{
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $WHERE = [];
    if ($_GET['type']) $WHERE[] = 'action="' . $_GET['type'] . '"';
    if ($_GET['from']) $WHERE[] = 'event_date>="' . $_GET['from'] . ' 00:00:00"';
    if ($_GET['to']) $WHERE[] = 'event_date<="' . $_GET['to'] . ' 23:59:59"';
    if ($WHERE) $WHERE = ' WHERE ' . implode(' AND ', $WHERE);
    else $WHERE = '';
    $sql = "SELECT cast(event_date+INTERVAL 10 HOUR as date) as event_date, cast(event_date+INTERVAL 10 HOUR as time) as event_time, description, status FROM import$WHERE ORDER BY id DESC LIMIT " . (($page - 1) * 50) . ", 50";
    $result = mysql_query($sql);
    $logs['items'] = array();
    $i = 0;
    while ($row = mysql_fetch_array($result)) {
        $logs['items'][$i]['date'] = date("d.m.Y", strtotime($row['event_date']));
        $logs['items'][$i]['time'] = $row['event_time'];
        $logs['items'][$i]['desc'] = $row['description'];
        $logs['items'][$i]['status'] = $row['status'];
        ++$i;
    }
    $res2 = mysql_query("SELECT COUNT(*) FROM import" . $WHERE);
    $count = mysql_fetch_assoc($res2);
    $logs['count'] = floor($count['COUNT(*)'] / 50);
    return $logs;
}

function countSearchEmptyProducts()
{
    $query = "SELECT COUNT(product_id) as cid FROM products WHERE search_content<>''";
    $res = mysql_query($query);
    $product = mysql_fetch_assoc($res);
    return $product['cid'];
}

function percent($all, $piece)
{
    return round(($piece * 100) / $all);
}

function getLastSearchQuery()
{
    $sql = "SELECT cast(etime+INTERVAL 10 HOUR as date) as event_date, cast(etime+INTERVAL 10 HOUR as time) as event_time, search_query, ip FROM search_log ORDER BY etime DESC LIMIT 0,50";
    $result = mysql_query($sql);
    $logs = array();
    $i = 0;
    while ($row = mysql_fetch_array($result)) {
        $logs[$i]['date'] = date("d.m.Y", strtotime($row['event_date']));
        $logs[$i]['time'] = $row['event_time'];
        $logs[$i]['search_query'] = $row['search_query'];
        $logs[$i]['ip'] = $row['ip'];
        ++$i;
    }
    return $logs;

}

function getUsers()
{
    $page = isset($_GET['page']) ? ($_GET['page'] - 1) : 0;
    $per_page = isset($_GET['limit']) ? $_GET['limit'] : 15;
    $res = mysql_query("SELECT * FROM users ORDER BY user_id DESC LIMIT " . $page * $per_page . ", " . $per_page);
    while ($item = mysql_fetch_assoc($res)) {
        $users[] = $item;
    }
    return $users;
}

function getUser($id)
{
    $res = mysql_query("SELECT * FROM users WHERE user_id=" . $id);
    return mysql_fetch_assoc($res);
}

function saveUser()
{
    $salt = bin2hex(openssl_random_pseudo_bytes(4));
    $pass = $salt . md5($salt . $_POST['pwd']);
    if (isset($_POST['id'])) {
        $res = mysql_query('SELECT * FROM users WHERE login="' . $_POST['login'] . '" AND user_id <> ' . $_POST['id']);
        if (mysql_num_rows($res) > 0) return "Пользователь с таким логином уже существует";
        mysql_query('UPDATE users SET shop_id="' . $_POST['shop_id'] . '" name="' . $_POST['name'] . '", email="' . $_POST['email'] . '", address="' . $_POST['address'] . '", login="' . $_POST['login'] . '", phone="' . $_POST['phone'] . '", role_id="' . $_POST['role_id'] . '"' . (!empty($_POST['pwd']) ? ', pwd="' . $pass . '"' : '') . ' WHERE user_id=' . $_POST['id']);
    } else {
        $res = mysql_query('SELECT * FROM users WHERE login="' . $_POST['login'] . '"');
        if (mysql_num_rows($res) > 0) return "Пользователь с таким логином уже существует";
        foreach ($_POST as $element) if (empty($element)) return "Не заполнено одно из полей";
        mysql_query('INSERT INTO users VALUES (0, "' . $_POST['name'] . '", "' . $_POST['email'] . '", "' . $_POST['address'] . '", "' . $_POST['login'] . '", "' . $pass . '", "' . $_POST['phone'] . '", "' . $_POST['role_id'] . '", "' . $_POST['shop_id'] . '", "' . date('Y-m-d H:i:s') . '")');
        header('Location: ?view=users');
    }
    return true;
}

function deleteUser($id)
{
    mysql_query("DELETE FROM users WHERE user_id=$id");
}

function getPage($id)
{
    $res = mysql_query("SELECT * FROM pages WHERE page_id=$id");
    return mysql_fetch_assoc($res);
}

function updatePage()
{
    mysql_query("UPDATE pages SET content='" . $_POST['content'] . "', title='" . $_POST['title'] . "' WHERE page_id=" . $_POST['id']);
}

function getEquipment()
{
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $res = mysql_query("SELECT * FROM equipment");
    $equipment['count'] = ceil(mysql_num_rows($res) / 50);
    $res = mysql_query("SELECT * FROM equipment LIMIT " . (($page - 1) * 50) . ", 50");
    while ($item = mysql_fetch_assoc($res)) $equipment['items'][] = $item;

    return $equipment;
}

function getEquipmentById($id)
{
    $res = mysql_query("SELECT * FROM equipment WHERE id=$id");

    return mysql_fetch_assoc($res);
}

function saveEquipment($data, $files)
{
    if (isset($data['id'])) $res = mysql_query("UPDATE equipment SET name='" . $data['name'] . "', description='" . trim($data['description']) . "', image=null WHERE id=" . $data['id']);
    else $res = mysql_query("INSERT INTO equipment VALUES(0, '" . $data['name'] . "', '" . $data['description'] . "', null)");

    if ($files['image']['name']) {
        $ext = pathinfo($files['image']['name'])['extension'];
        $id = isset($data['id']) ? $data['id'] : mysql_insert_id();
        $newFileName = $id . '.' . $ext;
        move_uploaded_file($files['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/media/equipment/' . $newFileName);
        mysql_query("UPDATE equipment SET image='$ext' WHERE id=$id");
    }

    header('Location: ?view=equipment');
}

function deleteEquipment($id)
{
    $equipment = getEquipmentById($id);
    mysql_query("DELETE FROM equipment WHERE id=$id");
    if ($equipment['image']) unlink($_SERVER['DOCUMENT_ROOT'] . '/media/equipment/' . $id . '.' . $equipment['image']);

    header('Location: ?view=equipment');
}

function getBanners()
{
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $res = mysql_query("SELECT * FROM banners");
    $banners['count'] = ceil(mysql_num_rows($res) / 50);
    $res = mysql_query("SELECT * FROM banners LIMIT " . (($page - 1) * 50) . ", 50");
    while ($item = mysql_fetch_assoc($res)) $banners['items'][] = $item;

    return $banners;
}

function getBanner($id)
{
    $res = mysql_query("SELECT * FROM banners WHERE id=$id");

    return mysql_fetch_assoc($res);
}

function saveBanner($data, $files)
{
    if (isset($data['id'])) $res = mysql_query("UPDATE banners SET title='" . $data['title'] . "', description='" . trim($data['description']) . "', url='" . $data['url'] . "', duration='" . $data['duration'] . "' WHERE id=" . $data['id']);
    else $res = mysql_query("INSERT INTO banners VALUES(0, '" . $data['title'] . "', '" . $data['description'] . "', null, '" . $data['url'] . "', '" . $data['duration'] . "')");

    if ($files['image']['name']) {
        $ext = pathinfo($files['image']['name'])['extension'];
        $id = isset($data['id']) ? $data['id'] : mysql_insert_id();
        $newFileName = $id . '.' . $ext;
        move_uploaded_file($files['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/media/banners/' . $newFileName);
        mysql_query("UPDATE banners SET image='$ext' WHERE id=$id");
    }

    header('Location: ?view=banners');
}

function deleteBanner($id)
{
    $banner = getBanner($id);
    mysql_query("DELETE FROM banners WHERE id=$id");
    if ($banner['image']) unlink($_SERVER['DOCUMENT_ROOT'] . '/media/banners/' . $id . '.' . $banner['image']);

    header('Location: ?view=banners');
}