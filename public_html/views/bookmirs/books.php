<?php defined('IS_I_SITE') or die('Access denied'); ?>

<pre style="display: none;">
<?
print_r($_SESSION);
?>
</pre>

<div class="box-heading">
	<h1>
		<?php if($filterOnly=='author'):?>
			Все книги автора <?=$_SESSION['filter']['authors']?>
			<form method="POST">
				<input type="hidden" name="clear_filter" value="1"/>
				<button  type="submit" class="btn btn-danger">снять фильтр</button>
			</form>
		<?php elseif($filterOnly=='publish'):?>
			Все книги от издательства <?=$_SESSION['filter']['publishes']?>
			<form method="POST">
				<input type="hidden" name="clear_filter" value="1"/>
				<button  type="submit" class="btn btn-danger">снять фильтр</button>
			</form>
		<?php elseif($category_name):?>
			<?=$category_name?>
		<?php else:?>
			Книги
		<?php endif;?>
	</h1>
</div>
<ul class="list-group">
    <?php foreach($child_categories as $child_category):?>
    	<?php if($child_category['count_rows']):?>
    	  <li class="list-group-item">
    		<span class="badge"><?=$child_category['count_rows']?></span>
    		<a href="?view=books&category=<?=$child_category['category_id']?>"><?=$child_category['name']?></a>
    	  </li>
    	<?php endif; ?>
    <?php endforeach;?>
</ul>

<div class="box-content">
			<?php if($_SESSION['filter']):?>
				<?php if(!$filterOnly):?>
					<div class="panel panel-primary">
					  <div class="panel-heading">
						<h3 class="panel-title">
							На показ товаров установлен следующий фильтры:
						</h3>
					  </div>
					  <div class="panel-body">
						<h3 class="filterLabels">
						<form method="POST">
							<?php if($_SESSION['filter']['title']):?>
								<span class="label label-info"><span class="sm-label">наим.:</span>"<?=$_SESSION['filter']['title']?>"
									<button id="removeFilter" name="removeFilter" value="title" type="submit" class="btn btn-sm btn-danger">x</button>
								</span>
								
							<?php endif;?>
							<?php if($_SESSION['filter']['isbn']):?>
								<span class="label label-info"><span class="sm-label">isbn.:</span>"<?=$_SESSION['filter']['isbn']?>"
									<button id="removeFilter" name="removeFilter" value="isbn" type="submit" class="btn btn-sm btn-danger">x</button>
								</span>
							<?php endif;?>
							<?php if($_SESSION['filter']['authors']):?>
								<span class="label label-info"><?=$_SESSION['filter']['authors']?>
									<button id="removeFilter" name="removeFilter" value="authors" type="submit" class="btn btn-sm btn-danger">x</button>
								</span>
							<?php endif;?>
							<?php if($_SESSION['filter']['publishes']):?>
								<span class="label label-info"><?=$_SESSION['filter']['publishes']?>
									<button id="removeFilter" name="removeFilter" value="publishes" type="submit" class="btn btn-sm btn-danger">x</button>
								</span>
							<?php endif;?>
							<?php if($_SESSION['filter']['year-min']):?>
								<?php if($_SESSION['filter']['year-max']):?>
									<span class="label label-info"><?=$_SESSION['filter']['year-min']?> - <?=$_SESSION['filter']['year-max']?>
										<button id="removeFilter" name="removeFilter" value="years" type="submit" class="btn btn-sm btn-danger">x</button>
									</span>
								<?php else:?>
									<span class="label label-info">c <?=$_SESSION['filter']['year-min']?>
										<button id="removeFilter" name="removeFilter" value="years" type="submit" class="btn btn-sm btn-danger">x</button>
									</span>
								<?php endif;?>
							<?php elseif($_SESSION['filter']['year-max']):?>
									<span class="label label-info">по <?=$_SESSION['filter']['year-max']?>
										<button id="removeFilter" name="removeFilter"  value="years" type="submit" class="btn btn-sm btn-danger">x</button>
									</span>
							<?php endif;?>
						</form>
						</h3>
					  </div>
					</div>
				<?php endif;?>
		<?php endif;?>
	<?php if($books): // если получены товары категории ?>
		<div class="product-filter hidden-sm hidden-xs">
			<div class="display">
				<a id="list" onclick="display('list');"></a>
				<a id="grid" onclick="display('grid');"></a>
			</div>
			<div class="product-compare" id="totalcompare">
				<a href="?view=compare">Таблица сравнения (<span id="total_compare"><?=$_SESSION['total_compare']?></span>)</a>
			</div>
			<div class="limit">
				показать:
				<div class="select-box">
					<div class="sub-select-box">
						<form method="POST" id="onPageForm">
							<select name="onPage" onchange="document.getElementById('onPageForm').submit()">
								<option value="15" <?php if($_SESSION['onpage']=='15') echo 'selected';?>>15</option>
								<option value="25" <?php if($_SESSION['onpage']=='25') echo 'selected';?>>25</option>
								<option value="50" <?php if($_SESSION['onpage']=='50') echo 'selected';?>>50</option>
								<option value="75" <?php if($_SESSION['onpage']=='75') echo 'selected';?>>75</option>
								<option value="100" <?php if($_SESSION['onpage']=='100') echo 'selected';?>>100</option>
							</select>
						</form>
					</div>
				</div>
			</div>
			<div class="sort">
				cортировка по:
				<div class="select-box">
					<div class="sub-select-box">
						<form method="POST" id="sortByForm">
							<select name="sortBy" onchange="document.getElementById('sortByForm').submit()">
								<option value="titleA" <?php if($_SESSION['sortby']=='titleA') {echo 'selected';}?>>Наименованию (А-Я)</option>
								<option value="titleZ" <?php if($_SESSION['sortby']=='titleZ') {echo 'selected';}?>>Наименованию (Я-А)</option>
								<option value="authorA"  <?php if($_SESSION['sortby']=='authorA') {echo 'selected';}?>>Автору (А-Я)</option>
								<option value="authorZ"  <?php if($_SESSION['sortby']=='authorZ') {echo 'selected';}?>>Автору (Я-А)</option>
								<option value="publishA"  <?php if($_SESSION['sortby']=='publishA') {echo 'selected';}?>>Издательству (А-Я)</option>
								<option value="publishZ"  <?php if($_SESSION['sortby']=='publishZ') {echo 'selected';}?>>Издательству (Я-А)</option>
								<option value="publishYearA"  <?php if($_SESSION['sortby']=='publishYearA') {echo 'selected';}?>>Году (с новых)</option>
								<option value="publishYearZ"  <?php if($_SESSION['sortby']=='publishYearZ') {echo 'selected';}?>>Году (со старых)</option>
							</select>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="message"> </div>
		<div class="product-grid row">
			<?php $i=0;?>
			<?php foreach($books as $book): ?>
				<div class="pitem product-item-<?=$i?>">
					<div class="image">
						<a href="?view=book&book_id=<?=$book['product_id']?>" title="<?=$book['title']?>">
							<?php if(file_exists('media/'.$book['img']) && $book['img']): ?>
								<img src="/media/<?=$book['img']?>" onError="this.src='/media/no-image.jpg'" >
							<?php else: ?>
								<img src="/media/no-image.jpg" alt="not found">
							<?php endif; ?>
						</a>
					</div>
					<div class="left">
						<div class="name">
							<a href="?view=book&book_id=<?=$book['product_id']?>" title="<?=$book['title']?>"><?=$book['title']?></a>
						</div>
						<table>
							<tbody>
								<tr><td><div id="label">Автор: </div></td><td><div class="author"><?=$book['author']?></div></td></tr>
								<tr><td><div id="label">Издательство: </div></td><td><div class="publish"><?=$book['publish']?></div></td></tr>
								<tr><td><div id="label">Год издания: </div></td><td><div class="publishYear"><?=$book['publishYear']?></div></td></tr>
							</tbody>
						</table>
						<div class="actions clearfix">
							<div class="additional-features">
								<div class="wishlist">
									<a onclick="addToFeautured('<?=$book['product_id']?>');" title="Добавить в избранное"></a>
								</div>
								<div class="compare">
									<a onclick="addToCompare('<?=$book['product_id']?>');" title="Добавить в список сравнения"></a>
								</div>	
								<div class="readmore"><a href="?view=book&book_id=<?=$book['product_id']?>" title="<?=$book['title']?>"></a></div>
							</div>		
						</div>
					</div>	
				</div>
				<?php $i++; ?>
			<?php endforeach; ?>
		</div>
		<?php if($pages_count > 1) pagination($page, $pages_count); ?>
		
