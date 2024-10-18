<?php require_once 'inc/header.php' ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3 col-md-2 sidebar">
			<?php require_once 'inc/leftbar.php' ?>
		</div>
		<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
			<?php include $view. '.php' ?>
		</div>
	</div>
</div>

</body>
</html>
