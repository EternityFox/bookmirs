<?php defined('IS_I_SITE') or die('Access denied'); ?>
<div class="row">
	<div class="dash-col4 col-md-4 col-sm-6 col-xs-12">
		<a href="/admin/?view=shops" class="btn btn-lg btn-default">Магазинов: <?=$stat['shops']?></a>

	</div>
	<div class="dash-col4  col-md-4 col-sm-6 col-xs-12">
		<a href="#" class="btn btn-lg btn-primary">Товаров: <?=$stat['products']?></a>
	</div>
	<div class="dash-col4 col-md-4 col-sm-6 col-xs-12">
		<a href="#" class="btn btn-lg btn-success">Предложений: <?=$stat['offers']?></a>
	</div>
	<div class="dash-col4 col-md-4 col-sm-6 col-xs-12">
		<a href="/admin/?view=vacancies" class="btn btn-lg btn-info">Вакансий: <?=$stat['vacancies']?></a>
	</div>
	<div class="dash-col4 col-md-4 col-sm-6 col-xs-12">
		<a href="/admin/?view=news" class="btn btn-lg btn-warning">Новостей: <?=$stat['news']?></a>
	</div>
	<div class="dash-col4 col-md-4 col-sm-6 col-xs-12">
		<a href="#" class="btn btn-lg btn-danger">Пользователей: <?=$stat['users']?></a>
	</div>
</div>

<div class="page-header"><h1>Популярные новости</h1></div>
<div class="table-responsive">
	<table class="table table-striped">
	<thead><tr><th>Картинка</th><th>Заголовок</th><th>Дата</th><th>Просмотров</th></tr></thead>
	<tbody>
		<?php foreach($news as $newsDetail): ?>
			<tr>
				<td><img class="news_image" src="<?=PRODUCTIMG?>images/100_<?=$newsDetail['img']?>"/></td>
				<td><a href="/admin/?view=edit_news&news_id=<?=$newsDetail['news_id']?>"><?=$newsDetail['title']?></a>
					<div id="sd"><?=$newsDetail['short_desc']?></div>
				</td>
				<td><?=dateFormat($newsDetail['event_date'])?></td>
				<td><strong><?=$newsDetail['hits']?></strong></td>

			</tr>
		<?php endforeach; ?>
	</tbody>
	</table>
</div>
<a href="/admin/?view=news" class="btn btn-lg btn-info">ВСЕ НОВОСТИ (<?=$stat['news']?>) >></a>
<div class="page-header"><h1>Популярные вакансии</h1></div>
<div class="table-responsive">
	<table class="table table-striped">
	<thead><tr><th>Вакансия</th><th>Город</th><th>Дата добавления</th><th>Просмотров</th></tr></thead>
	<tbody>
		<?php foreach($vacancies as $vacancy): ?>
			<tr>
				<td><a href="/admin/?view=edit_vacancy&vacancy_id=<?=$vacancy['vid']?>"><?=$vacancy['title']?></a></td>
				<td><?=$vacancy['city']?></td>
				<td><?=dateFormat($vacancy['add_date'])?></td>
				<td><strong><?=$vacancy['hits']?></strong></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
	</table>
</div>
<a href="/admin/?view=vacancies" class="btn btn-lg btn-info">ВСЕ ВАКАНСИИ (<?=$stat['vacancies']?>)>></a>

<div class="page-header"><h1>Популярные товары</h1></div>
<div class="table-responsive">
	<table class="table table-striped">
	<thead><tr><th>Товар</th><th>Автор</th><th>Издательство</th><th>ISBN</th><th>Год</th><th>Просмотров</th></tr></thead>
	<tbody>
		<?php foreach($products as $product): ?>
			<tr>
				<td><?=$product['title']?></td>
				<td><?=$product['author']?></td>
				<td><?=$product['publish']?></td>
				<td><?=$product['sku']?></td>
				<td><?=$product['publishYear']?></td>
				<td><strong><?=$product['hits']?></strong></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
	</table>
</div>


