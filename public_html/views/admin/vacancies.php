<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if($vacancies):?>
	<h1 class="page-header">Вакансии</h1>
	<div class="table-responsive">
		<a href="/admin/?view=add_vacancy" class="btn btn-sm btn-success">Добавить вакансию</a>
		<table class="table table-striped">
		<thead><tr><th>Картинка</th><th>Вакансия</th><th>Город</th><th>Дата добавления</th><th>Просмотров</th><th>Добавил</th><th></th><th></th></tr></thead>
		<tbody>
			<?php foreach($vacancies as $vacancy): ?>
				<tr>
                    <td><img class="news_image" src="<?=PRODUCTIMG?>images/100_<?=$vacancy['img']?>"/></td>
                    <td><?=$vacancy['title']?></td>
					<td><?=$vacancy['city']?></td>
					<td><?=dateFormat($vacancy['add_date'])?></td>
					<td><?=$vacancy['hits']?></td>
					<td><?=$vacancy['user']?></td>
					<td>
						<a class="btn btn-xs btn-primary" href="/admin/?view=edit_vacancy&vacancy_id=<?=$vacancy['vid']?>">редактировать</a>
					</td>
					<td>
						<form method="POST" action="">
							<input type="hidden" name="vacancy_id" value="<?=$vacancy['vid']?>">
							<input type="hidden" name="delete_vacancy" value="1">
							<button class="btn btn-xs btn-danger" type="submit" name="delete_submit" >удалить</button>
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
		</table>
	</div>

<?php else:?>
	<p>Вакансий нет</p>
	<a href="/admin/?view=add_vacancy" class="btn btn-sm btn-success">Добавить вакансию</a>
<?php endif;?>
