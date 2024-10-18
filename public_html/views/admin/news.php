<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if($news):?>
	<h1 class="page-header">Новости</h1>
	<div class="table-responsive">
		<a href="/admin/?view=add_news" class="btn btn-sm btn-success">Добавить новость</a>
		<table class="table table-striped">
		<thead><tr><th>Картинка</th><th>Заголовок</th><th>Дата</th><th>Короткое описание</th><th>Просмотров</th><th></th></tr></thead>
		<tbody>
			<?php foreach($news as $newsDetail): ?>
				<tr>
					<td><img class="news_image" src="<?=PRODUCTIMG?>images/100_<?=$newsDetail['img']?>"/></td>
					<td><?=$newsDetail['title']?></td>
					<td><?=dateFormat($newsDetail['event_date'])?></td>
					<td><div id="sd"><?=$newsDetail['short_desc']?></div></td>
					<td><?=$newsDetail['hits']?></td>
					<td>
						<a class="btn btn-xs btn-primary" href="/admin/?view=edit_news&news_id=<?=$newsDetail['news_id']?>">редактировать</a>
						<form method="POST" action="">
							<input type="hidden" name="news_id" value="<?=$newsDetail['news_id']?>">
							<input type="hidden" name="delete_news" value="1">
							<button class="btn btn-xs btn-danger" type="submit" name="delete_submit" >удалить</button>
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
		</table>
	</div>

<?php else:?>
	<p>Новостей нет</p>
<?php endif;?>
