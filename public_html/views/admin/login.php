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
	<title>Панель администратора сайта Bookmirs.ru</title>
</head>
<body id="login-page">
<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if(!$_SESSION['auth']['user']): ?>
		<?php
			if(isset($_SESSION['auth']['error'])){
				echo '<div class="alert alert-danger" role="alert">' .$_SESSION['auth']['error']. '</div>';
				unset($_SESSION['auth']);
			}
		?>
		<div class="col-sm-4">

		</div>
		<div class="col-sm-4">
			<form class="form-signin" role="form" method="post" action="/admin/">
			  <h2 class="form-signin-heading">Войти:</h2>
			  <input type="text" class="form-control" id="loginemail"  name="login" placeholder="E-mail или login" required="" autofocus="">
			  <input type="password" class="form-control" id="pass" name="pass"  placeholder="Пароль" required="">
			  <button class="btn btn-lg btn-primary btn-block" name="auth" value="1" id="auth" type="submit">Войти</button>
			</form>
		</div>
		<div class="col-sm-4">

		</div>
<?php else: ?>
	<?php print_arr($_SESSION['auth']);?>
	<p>Добро пожаловать, <?=htmlspecialchars($_SESSION['auth']['user'])?></p>
	<a href="?do=logout">Выход</a>
<?php endif; ?>
</body>
</html>
