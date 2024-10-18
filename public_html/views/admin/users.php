<?php defined('IS_I_SITE') or die('Access denied'); ?>
<h1 class="page-header">Пользователи</h1>



<div class="table-responsive">
	<a href="/admin/?view=add_user" class="btn btn-sm btn-success">Добавить пользователя</a>
	<table class="table table-striped">
		<thead><tr><th>ID</th><th>Имя</th><th>Логин</th><th>E-Mail</th><th>Адрес</th><th>Телефон</th><th>Роль</th><th>Добавлен</th><th>Действия</th></tr></thead>
		<tbody>
			<?php foreach ($users as $user) { ?>
			<tr>
				<td><?=$user['user_id']?></td>
				<td><?=$user['name']?></td>
				<td><?=$user['login']?></td>
				<td><?=$user['email']?></td>
				<td><?=$user['address']?></td>
				<td><?=$user['phone']?></td>
				<td><?=$user['role_id']?></td>
				<td><?=$user['dateAdd']?></td>
				<td>
					<a href="?view=add_user&amp;id=<?=$user['user_id']?>" class="btn btn-primary">Изменить</a>
					<a href="?view=delete_user&amp;id=<?=$user['user_id']?>" class="btn btn-danger">Удалить</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<nav>
	<ul class="pagination">
		<?php if ($cur_page > 1) { ?>
		<li>
			<a href="?view=users&amp;page=<?=($cur_page -1)?>" aria-label="Предыдущая">
				<span aria-hidden="true">&laquo;</span>
			</a>
		</li>
		<?php } ?>
		<?php for ($i = 1; $i <= $page_count; $i++) { ?>
		<?php if (abs($i - $cur_page) < 10) { ?>
		<li<?=$i == $cur_page?' class="active"':''?>><a href="?view=users&amp;page=<?=$i?>"><?=$i?></a></li>
		<?php } ?>
		<?php } ?>
		<?php if ($cur_page < $page_count) { ?>
		<li>
			<a href="?view=users&amp;page=<?=($cur_page + 1)?>" aria-label="Следующая">
				<span aria-hidden="true">&raquo;</span>
			</a>
		</li>
		<?php } ?>
	</ul>
</nav>