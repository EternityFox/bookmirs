<?php defined('IS_I_SITE') or die('Access denied'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#photoimg').die('click').live('change', function()			{
            //$("#preview").html('');

            $("#imageform").ajaxForm({target: '#image_preview',
                beforeSubmit:function(){


                    $("#imageloadstatus").show();
                    $("#imageloadbutton").hide();
                },
                success:function(){

                    $("#imageloadstatus").hide();
                    $("#imageloadbutton").show();
                },
                error:function(){

                    $("#imageloadstatus").hide();
                    $("#imageloadbutton").show();
                } }).submit();


        });


    });
</script>
<script>
    function toShort() {
        var text = document.getElementsByTagName("iframe")[0].contentDocument.getElementsByTagName("body")[0].innerHTML;
        var cleartext = $(text).text();
        var max=200;
        var val=cleartext.substring(0,max)+'...';
        $("#short_desc").html(val);
    }
</script>
<form role="form" method="POST">
	<div class="form-group">
	  <label>Вакансия</label>
	  <input type="text" name="title" class="form-control" placeholder="">
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-sm-2">
				  <label>Дата публикации:</label>
			</div>
			<div class="col-sm-2">
				 <input type="date" value="<?=date('Y-m-d')?>" class="form-control"  name="add_date">
			</div>
			<div class="col-sm-4">
				  Формат ввода: ГГГГ-ММ-ДД
			</div>
		</div>
	</div>
	<table id="vactable" width="100%">
		<tr>
			<td><label>Город:</label></td>
			<td><input type="text" name="city" class="form-control" value="Хабаровск"></td>
			<td><label>Пол:</label></td>
			<td>
				<select name="sex" class="form-control">
				  <option value="0">не имеет значения</option>
				  <option value="1">жен.</option>
				  <option value="2">муж.</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><label>Образование:</label></td>
			<td>
				<select name="education" class="form-control">
				  <option value="0">не имеет значения</option>
				  <option value="1">Высшее</option>
				  <option value="2">Неполное высшее</option>
				  <option value="3">Средне-специальное</option>
				</select>
			</td>
			<td><label>Опыт:</label></td>
			<td>
				<input type="text" name="expirience" class="form-control" />
			</td>
		</tr>
		<tr>
		<td><label>Занятость:</label></td>
			<td>
				<select name="work" class="form-control">
				  <option value="1">Полная</option>
				  <option value="2">Неполная</option>
				</select>
			</td>
			<td><label>З/П:</label></td>
			<td>
				<input type="text" name="wage" class="form-control" />
			</td>
		</tr>
        <tr>
            <td><label>Телефон:</label></td>
            <td><input type="text" name="phone" class="form-control" value=""></td>
            <td><label>Почта:</label></td>
            <td><input type="text" name="email" class="form-control" value=""></td>
        </tr>
	</table>
	<div class="form-group">
		 <label>Требования</label>
		<textarea name="requirements" id="requirements" class="form-control" rows="5" ></textarea>
	</div>
	<div class="form-group">
		 <label>Обязанности</label>
		<textarea name="responsibilities" id="responsibilities" class="form-control" rows="5" ></textarea>
	</div>
	<div class="form-group">
		 <label>Условия</label>
		<textarea name="terms" id="terms" class="form-control" rows="5" ></textarea>
	</div>
	<input type="hidden" name="add_vacancy" value="1">
    <div id='image_preview'>
    </div>
    <input type="hidden" name="add_news" value="1">
	<button id="news_submit" type="submit" class="btn btn-lg btn-success">Добавить вакансию!</button>
</form>

<form id="imageform" method="post" enctype="multipart/form-data" action='../../functions/admin/ajax_image.php'>
    Картинка:
    <div id='imageloadstatus' style='display:none'><img src="../views/admin/images/loader.gif" alt="Uploading...."/></div>
    <div id='imageloadbutton'>
        <input type="file" name="photoimg" id="photoimg" />
    </div>
</form>



