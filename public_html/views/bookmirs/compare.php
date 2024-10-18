<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if($compare_books):?>
	<?php $ccb = count($compare_books);?>
	<div class="message"> </div>
	<div class="box-heading">
		<h1 class="heading_h1">Таблица сравнения</h1>
	</div>
	<div class="box-content">
		<table class="compare-info">
			<thead><tr><td class="compare-product" colspan="<?=($ccb+1)?>">Книга</td></tr></thead>
			<tbody>
				<tr>
					<td>Наименование</td>
					<?php foreach($compare_books as $item):?>
						<td id="title" class="p<?=$item['product_id']?>" >
							<a href="?view=book&book_id=<?=$item['product_id']?>" title="<?=$item['title']?>"><?=$item['title']?></a>
							<a onclick="removeCompareProduct('<?=$item['product_id']?>');" title="Удалить товар из списка сравнения" class="btn btn-remove">×</a>
						</td>
					<?php endforeach;?>
				</tr>
				<tr>
					<td>Картинка</td>
					<?php foreach($compare_books as $item):?>
						<td id="img" class="p<?=$item['product_id']?>"><a href="?view=book&book_id=<?=$item['product_id']?>" title="<?=$item['title']?>"><img src="<?=PRODUCTIMG?><?=$item['img']?>" alt="<?=$item['title']?>" /></a></td>
					<?php endforeach;?>
				</tr>
				<tr>
					<td>Цена</td>
					<?php foreach($compare_books as $item):?>
						<td id="price" class="p<?=$item['product_id']?>"><?=$item['price']?></td>
					<?php endforeach;?>
				</tr>
				<tr>
					<td>Наличие</td>
					<?php foreach($compare_books as $item):?>
						<td id="stock" class="p<?=$item['product_id']?>">
							<?php if($item['stock']):?>
								в наличии
							<?php else:?>
								отсутсвует
							<?php endif;?>
							
						</td>
					<?php endforeach;?>
				</tr>
				<tr>
					<td>Автор</td>
					<?php foreach($compare_books as $item):?>
						<td id="author" class="p<?=$item['product_id']?>"><?=$item['author']?></td>
					<?php endforeach;?>
				</tr>
				<tr>
					<td>Издательство</td>
					<?php foreach($compare_books as $item):?>
						<td id="publish" class="p<?=$item['product_id']?>"><?=$item['publish']?></td>
					<?php endforeach;?>
				</tr>
				<tr>
					<td>Год издания</td>
					<?php foreach($compare_books as $item):?>
						<td id="publishYear" class="p<?=$item['product_id']?>"><?=$item['publishYear']?></td>
					<?php endforeach;?>
				</tr>
				<tr>
					<td>ISBN</td>
					<?php foreach($compare_books as $item):?>
						<td id="sku" class="p<?=$item['product_id']?>"><?=$item['sku']?></td>
					<?php endforeach;?>
				</tr>
				<tr>
					<td>Категория</td>
					<?php foreach($compare_books as $item):?>
						<td id="category" class="p<?=$item['product_id']?>"><?=$item['category']?></td>
					<?php endforeach;?>
				</tr>
			</tbody>
		</table>
	</div>
<?php else:?>
	<div>Вы не добавили ни один товара в список сравнения!</div>
<?php endif;?>

<script type="text/javascript">
function removeCompareProduct(product_id) { 
	jQuery.ajax({
		url: './',
		type: 'POST',
		data: {product_id: product_id, removefromcompare:1},
		success: function(res){
			if(res === 'Ошибка удаления'){
				$(".message").html(res);
			}
			else
			{
				$('.p'+product_id).hide('slow', function(){
					$(this).remove();
				});
			}
		}
	});
	$('html, body').animate({
		scrollTop: $(".message").offset().top
		}, 500);
}
</script>