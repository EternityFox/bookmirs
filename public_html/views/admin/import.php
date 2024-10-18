<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if($logs['items']):?>
	<?php if($interval->days<1):?>
		<!-- <div class="alert alert-success"><strong>Предложения акутуальны (<?=$interval->h?> ч. назад)</strong></div>-->
	<?php else:?>
		<!-- <div class="alert alert-danger" role="alert"><strong>Предложения не актуальны.</strong> Последнее успешное <?=$interval->days?> д. назад</div>-->
	<?php endif;?>
	
	<h1 class="page-header">Лог импорта</h1>
<form class="filter" method="GET">
	<input type="date" name="from" class="form-control" value="<?=$_GET['from']?>">
	<input type="date" name="to" class="form-control" value="<?=$_GET['to']?>">
	<input type="hidden" name="view" value="import">
	<button class="btn btn-success">Применить</button>
</form>
	<?=pagination(isset($_GET['page']) ? $_GET['page'] : 1, $logs['count'])?>
	<div class="table-responsive">

		<table class="table table-striped" id="import-log">
		<thead><tr><th>Дата</th><th>Время</th><th>Событие</th></tr></thead>
		<tbody>
			<?php foreach($logs['items'] as $log): ?>
				<?php 
					$class="";
					if($log['status']==0){$class="notin";}
				?>
				<tr class="<?=$class?>">
					<td><?=$log['date']?></td>
					<td><?=$log['time']?></td>
					<td><?=$log['desc']?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
		</table>
	</div>

<?php else:?>
	<p>Лог пуст</p>
<?php endif;?>
