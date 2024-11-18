<?php defined('IS_I_SITE') or die('Access denied'); ?>
<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <script src="https://api-maps.yandex.ru/2.1/?apikey=03aff5e6-f16f-40b9-a7d9-feba98b36d83&lang=ru_RU"
            type="text/javascript"></script>
    <script>var ie = false;</script>
    <!--[if lt IE 8]>
    <META HTTP-EQUIV="Refresh" content="0; URL=http://exp2.oi/ie.html"><![endif]-->
    <!--[if lt IE 9]>
		<script src="<?= TEMPLATE ?>js/ie_comp/html5shiv.min.js" type="text/javascript"></script>
		<script src="<?= TEMPLATE ?>js/ie_comp/respond.min.js" type="text/javascript"></script>
		<script>
			ie = true;
		</script>
		 <link rel="stylesheet" media="screen" href="<?= TEMPLATE ?>css/ie_comp.css">
	<![endif]-->
    <link rel="stylesheet" type="text/css" href="<?= TEMPLATE ?>css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?= TEMPLATE ?>css/owl.carousel.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?= TEMPLATE ?>css/owl.theme.default.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?= TEMPLATE ?>css/style.css?v=1.2.7"/>
    <link rel="stylesheet" media="screen" href="<?= TEMPLATE ?>css/superfish.css">
    <link rel="stylesheet" media="screen" href="<?= TEMPLATE ?>css/superfish-vertical.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css"
          integrity="sha512-WEQNv9d3+sqyHjrqUZobDhFARZDko2wpWdfcpv44lsypsSuMO0kHGd3MQ8rrsBn/Qa39VojphdU6CMkpJUmDVw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript" src="<?= TEMPLATE ?>js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?= TEMPLATE ?>js/jquery-migrate-1.4.1.min.js"></script>
    <script type="text/javascript" src="<?= TEMPLATE ?>js/jquery.total-storage.min.js"></script>
    <script src="<?= TEMPLATE ?>js/hoverIntent.js"></script>
    <script src="<?= TEMPLATE ?>js/superfish.js"></script>
    <script src="<?= TEMPLATE ?>js/jquery.cookie.js"></script>
    <script src="<?= TEMPLATE ?>/js/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="<?= TEMPLATE ?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= TEMPLATE ?>js/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"
                integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="<?= TEMPLATE ?>js/workscripts.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
                  href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.css"
                  integrity="sha512-WEQNv9d3+sqyHjrqUZobDhFARZDko2wpWdfcpv44lsypsSuMO0kHGd3MQ8rrsBn/Qa39VojphdU6CMkpJUmDVw=="
                  crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <?php if ($view == 'news'): ?>
        <script type="text/javascript" src="<?= TEMPLATE ?>js/jquery.grid-a-licious.min.js"></script>
    <?php endif; ?>
    <?php if (($view == 'book') || ($view == 'equipment_detail') || ($view == 'news_detail') || ($view == 'page')): ?>
        <script type="text/javascript" src="<?= TEMPLATE ?>js/ekko-lightbox.min.js"></script>
    <?php endif; ?>
    <!--
	<?php if ($view == 'books'): ?>
		<script type="text/javascript" src="<?= TEMPLATE ?>js/select2.min.js"></script>
		<script type="text/javascript" src="<?= TEMPLATE ?>js/select2_locale_ru.js"></script>
		<link rel="stylesheet" type="text/css" href="<?= TEMPLATE ?>css/select2.css" />
		<script type="text/javascript" src="<?= TEMPLATE ?>js/jquery.nouislider.all.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?= TEMPLATE ?>css/jquery.nouislider.min.css" />
	<?php endif; ?>
	<?php if ($_GET['view'] == 'book') { ?>
	<script src="http://api-maps.yandex.ru/2.1/?apikey=03aff5e6-f16f-40b9-a7d9-feba98b36d83&lang=ru_RU" type="text/javascript"></script>
	<?php } ?>
