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
<?php if($news):?>
	<form role="form" method="POST">
		<div class="form-group">
		  <label>Заголовок</label>
		  <input type="text" value="<?=$news['title']?>" name="title" class="form-control" placeholder="Введите заголовок">
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-sm-2">
					  <label>Дата публикации</label>
				</div>
				<div class="col-sm-2">
					 <input type="date" value="<?=date('Y-m-d', strtotime($news['event_date']))?>" class="form-control"  name="event_date">
				</div>
				<div class="col-sm-4">
					  Формат ввода: ГГГГ-ММ-ДД
				</div>
			</div>
		</div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-2">
                    <label>Отобразить на сайте:</label>
                </div>
                <div class="col-sm-2">
                    <input name="active" type="checkbox" value="1" <?php if($news['active']){echo 'checked';}?>>
                </div>
            </div>
        </div>
		<div class="form-group">
			 <label>Текст новости</label>
			<textarea name="full_desc" id="desc" class="form-control" rows="10" cols="80"><?=$news['full_desc']?></textarea>
			<script type="text/javascript">CKEDITOR.replace('desc');</script>
		</div>
		<div class="form-group">
			<button style="float:right;" type="button" class="btn btn-info" onclick="toShort();">Перенести в короткое описание</button>
		</div>
		<div class="form-group">
		  <label>Короткое описание</label>
		  <textarea name="short_desc" id="short_desc" class="form-control" rows="3"><?=$news['short_desc']?></textarea>
		</div>
		<div id='image_preview'>
			<img src="../media/images/<?=$news['img']?>" class="img-thumbnail preview"><input type="hidden" name="uploaded-image" value="<?=$news['img']?>">
		</div>
		<input type="hidden" name="edit_news" value="1">
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
	<div class="alert alert-danger" role="alert">Ошибка редактирования новости</div>
<?php endif;?>

