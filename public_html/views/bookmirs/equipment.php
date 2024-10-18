<?php defined('IS_I_SITE') or die('Access denied'); ?>

<?php
if (isset($_POST['submit'])) {

	$dmapptoken = "319483557c9f68efafe100b547ecbe0cc3727612";
	$dmtoken = "fea64bd1a59778c28b09e8954b11665b0cff2662";
	$card = $_POST['card'];

	$url = "http://pos-api.dinect.com/20130701/users/?_dmapptoken=$dmapptoken&_dmtoken=$dmtoken&auto=$card&format=json";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
	curl_setopt($ch, CURLOPT_URL, "$url");
	$result = curl_exec($ch);
	curl_close($ch);
	$obj = json_decode($result);
	$id = $obj[0]->id;

        if ("$id" > "0") {
		$bonus = $obj[0]->bonus;
	} else {
			unset($obj);
			unset($id);
			$dmtoken = "f6cdbd6e88ae82d39b5c6bcb4128f8931eb30818";
	        	$url = "http://pos-api.dinect.com/20130701/users/?_dmapptoken=$dmapptoken&_dmtoken=$dmtoken&auto=$card&format=json";
	        	$ch = curl_init();
	        	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	        	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        		curl_setopt($ch, CURLOPT_URL, "$url");
        		$result = curl_exec($ch);
        		curl_close($ch);
        		$obj = json_decode($result);
			$id = $obj[0]->id;
			        if ("$id" > "0") {
					$bonus = $obj[0]->bonus;
				} else {
			                $message = "Карта с таким номером не найдена";
				}
	}
}
?>
	<div class="col-sm-4"></div>
	<div class="col-sm-4">
		<form class="form-signin" role="form" method="post" id="auth" >
			<h2 class="form-signin-heading">Введите номер карты:</h2>
			<input type="text" pattern="[0-9]{13}" class="form-control" id="pass" name="card"  placeholder="номер карты 13 цифр" required="">
			<button class="btn btn-lg btn-primary btn-block" name="submit" id="auth" type="submit">Показать баллы</button>
<?php
	if ("$bonus" >= "0") {
		echo '<h3 class="form-signin-heading">Остаток баллов на карте: '.$bonus.'</h3>';
	} else {
		echo '<h3 class="form-signin-heading">'.$message.'</h3>';
	}
?>
		</form>
	</div>
	<div class="col-sm-4"></div>
