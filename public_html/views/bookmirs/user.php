<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if(!$_SESSION['auth']['user']): ?>
	<?php if($_GET['section']=='registration'): ?>
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
		    <?php
			if(isset($_SESSION['reg']['res'])){
				echo '<div class="alert alert-danger" role="alert">' .$_SESSION['reg']['res']. '</div>';
				unset($_SESSION['reg']);
			}
			?>
		<form class="form-signin" role="form" method="post" action="/">
		  <h2 class="form-signin-heading">Регистрация</h2>
		  <div class="form-group">
				<div class="input-group">
				<div class="input-group-addon">@</div>
					<input class="form-control" type="email" name="email" required="" placeholder="Введите e-mail"/>
				</div>
			</div>
		  <button class="btn btn-lg btn-primary btn-block" name="reg" id="reg" type="submit">Выслать письмо с паролем</button>
		</form>
		</div>
		<div class="col-sm-4"></div>
	<?php elseif($_GET['section']=='remind_password'): ?>
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<form class="form-signin" role="form" method="post" action="/">
			  <h2 class="form-signin-heading">Напомнить пароль</h2>
			  <div class="form-group">
					<div class="input-group">
					<div class="input-group-addon">@</div>
						<input class="form-control" type="email" name="email"required=""   placeholder="Введите e-mail"/>
					</div>
				</div>
			  <button class="btn btn-lg btn-primary btn-block" name="reg" id="reg" type="submit">Выслать письмо</button>
			</form>
		</div>
		<div class="col-sm-4"></div>
	<?php else: ?>
		<?php
			if(isset($_SESSION['auth']['error'])){
				echo '<div class="alert alert-danger" role="alert">' .$_SESSION['auth']['error']. '</div>';
				unset($_SESSION['auth']);
			}
		?>
		<div class="col-sm-4">

		</div>
		<div class="col-sm-4">
			<form class="form-signin" role="form" method="post" id="auth" >
			  <h2 class="form-signin-heading">Войти:</h2>
			  <input type="text" class="form-control" id="loginemail"  name="login" placeholder="E-mail или login" required="" autofocus="">
			  <input type="password" class="form-control" id="pass" name="pass"  placeholder="Пароль" required="">
              <input type="hidden" class="form-control" name="authenticate" id="authenticate" value="authenticate" />
			  <button class="btn btn-lg btn-primary btn-block" name="auth" id="auth" type="submit">Войти</button>
			</form>
		</div>
		<div class="col-sm-4">

		</div>
	<?php endif; ?>
<?php else: ?>
	<p>Добро пожаловать, <?=htmlspecialchars($_SESSION['auth']['user'])?></p>
    <a href="/?view=books&cf=true" class="btn">Перейти в каталог</a>
	<a href="?do=logout">Выход</a>
<?php endif; ?>