-->
    <!--[if lt IE 9]>
	 <link rel="stylesheet" media="screen" href="<?= TEMPLATE ?>css/ie_comp.css">
	<![endif]-->
    <script type="text/javascript"> var query = '<?=$_SERVER['QUERY_STRING']?>';</script>
    <script>
        jQuery(document).ready(function () {
            jQuery('ul.sf-menu').superfish({
                animation: {height: 'show'},	// slide-down effect without fade-in
                delay: 1200			// 1.2 second delay on mouseout
            });
        });
    </script>

    <title>Книготорговая фирма МИРС</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript"> (function (d, w, c) {
            (w[c] = w[c] || []).push(function () {
                try {
                    w.yaCounter34700330 = new Ya.Metrika({
                        id: 34700330,
                        clickmap: true,
                        trackLinks: true,
                        accurateTrackBounce: true,
                        webvisor: true,
                        trackHash: true,
                        ecommerce: "dataLayer"
                    });
                } catch (e) {
                }
            });
            var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () {
                n.parentNode.insertBefore(s, n);
            };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";
            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else {
                f();
            }
        })(document, window, "yandex_metrika_callbacks"); </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/34700330" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->


</head>

<body data-bs-spy="scroll" data-bs-target="navbar-scroll"
      data-bs-smooth-scroll="true">
<div class="bottom__cookie-block">
    <p>Продолжая использовать сайт, вы соглашаетесь на сбор файлов cookie</p>
    <a href="javascript:void(0);" class="ok">Ок</a>
</div>

<?php require_once "./././functions/analyticstracking.php"; ?>

<? if ($_SESSION['auth']['shop_id'] && $_SESSION['auth']['shop_id'] != '' && $_SESSION['auth']['role'] == 8): ?>
    <style>
        .search-form .word {
            width: 100%;
        }

        .search-form {
            position: fixed;
            margin: 0 auto;
            left: calc(50% - 585px);
            z-index: 100;
        }

        #mainbody {
            padding-top: 52px;
        }
    </style>
<? endif; ?>