<script type="text/javascript"> 
	function display(view) {
		if (view == 'list') {
			jQuery('.product-grid').attr('class', 'product-list row');
			jQuery('.display').html('<span id="list"></span> <a id="grid" onclick="display(\'grid\');"></a>');
			jQuery.totalStorage('display', 'list'); 
		} else {
		    jQuery('.product-list').attr('class', 'product-grid row');
			jQuery('.display').html('<a id="list" onclick="display(\'list\');"></a><span id="grid"></span>');
			jQuery.totalStorage('display', 'grid');
		}
		view = jQuery.totalStorage('display');
		if (view) {
			display(view);
		} else {
		    display('grid');
		} 
	}
	
	function addToCompare(product_id) { /*Таблица сравнения*/
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
			}, 500);
	}
	function addToFeautured(product_id) { /*Избранное*/
		jQuery.ajax({
			url: './',
			type: 'POST',
			data: {product_id: product_id, addtofavorites:1},
			success: function(res){
				if((res === 'Ошибка добавления в список избранных') || (res.indexOf('уже')>0)){
					$(".message").html(res);
				}
				else
				{
					$(".message").html(res);
					total_feautured = document.getElementById('total_feautured').innerHTML;
					$("#total_feautured").html(parseInt(total_feautured)+1);
				}
			}
		});
		$('html, body').animate({
			scrollTop: $(".product-filter").offset().top
			}, 500);
	}

//--></script>

	<?php else: ?>
		<p>Здесь товаров пока нет!</p>
	<?php endif; ?>		
</div>





