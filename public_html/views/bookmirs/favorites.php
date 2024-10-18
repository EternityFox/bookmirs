<?php defined('IS_I_SITE') or die('Access denied'); ?>
<div class="box-heading">
	<h1>Избранное</h1>
</div><!--<?print_r($_SESSION)?>-->
<div class="box-content">
	<?php if($books): // если получены товары категории ?>
	<div class="product-grid row row-5">
		<?php $i=0;?>
		<?php foreach($books as $book): ?>
			<div class="pitem product-item-<?=$i?>">
				<div class="actions">
					<div class="image">
						<a href="?view=book&book_id=<?=$book['product_id']?>" title="<?=$book['title']?>">
							<?php if((file_exists('media/'.$book['img']))&&($book['img'])): ?>
								<img src="<?=PRODUCTIMG?><?=$book['img']?>" alt="<?=$book['title']?>">
							<?php else: ?>
								<img src="media/no-image.jpg" alt="<?=$book['title']?>">
							<?php endif; ?>
						</a>
					</div>
					<div class="compare">
						<a onclick="addToCompare('<?=$book['product_id']?>');" title="Добавить в список сравнения"></a>
					</div>
					<div class="remove-favorite">
						<a href="?view=favorites&id=<?=$book['product_id']?>" title="Удалить из избранного"></a>
					</div>
				</div>
				<div class="name">
					<a href="?view=book&book_id=<?=$book['product_id']?>" title="<?=$book['title']?>"><?=$book['title']?></a>
				</div>
				<div class="author"><?=$book['author']?></div>
				<div class="publish"><?=$book['publish']?></div>
				<div class="publishYear"><?=$book['publishYear']?></div>
				<div class="readmore"><a href="?view=book&book_id=<?=$book['product_id']?>" title="<?=$book['title']?>">подробнее</a></div>
				
			</div>
			<?php $i++; ?>
		<?php endforeach; ?>
	</div>
	<?php else: ?>
		<p>Здесь товаров пока нет!</p>
	<?php endif; ?>		
</div>
<script>
function addToCompare(product_id) { 
	jQuery.ajax({
		url: './',
		type: 'POST',
		data: {product_id: product_id, addtocompare:1},
		success: function(res){
			if((res === 'Ошибка добавления в список сравнения') || (res.indexOf('уже')>0) || (res.indexOf('поместить не более')>0)){
				$(".message").html(res);
			}
			else
			{
				$(".message").html(res);
				total_compare = document.getElementById('total_compare').innerHTML;
				$("#total_compare").html(parseInt(total_compare)+1);
			}
		}
	});
	$('html, body').animate({
		scrollTop: $(".product-filter").offset().top
		
</script>