<? if ($_SESSION['auth']['role'] != 8 && $_GET['login'] != 'shop'): ?>
<?php if ($view == 'promotion'): ?>
<nav class="navbar navbar-expand-lg promotion-header" id="navbar-scroll">
    <?php else: ?>
    <nav class="navbar navbar-expand-lg py-lg-4 pt-2 fixed-top" id="navbar-scroll">
        <?php endif; ?>
        <div class="container">
                <?php if ($view == 'promotion'): ?>
                <a href="/" class="promotion-logo">
            <img src="http://bookmirs.ru/views/test/images/logo_mirs.png" alt="Логотип компании" width="150"
                 height="50" class="filter-drop-shadow promotion-logo">
                 </a>
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 semibold-18 navList d-flex align-item-center promotion-navbar">
                 <a href="/">
                <img src="http://bookmirs.ru/views/test/images/logo_mirs.png" alt="Логотип компании" width="150"
                     height="50" class="filter-drop-shadow d-block d-lg-none">
                     </a>
                    <li class="nav-item navLi">
                        <a class="nav-link promotion-link" href="#scrollspyPrizes">Призы</a>
                    </li>
                    <li class="nav-item navLi">
                        <a class="nav-link promotion-link" href="#scrollspyParticipation">Как участвовать</a>
                    </li>
                    <li class="nav-item navLi">
                        <a class="nav-link promotion-link" href="#scrollspyShops">Где купить</a>
                    </li>
                    <li class="nav-item navLi">
                        <a class="nav-link promotion-link" href="#scrollspyQuestion">Вопрос ответ</a>
                    </li>
                     <li class="nav-item navLi">
                        <a class="nav-link promotion-link" href="#scrollspyContacts">Контакты</a>
                    </li>
                                        </ul>
                <div class="d-flex">
                    <div class="navBtn">
                        <div class="line1"></div>
                        <div class="line2"></div>
                        <div class="line3"></div>
                    </div>
                </div>
            </div>
                <?php else: ?>
                <a href="/">
            <img src="http://bookmirs.ru/views/test/images/logo_mirs.png" alt="Логотип компании" width="150"
                 height="50" class="filter-drop-shadow">
                 </a>
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 semibold-18 navList d-flex align-item-center">
                 <a href="/">
                <img src="http://bookmirs.ru/views/test/images/logo_mirs.png" alt="Логотип компании" width="150"
                     height="50" class="filter-drop-shadow d-block d-lg-none">
                     </a>
                    <li class="nav-item navLi">
                        <a class="nav-link" href="./#scrollspyFactsCompany">О нас</a>
                    </li>
                    <li class="nav-item navLi">
                        <a class="nav-link" href="./#scrollspyAddressShops">Магазины</a>
                    </li>

                    <li class="nav-item navLi">
                        <a class="nav-link" href="./#scrollspyNews">Новости</a>
                    </li>
                    <li class="nav-item navLi">
                        <a class="nav-link" href="./#scrollspyVacancys">Вакансии</a>
                    </li>
                    <?php if($promotions):?>
                        <li class="nav-item navLi">
                            <a class="nav-link" href="/promotion">Акция</a>
                        </li>
                    <?php endif;?>
                    <li class="nav-item navLi">
                        <a class="nav-link" href="#scrollspyContacts">Контакты</a>
                    </li>


                <button type="button" data-bs-toggle="modal" data-bs-target="#modalBonus"
                        class="btn text-white header-points-btn mb-2 me-lg-0 semibold-16 d-block d-sm-none">Показать
                    баллы
                </button>
            </ul>
            <div class="d-flex">
                <button type="button" data-bs-toggle="modal" data-bs-target="#modalBonus"
                        class="btn text-white header-points-btn me-2 me-lg-0 semibold-16 d-none d-sm-block">
                    Показать баллы
                </button>
                <div class="navBtn">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
            </div>
             <?php endif; ?>
        </div>
    </nav>
    <div class="modal fade" id="modalBonus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-10">
                                <form role="form" method="post" id="auth">
                                    <span class="semibold-24 text-center w-100">Введите номер карты:</span>
                                    <input type="text" pattern="[0-9]{13}"
                                           class="form-control my-3 extralight-12" id="card"
                                           name="card" placeholder="номер карты 13 цифр" required="">
                                    <button class="btn btn-blue-mirs w-100 text-white btn-block btn-lg mb-3"
                                            name="auth" id="btn_bonus"
                                            type="submit">Показать баллы
                                    </button>
                                    <div class="semibold-18" id="bonus"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($view !== 'promotion'): ?>
        <header>
            <div class="container" id="scrollspyMain">
                <div class="intro-text">
                    <div class="col-lg-5 col-12 col-sm-8 offset-lg-1 card-action">
                        <div class="card bg-transparent border-0">
                            <h1 class="card-title mb-1 pe-lg-4">Не знаешь, где купить книгу, с доставкой на дом?</h1>
                            <h2 class="card-text mt-2 mt-lg-3">Онлайн магазин точка24, большой ассортимент товаров,
                                здесь
                                есть
                                все, что тебе необходимо!!!</h2>
                            <a href="https://tochka24.com/"
                               class="btn btn-blue-mirs col-6 semibold-16 mt-lg-3 mt-1 text-white d-flex justify-content-center">Кликай
                                сюда!</a>
                        </div>
                    </div>
                </div>
        </header>
    <?php endif; ?>
    <script>
        $('#btn_bonus').click(function () {
            $.ajax({
                url: '/functions/ajax_get_bonus.php',
                method: 'POST',
                data: {card: $('#card').val()},
                success: function (bonus) {
                    if (bonus.startsWith("Карта")) {
                        $('#bonus').html('<span class="semibold-18">' + bonus + '</span>');
                    } else {
                        $('#bonus').html('<span class="semibold-18">Остаток баллов на карте: ' + bonus + '</span>');
                    }
                }
            });
        })
    </script>
    <? endif; ?>

    <?php if ($view !== 'promotion'): ?>
    <div id="ie-detected"></div>
    <nav class="container masstop hidden-sm hidden-xs">
    </nav>
<?php endif; ?>