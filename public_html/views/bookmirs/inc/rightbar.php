<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if ($view=="battery" || $type=="battery"):?>
<div class="block">
	<div class="block-title">
	  <strong>
		<span>Фильтр</span>
	  </strong>
	  <span class="toggle"></span>
	</div>
	<div class="block-content">
		<div class="share-search">
			<div>
				<form method="get">
                <input type="hidden" name="view" value="search_filter" />
				<input type="hidden" name="type" value="battery" />
				<input class="podbor-title" value="<?php echo $title; ?>" type="text" name="title" placeholder="Наименование" />
				<div id="filter_title">Стоимость:</div>
				от <input class="podbor-price" type="text" value="<?php echo $startprice; ?>" name="startprice" />
				до <input class="podbor-price" type="text" value="<?php echo $endprice; ?>" name="endprice" />
				 <!-- 
				<p>Полярность:</p>
				<input type="checkbox" name="polarity[]" value="1">Прямая
				<input type="checkbox" name="polarity[]" value="2">Обратная
				<p>Тип корпуса:</p>
				<input type="checkbox" name="case[]" value="1">Азия
				<input type="checkbox" name="case[]" value="2">Евро
				<p>Размер клемм:</p>
				<input type="checkbox" name="terminal_size[]" value="1">Широкие
				<input type="checkbox" name="terminal_size[]" value="2">Узкие
				-->
				<div id="filter_title">Производитель:</div>
				 <?php $size = count($brands); ?>
				<select id="brand" size="<?=$size?>" multiple name="brand[]">
				<?php foreach($brands as $key => $item): ?>
					 <option value="<?php echo $key; ?>"><?php echo $item; ?></option>
				 <?php endforeach; ?>
				 </select>
				<input class="podbor" id="search_button" type="submit" name="battery_filter" value="Найти" />						
				</form>
				
			</div>
		</div>	
	</div>
</div>
 <?php endif; ?>
 <?php if (($view=="oil") || ($view=="search_filter" && $type=="oil")):?>
 <div class="block">
	<div class="block-title">
	  <strong>
		<span>Фильтр</span>
	  </strong>
	  <span class="toggle"></span>
	</div>
	<div class="block-content">
		<div class="share-search">
			<div>
				<form method="get">
                <input type="hidden" name="view" value="search_filter" />
				<input type="hidden" name="type" value="oil" />
				<input class="podbor-title" value="<?php echo $title; ?>" type="text" name="title" placeholder="Наименование" />
				<div id="filter_title">Стоимость:</div>
				от <input class="podbor-price" type="text" value="<?php echo $startprice; ?>" name="startprice" />
				до <input class="podbor-price" type="text" value="<?php echo $endprice; ?>" name="endprice" />
				<div id="filter_title">Тип:</div>
				<input type="checkbox" id="filter_chek"  name="oil_type[]" value="1">Моторные масла<br/>
				<input type="checkbox" id="filter_chek"  name="oil_type[]" value="2">Масла для МКП<br/>
				<input type="checkbox" id="filter_chek"  name="oil_type[]" value="3">Жидкость для АКП, вариаторов<br/>
				<input type="checkbox" id="filter_chek"  name="oil_type[]" value="4">Масла для раздаточной коробки<br/>
				<input type="checkbox" id="filter_chek"  name="oil_type[]" value="5">Масло для дифференциала<br/>
				  <div id="filter_title">Производители:</div>
				 <?php $size = count($brands); ?>
				<select id="brand" size="<?=$size?>" multiple name="brand[]">
				<?php foreach($brands as $key => $item): ?>
					 <option value="<?php echo $key; ?>"><?php echo $item; ?></option>
				 <?php endforeach; ?>
				 </select>
				<div id="filter_title">Объём:</div>
				 <?php $size = count($oil_v); ?>
				 <select id="brand" size="<?=$size?>" multiple name="oil_v[]">
					  <?php foreach($oil_v as $key => $v): ?>
					     <option value="<?php echo $v; ?>"><?php echo $v; ?></option>
					   <?php endforeach; ?>
				 </select>
				<div id="filter_title">Вязкость:</div>
				 <?php $size = count($sae); ?>
				 <select id="brand" size="<?=$size?>" multiple name="sae[]">
					  <?php foreach($sae as $key => $value): ?>
					     <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
					   <?php endforeach; ?>
				 </select>
				<div id="filter_title">Состав:</div>
				<input type="checkbox" id="filter_chek" name="composition[]" value="1">Синтетическое<br/>
				<input type="checkbox" id="filter_chek" name="composition[]" value="2">Полусинтетическое<br/>
				<input type="checkbox" id="filter_chek" name="composition[]" value="3">Минеральное<br/>
				<input class="podbor" id="search_button" type="submit" name="oil_filter" value="Найти" />					
				</form>
			</div>
		</div>	
	</div>
