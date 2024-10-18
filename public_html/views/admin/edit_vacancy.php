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
<?php if($vacancy):?>
	<form role="form" method="POST">
		<div class="form-group">
		  <label>Вакансия</label>
		  <input type="text" name="title" class="form-control" value="<?=$vacancy['title']?>">
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-sm-2">
					  <label>Дата публикации:</label>
				</div>
				<div class="col-sm-2">
					 <input type="date" value="<?=date('Y-m-d', strtotime($vacancy['add_date']))?>" class="form-control"  name="add_date">
				</div>
				<div class="col-sm-4">
					  Формат ввода: ГГГГ-ММ-ДД
				</div>
			</div>
		</div>
		<table id="vactable" width="100%">
			<tr>
				<td><label>Город:</label></td>
				<td><input type="text" name="city" class="form-control" value="<?=$vacancy['city']?>"></td>
				<td><label>Пол:</label></td>
				<td>
					<select name="sex" class="form-control">
					  <option value="0" <?php if($vacancy['sex']==0) {echo 'selected';}?>>не имеет значения</option>
					  <option value="1" <?php if($vacancy['sex']==1) {echo 'selected';}?>>жен.</option>
					  <option value="2" <?php if($vacancy['sex']==2) {echo 'selected';}?>>муж.</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><label>Образование:</label></td>
				<td>
					<select name="education" class="form-control">
					  <option value="0" <?php if($vacancy['education']==0) {echo 'selected';}?>>не имеет значения</option>
					  <option value="1" <?php if($vacancy['education']==1) {echo 'selected';}?>>Высшее</option>
					  <option value="2" <?php if($vacancy['education']==2) {echo 'selected';}?>>Неполное высшее</option>
					  <option value="3" <?php if($vacancy['education']==3) {echo 'selected';}?>>Средне-специальное</option>
					</select>
				</td>
				<td><label>Опыт:</label></td>
				<td>
					<input type="text" name="expirience" class="form-control" value="<?=$vacancy['expirience']?>"/>
				</td>
			</tr>
			<tr>
			<td><label>Занятость:</label></td>
				<td>
					<select name="work" class="form-control">
					  <option value="1" <?php if($vacancy['work']==1) {echo 'selected';}?>>Полная</option>
					  <option value="2" <?php if($vacancy['work']==2) {echo 'selected';}?>>Неполная</option>
					</select>
				</td>
				<td><label>З/П:</label></td>
				<td>
					<input type="text" name="wage" class="form-control" value="<?=$vacancy['wage']?>"/>
				</td>
			</tr>
            <tr>
                <td><label>Телефон:</label></td>
                <td><input type="text" name="phone" class="form-control" value="<?=$vacancy['phone']?>"></td>
                <td><label>Почта:</label></td>
                <td><input type="text" name="email" class="form-control" value="<?=$vacancy['email']?>"></td>
            </tr>
		</table>
		<div class="form-group">
			 <label>Требования</label>
			<textarea name="requirements" id="requirements" class="form-control" rows="5" ><?=$vacancy['requirements']?></textarea>
		</div>
		<div class="form-group">
			 <label>Обязанности</label>
			<textarea name="responsibilities" id="responsibilities" class="form-control" rows="5" ><?=$vacancy['responsibilities']?></textarea>
		</div>
		<div class="form-group">
			 <label>Условия</label>
			<textarea name="terms" id="terms" class="form-control" rows="5" ><?=$vacancy['terms']?></textarea>
		</div>
        <div id='image_preview'>
            <img src="../media/images/<?=$vacancy['img']?>" class="img-thumbnail preview"><input type="hidden" name="uploaded-image" value="<?=$vacancy['img']?>">
        </div>
		<input type="hidden" name="edit_vacancy" value="1">
		<button id="news_submit" type="submit" class="btn btn-lg btn-success">Готово!</button>
	</form>
    <form id="imageform" method="post" enctype="multipart/form-data" action='../../functions/admin/ajax_image.php'>
        Картинка:
        <div id='imageloadstatus' style='display:none'><img src="../views/admin/images/loader.gif" alt="Uploading...."/></div>
        <div id='imageloadbutton'>
            <input type="file" name="photoimg" id="photoimg" />
        </div>
    </form>
<?php else: ?>
    <div class="error">Ошибка редактирования вакансии</div>
<?php endif; ?>


