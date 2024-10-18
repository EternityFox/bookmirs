    <h1>Добро пожаловать на файлообменник</h1>
	<p>Максимальный размер файлов: 150мб</p>
	<h1>Загрузить файл</h1>
	<br />
	<center>
	<form enctype="multipart/form-data" action="upload.php" id="form" method="post" onsubmit="a=document.getElementById('form').style;a.display='none';b=document.getElementById('part2').style;b.display='inline';" style="display: inline;">
	<?php echo $filetypes; ?>
	<input type="file" name="upfile" size="50" /><br />
	<?php if($emailoption) { ?>Email адрес: <input type="text" name="myemail" size="30" /> <i>(Optional)</i><br /><?php } ?>
	<?php if($descriptionoption) { ?>Описание файла: <input type="text" name="descr" size="30" /> <i>(Optional)</i><br /><?php } ?>
	<?php if($passwordoption) { ?>Пароль: <input type="text" name="pprotect" size="30" /> <i>(Optional)</i><br /><?php } ?>
	<input type="submit" value="Загрузить" id="upload" />
	</form>
	<div id="part2" style="display: none;"><h2>Идёт загрузка. Пожалуйста подождите</h2><img src="./images/load.gif"><h3><a href="http://bookmirs.ru/files/">Отменить</a></h3></div>
	 <br /><br />на данный момент на сервере <b>
		<?php echo $fileshosted; ?>
	 </b> файлов. <b><?php echo $sizehosted; ?></b> MB итого!
	</center>