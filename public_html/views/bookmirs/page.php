<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if($page): // если есть вакансия ?>
	<div class="box-heading">
		<h1><?=$page['title']?></h1>
	</div>
	<div class="page-wrapper">
		<?php if($page['img']):?>
			<div class="page-image"><img src="<?=PRODUCTIMG?>images/<?=$page['img']?>" alt="<?=$page['title']?>" title="<?=$page['title']?>"/></div>
		<?php endif;?>
		<?=$page['content']?>
	</div>
	<?php if ($_GET['page_id'] ==2) require_once('modules/rent.php'); ?>
<?php else: ?>
    <div class="error">Извините, но данная странци сейчас недоступна</div>
<?php endif; ?>