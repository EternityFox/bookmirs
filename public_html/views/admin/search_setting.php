<?php defined('IS_I_SITE') or die('Access denied'); ?>

<div class="panel panel-default">
  <div class="panel-heading">Процент оптимизированных товаров:</div>
  <div class="panel-body">
   <div class="progress">
	  <div class="progress-bar" role="progressbar" aria-valuenow="<?=$percentage?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$percentage?>%;">
		<?=$percentage?>%
	  </div>
	</div>
  </div>
</div>

<a target="_blank" class="btn btn-info" href="<?=PATH?>functions/admin/search_optimization.php?param=new">Оптимизировать только новые</a>
<a target="_blank" class="btn btn-warning" href="<?=PATH?>functions/admin/search_optimization.php?param=full">Оптимизировать полностью</a>
	
<?php if($lastQueries):?>
	<h1 class="page-header">Последние поисковые запросы</h1>
	<div class="table-responsive">

		<table class="table table-striped">
		<thead><tr><th>Запрос</th><th>Дата</th><th>Время</th><th>IP</th></tr></thead>
		<tbody>
			<?php foreach($lastQueries as $log): ?>
				<tr>
					<td><?=$log['search_query']?></td>
					<td><?=$log['date']?></td>
					<td><?=$log['time']?></td>
					<td><?=$log['ip']?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
		</table>
	</div>
<?php endif;?>