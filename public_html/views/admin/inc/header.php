<?php defined('IS_I_SITE') or die('Access denied'); ?>
<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<link rel="stylesheet" type="text/css" href="<?=ADMINTEMPLATE?>css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?=ADMINTEMPLATE?>css/style.css" />
       <!--[if lt IE 9]>
        <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
        <![endif]-->
	<script type="text/javascript" src="<?=ADMINTEMPLATE?>js/jquery.min.js"></script>
	<script type="text/javascript" src="<?=ADMINTEMPLATE?>js/jquery.form.js"></script>
	<script type="text/javascript" src="<?=ADMINTEMPLATE?>js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../functions/libraries/ckeditor/ckeditor.js"></script>
	<script src="http://api-maps.yandex.ru/2.1/?apikey=03aff5e6-f16f-40b9-a7d9-feba98b36d83&lang=ru_RU" type="text/javascript"></script>

	<title>Панель администратора сайта Bookmirs.ru</title>
</head>

<body>
	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="/admin">Bookmirs.ru</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a id="username" href="/admin?view=profile"><?=$_SESSION['auth']['user']?></a></li>
					<li><a href="/admin?view=help">Помощь</a></li>
					<li><a href="/?do=logout">Выйти</a></li>
				</ul>
				<form class="navbar-form navbar-right">
					<input type="text" class="form-control" placeholder="поиск..."/>
				</form>
			</div>
		</div>
	</div>
