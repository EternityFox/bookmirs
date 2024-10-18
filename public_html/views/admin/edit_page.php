<?php defined('IS_I_SITE') or die('Access denied'); ?>
<form method="POST" class="page-form">
	<div class="form-group">
		<input type="text" name="title" value="<?=$page['title']?>" class="form-control" placeholder="Заголовок">
	</div>
	<div class="form-group">
		<textarea name="content" class="form-control" placeholder="Содержимое" id="content"><?=$page['content']?></textarea>
		<script src="../views/admin/js/ckeditor/ckeditor.js"></script>
		<script>CKEDITOR.replace('content');</script>
	</div>
	<div class="form-group">
		<input type="hidden" name="id" value="<?=$page['page_id']?>">
		<input type="submit" value="Сохранить" class="btn btn-success" name="page_edit">
	</div>
</form>