</div>
 <?php endif; ?>
  <?php if (($view=="filter") || ($view=="search_filter" && $type=="filter")):?>
 <div class="block">
	<div class="block-title">
	  <strong>
		<span>Фильтр</span>
	  </strong>
	  <span class="toggle"></span>
	</div>
	<div class="block-content">
		<div class="share-search">
			<div>
				<form method="get">
                <input type="hidden" name="view" value="search_filter" />
				<input type="hidden" name="type" value="filter" />
				<input class="podbor-title" value="<?php echo $title; ?>" type="text" name="title" placeholder="Наименование" />
				<div id="filter_title">Стоимость:</div>
				от <input class="podbor-price" type="text" value="<?php echo $startprice; ?>" name="startprice" />
				до <input class="podbor-price" type="text" value="<?php echo $endprice; ?>" name="endprice" />
				<div id="filter_title">Тип:</div>
				<input id="filter_chek" type="checkbox" name="filter_type[]" value="1">Масляные фильтры<br/>
				<input id="filter_chek"  type="checkbox" name="filter_type[]" value="2">Воздушные фильтры<br/>
				<input id="filter_chek"  type="checkbox" name="filter_type[]" value="3">Салонные фильтры<br/>
				<input id="filter_chek"  type="checkbox" name="filter_type[]" value="4">Топилвные фильтры<br/>
				<div id="filter_title">Производители:</div>
				 <?php $size = count($brands); ?>
				<select id="brand" size="<?=$size?>" multiple name="brand[]">
				<?php foreach($brands as $key => $item): ?>
					 <option value="<?php echo $key; ?>"><?php echo $item; ?></option>
				 <?php endforeach; ?>
				 </select>
				 
				<input class="podbor" id="search_button" type="submit" name="battery_filter" value="Найти" />				
				</form>
			</div>
		</div>	
	</div>
</div>
 <?php endif; ?>

<div class="block">
	<div class="block-title">
	  <strong>
		<span>Авторизация</span>
	  </strong>
	  <span class="toggle"></span>
	</div>
	<div class="block-content">
		<div class="enter">
			<div class="authform">
                <?php if(!$_SESSION['auth']['user']): ?>
                <form id="sauth" method="post" action="/">
                    <input placeholder="логин" type="text" name="login" id="login" />
                    <input  placeholder="пароль" type="password" name="pass" id="pass" />
                    <input type="submit" name="auth" id="auth" value="Войти" />
                    <p class="link"><a href="?view=reg">Регистрация</a></p>
                </form>
                <?php
                    if(isset($_SESSION['auth']['error'])){
                        echo '<div class="error">' .$_SESSION['auth']['error']. '</div>';
                        unset($_SESSION['auth']);
                    }
                ?>
                <?php else: ?>
					<p>Добро пожаловать, <?=htmlspecialchars($_SESSION['auth']['user'])?></p>
                    <a href="?do=logout">Выход</a>
                <?php endif; ?>
			</div> <!-- .authform -->	
		</div> <!-- .enter -->	
	</div>
</div>



