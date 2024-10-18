<?php defined('IS_I_SITE') or die('Access denied'); ?>
<div id="content-zakaz">
	<h2>Оформление заказа</h2>
 <?php
 if(isset($_SESSION['order']['res'])){
    echo $_SESSION['order']['res'];
	if (isset($_SESSION['order']['pass']))
	{
		echo 'Мы сгенерировали Вам пароль: ' . $_SESSION['order']['pass'];
	}
	elseif (isset($_SESSION['auth']['temp_name']))
	{
		echo 'Приятно Вас видеть снова,' . $_SESSION['auth']['temp_name'];
	}
 }
 ?>
 <?php if($_SESSION['cart']): // проверка корзины, если в корзине есть товары ?>
	<table class="zakaz-maiin-table" border="0" cellspacing="0" cellpadding="0">
	<form method="post" action="">
	  <tr>
		<td class="z_top">&nbsp;&nbsp;&nbsp;&nbsp;наименование</td>
		<td class="z_top" align="center">количество</td>
		<td class="z_top" align="center">стоимость</td>
		<td class="z_top" align="center">&nbsp;</td>
	  </tr>
<?php foreach($_SESSION['cart'] as $key => $item): ?>
	  <tr>
		<td class="z_name">
			<a href="#"><img src="<?=PRODUCTIMG?><?=$item['img']?>" width="32" title="" /></a> 
			<a href="#"><?=$item['name']?></a>
		</td>
		<td class="z_kol"><input id="id<?=$key?>" class="kolvo" type="text" value="<?=$item['qty']?>" name="" /></td>
		<td class="z_price"><?=$item['price']?></td>
		<td class="z_del"><a href="?view=cart&delete=<?=$key?>"><img src="<?=TEMPLATE?>images/delete.jpg" title="удалить товар из заказа" /></a></td>
	  </tr>
<?php endforeach; ?>
	  <tr>
		<td class="z_bot">&nbsp;&nbsp;&nbsp;&nbsp;Итого:</td>
		<td class="z_bot" colspan="3" align="right"><?=$_SESSION['total_quantity']?> шт &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=$_SESSION['total_sum']?> руб.</td>
	  </tr>
	  
	</table>
	
	<div class="sposob-dostavki">
		<h4>Способы доставки:</h4>
		<ul>
        <?php 
			foreach($shipping as $item)
			{
				if ($item['shipping_id']==1) //если самовывоз
				{
					echo '<li><input id="radio'.$item['shipping_id'].'" type="radio" onClick="rad_onClick(this)"  name="shipping" value="'.$item['shipping_id'].'" checked />'.$item['name'].'</li>';
				}
				elseif ($item['shipping_id']==3) //если курьер
				{
					if($_SESSION['city']['current']=='Хабаровск')
					{
						echo '<li><input id="radio'.$item['shipping_id'].'" type="radio" onClick="rad_onClick(this)"  name="shipping" value="'.$item['shipping_id'].'" />'.$item['name'].'</li>';
					}
				}
				elseif ($item['shipping_id']==2) //Почта России
				{
					echo '<li><input id="radio'.$item['shipping_id'].'" type="radio" onClick="rad_onClick(this)" name="shipping" value="'.$item['shipping_id'].'" />'.$item['name'].' в '.$_SESSION['city']['current'].' (<a id="other_city" href="#" onclick="document.getElementById(\'parent_popup\').style.display=\'block\';" title="city" class="other_city">другой город</a>)</li>';
				}
				else
				{
					echo '<li><input id="radio'.$item['shipping_id'].'" type="radio" onClick="rad_onClick(this)" name="shipping" value="'.$item['shipping_id'].'" />'.$item['name'].' </li>';
				}
			}
			?>
		</ul>
	</div>	
        <script src="http://yandex.st/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
    
<script type="text/javascript">
 ymaps.ready(init);
var myMapDef, 
    myPlacemark;
function init () {


            myMapDef = new ymaps.Map("map", {
                center: [48.492204, 135.099509],
                zoom: 16
            }); 
            
            myPlacemark = new ymaps.Placemark([48.492204, 135.099509], {
                hintContent: 'БигАвто',
                balloonContent: '60 лет Октября проспект 239'
            });
            
            myMapDef.geoObjects.add(myPlacemark);
}
function rad_onClick(o) {
	if(o.value==='1'){
		document.getElementById('map').style.display = 'block';
		document.getElementById('curier').style.display = 'none';
	}
	else if(o.value==='3'){
		document.getElementById('curier').style.display = 'block';
		document.getElementById('map').style.display = 'none';
	}
	else{
		document.getElementById('map').style.display = 'none';
		document.getElementById('curier').style.display = 'none';
	}
}
</script>

	<div  id="map" style="width: 870px; height: 400px;"></div>	
	<div  id="curier" style="display:none;">
		Адрес:
		<input type="text" name="adress" value="">
	</div>	
	
	
<?php if(!$_SESSION['auth']['user']): // проверка авторизации ?>	
	<h3 class="notauth">Как нам с вами связаться (телефон / e-mail):</h3>
	<table class="zakaz-data" border="0" cellspacing="0" cellpadding="0">
	  <tr class="notauth">
		<td class="zakaz-inpt"><input type="text" name="contact" value="<?=$_SESSION['order']['name']?>" /></td>
	  </tr>
	</table>

<?php endif; // конец условия проверки авторизации ?>		
    <table class="zakaz-data" border="0" cellspacing="0" cellpadding="0">
        <tr>
    		<td class="zakaz-txt" style="vertical-align:top;">Примечание </td>
    		<td class="zakaz-txtarea"><textarea name="prim"></textarea></td>
    		<td class="zakaz-prim" style="vertical-align:top;">Пример: Позвоните пожалуйста после 10 вечера, 
    до этого времени я на работе </td>
        </tr>
	</table>
		<input type="submit" name="make_order" value="Оформить заказ" /> 
	
	</form>
    <?php else: // если товаров нет ?>
        Корзина пуста
    <?php endif; // конец условия проверки корзины ?>
<?php
unset($_SESSION['order']);
?>	
</div> <!-- .content-zakaz -->