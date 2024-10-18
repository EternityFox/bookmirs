<form method="POST" class="rent-form">
	<?php if (isset($rent_message)) { ?>
	<div class="<?=$rent_message['type']?> message"><?=$rent_message['mess']?></div>
	<?php } ?>
	<div class="form-group">
		<label for="type">Вид предложения</label>
		<input type="text" name="type" id="type" value="<?=$_POST['type']?>">
	</div>
	<div class="form-group">
		<label for="region">Регион</label>
		<input type="text" name="region" id="region" value="<?=$_POST['region']?>">
	</div>
	<div class="form-group">
		<label for="city">Город</label>
		<input type="text" name="city" id="city" value="<?=$_POST['city']?>">
	</div>
	<div class="form-group">
		<label for="address">Улица, дом</label>
		<input type="text" name="address" id="address" value="<?=$_POST['address']?>">
	</div>
	<div class="form-group size">
		<label>Помещение</label>
		<input type="radio" name="size" value="Более 250м" id="less"<?=(!isset($_POST['size']) || $_POST['size'] == 'Более 250м') ? ' checked' : ''?>>
		<label for="less" class="small">Более 250м<sup>2</sup></label>
		<input type="radio" name="size" value="Более 300м" id="more"<?=$_POST['size'] == 'Более 300м' ? ' checked' : ''?>>
		<label for="more" class="small">Более 300м<sup>2</sup></label>
	</div>
	<div class="form-group">
		<label for="area">Предлагаемая площадь (общая площадь в м2, торговая площадь м2, подсобная площадь м2)</label>
		<textarea name="area" id="area"><?=$_POST['area']?></textarea>
	</div>
	<div class="form-group">
		<label for="contacts">Ф.И.О. и контактный тел.</label>
		<input type="text" name="contacts" id="contacts" value="<?=$_POST['contacts']?>">
	</div>
	<div class="form-group">
		<label for="email">Адрес электронной почты</label>
		<input type="text" name="email" id="email" value="<?=$_POST['email']?>">
	</div>
	<div class="form-group">
		<label for="extra">Дополнительная информация по помещению</label>
		<textarea name="extra" id="extra"><?=$_POST['extra']?></textarea>
	</div>
	<div class="captcha form-group">
		<div class="g-recaptcha" data-sitekey="6LcncBsTAAAAAAUJHhc6tyewIUozfXbQLqXM4SBM"></div>
	</div>
	<div class="form-group">
		<input type="submit" value="Отправить" class="submit" name="new_rent">
	</div>
</form>