<?php defined('IS_I_SITE') or die('Access denied'); clearstatcache(); ?>

<?php if($book): // если есть запрошенный товар ?>	
	<div class="product-info row">
		<div class="col-xs-12 col-md-4 col-sm-4">
			<div class="image">
				<?php if((file_exists($_SERVER['DOCUMENT_ROOT'].'/media/'.$book['img']))&&($book['img'])): ?>
					<a href="/media/<?=$book['img']?>" data-toggle="lightbox" data-title="<?=$book['title']?>" data-footer="<?=$book['title']?>">
						<img src="/media/<?=$book['img']?>" onError="this.src='/media/no-image.jpg'">
					</a>
				<?php else: ?>
					<img src="/media/no-image.jpg" alt="<?=$book['title']?>">
				<?php endif; ?>
			</div>
		</div>
		<div class="col-xs-12 col-md-8 col-sm-8">
			<h1 class="product-title"><?=$book['title']?></h1>
			<div class="description">
				<div class="row">
					<?php if($book['author']):?>
						<div class="col-md-4 col-sm-4 col-xs-4">Автор: </div>
						<div class="col-md-8 col-sm-8 col-xs-8">
							
								<form method="POST">
									<input type="hidden" name="filter_value" value="<?=$book['author']?>">
									<button name="toFilter" value="authors" class="btn btn-sm btn-primary"><?=$book['author']?></button>
								</form>
							
						</div>
					<?php endif;?>
					<?php if($book['publish']):?>
						<div class="col-md-4 col-sm-4 col-xs-4">Издательство: </div>
						<div class="col-md-8 col-sm-8 col-xs-8">
							<form method="POST">
								<input type="hidden" name="filter_value" value="<?=$book['publish']?>">
								<button name="toFilter" value="publishes" class="btn btn-sm btn-primary"><?=$book['publish']?></button>
							</form>
						</div>
					<?php endif;?>
					<?php if($book['publishYear']):?>
						<div class="col-md-4 col-sm-4 col-xs-4">Год издания: </div>
						<div class="col-md-8 col-sm-8 col-xs-8">
							<?=$book['publishYear']?>
						</div>
					<?php endif;?>
					<?php if($book['sku']):?>
						<div class="col-md-4 col-sm-4 col-xs-4">ISBN: </div>
						<div class="col-md-8 col-sm-8 col-xs-8">
							<?=$book['sku']?>
						</div>
					<?php endif;?>
				</div>	
			</div>
			<?php if (!isShop()) { ?>
			<div class="buy-in-eshop">
				<a class="btn btn-success" target="_blank" href="http://tochka24.com/catalog?category=&q=<?=$book['sku']?>">Купить в интернет-магазине</a>
			</div>
			<?php } ?>
		</div>
	</div>
    
<pre style="display: none;">
    <? print_r( $_SESSION ); ?>
</pre>

    <? if($_SESSION['auth']['shop_id'] && $_SESSION['auth']['shop_id'] != ''  || $_SESSION['auth']['role'] == 8): ?>
        <? $currentShop = getCurrentShop($book_offer, $_SESSION['auth']['shop_id']); ?>
        <? if($currentShop): ?>
            <h3 class="page-header"><?=$currentShop['city']?></h3>
    		<table class="table table-striped">
    		<thead><tr><th>Магазин</th><th>Адрес</th><th>Кол--во</th><th>Цена</th></tr></thead><tbody>
    			<tr id="shop999" >
    	<td><span class="changeMap" onclick="changeMap('<?=$currentShop['city']?> <?=$currentShop['adress']?>', '<?=$currentShop['name']?>','shop999')"><?=$currentShop['name']?></span></td>
    	<td><span class="changeMap" onclick="changeMap('<?=$currentShop['city']?> <?=$currentShop['adress']?>', '<?=$currentShop['name']?>', 'shop999')"><?=$currentShop['adress']?></span></td>
    	<td><?=$currentShop['quantity']?></td>
    	<td><?=$currentShop['price']?></td>
    			</tr>
		<tr><td>Адрес стеллажа: </td><td><?=$currentShop['address']?></td></tr>
    		</tbody></table>
            <h3 class="page-header">В наличии в других магазинах:</h3>
        <? else: ?>
            <div class="alert alert-warning">Товар отсутствует в текущем магазине</div>
            <h2 class="page-header">В наличии в других магазинах:</h2>
        <? endif; ?>
    <? endif; ?>



	<?php if($book_offer):?>
		<?php $i=0;?>
		<?php if (isShop() && isset($book_offer['current'])) { ?>
		<?php $current = $book_offer['current']; ?>
		<h3 class="page-header"><?=$current['city']?></h3>
		<table class="table table-striped">
		<thead><tr><th>Магазин</th><th>Адрес</th><th>Кол-во</th><th>Цена</th></tr></thead><tbody>
			<tr id="shop<?=$i?>" <?php if($i==0){echo 'class="bolded"';}?>>
				<td><span class="changeMap" onclick="changeMap('<?=$current['city']?> <?=$current['adress']?>', '<?=$current['name']?>','shop<?=$i?>')"><?=$current['name']?></span></td>
				<td><span class="changeMap" onclick="changeMap('<?=$current['city']?> <?=$current['adress']?>', '<?=$current['name']?>', 'shop<?=$i?>')"><?=$current['adress']?></span></td>
				<td><?=$current['quantity']?></td>
				<td><?=$current['price']?></td>
			</tr>
		</tbody></table>
		<?php $i++; } elseif (isShop()) { ?>
		<div class="alert alert-warning">Товар отсутствует в текущем магазине</div>
		<?php } ?>
        
       

		<?php if (isShop()) { ?><h3 style="color: #F17D04; margin-top: 60px;">Наличие в других магазинах:</h3><?php } ?>
		<?php foreach($book_offer as $key=>$data): if ($key != 'current') { ?>
            

            
    			<h3 class="page-header" ><?=$key?></h3>
    			<table class="table table-striped">
    			<thead><tr><th>Магазин</th><th>Адрес</th><th>Кол-во</th><?php if (!isShop()) { ?><th>Цена</th><?php } ?></tr></thead><tbody>
    			<?php foreach($data as $shop):?>
                    

    			
                    	<tr shop_id="<?=$shop['shop_id']?>" id="shop<?=$i?>" <?php if($i==0){echo 'class="bolded"';}?>>
        					<td><span class="changeMap" onclick="changeMap('<?=$key?> <?=$shop['adress']?>', '<?=$shop['name']?>','shop<?=$i?>')"><?=$shop['name']?></span></td>
        					<td><span class="changeMap" onclick="changeMap('<?=$key?> <?=$shop['adress']?>', '<?=$shop['name']?>', 'shop<?=$i?>')"><?=$shop['adress']?></span></td>
        					<td><?=$shop['quantity']?></td>
        					<?php if (!isShop()) { ?><td><?=$shop['price']?></td><?php } ?>
        				</tr>
        				<?php $i++;?>
    			
                
                <?php endforeach;?>
    			</tbody></table>

            
		<?php } endforeach;?>
		<?php
		reset($book_offer);
		$first_shop = current($book_offer);
		?>
		<div id="map" class="col-sm-12 col-md-12 hidden-xs"></div>
	<?php else:?>
		<div class="alert alert-warning" role="alert">Извините, но на данный момент этой книги нет в магазинах.</div>
	<?php endif;?>
<script type="text/javascript">
/*ymaps.ready(init);
var myMap;*/

$('.changeMap').click(function()
{
	var table = $(this).parent().parent().parent().parent();
	$('#map').insertAfter(table).show();
	$('body, html').animate({scrollTop: $('#map').offset().top - 50}, 300);
});

changeMap = function(address, name, shop_id)
{
	$.ajax({
		url: '/functions/ajax_map.php',
		method: 'POST',
		data: { address: address },
		success: function(data)
		{
			$('#map').html('<img src="' + data + '">');
		}
	});
}
/*
function changeMap(adress, name, shop_id){
	$(".bolded").removeClass("bolded");
	$("#"+shop_id).addClass("bolded");
	$('.panel-heading').html('<strong>' + name + '</strong> - ' + adress);
	if (myMap){
		myMap.destroy();// Деструктор карты
		myMap = null;
	}
	 myMap = new ymaps.Map('map', {
        center: [48.492204, 135.099509],
        zoom: 9
    });

    ymaps.geocode(adress, {
        results: 1 
    }).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0),   
                coords = firstGeoObject.geometry.getCoordinates(),
                bounds = firstGeoObject.properties.get('boundedBy');  
                
                console.log(coords);        
            myMap.setBounds(bounds, {
                checkZoomRange: true 
            });


             var myPlacemark = new ymaps.Placemark(coords, {
             iconContent: name,
             balloonContent: adress
             }, {
             preset: 'islands#violetStretchyIcon'
             });

             myMap.geoObjects.add(myPlacemark);
        });
}
function init() {
		myMap = new ymaps.Map('map', {
        center: [48.492204, 135.099509],
        zoom: 9
    });

    // Поиск координат центра Нижнего Новгорода.
    ymaps.geocode('<?=$first_shop[0]['city']?>, <?=$first_shop[0]['adress']?>', {
        results: 1 
    }).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0),   
                coords = firstGeoObject.geometry.getCoordinates(),
                bounds = firstGeoObject.properties.get('boundedBy');          
            myMap.setBounds(bounds, {
                checkZoomRange: true 
            });


             var myPlacemark = new ymaps.Placemark(coords, {
             iconContent: '<?=$first_shop[0]['name']?>',
             balloonContent: '<?=$first_shop[0]['city']?>, <?=$first_shop[0]['adress']?>'
             }, {
             preset: 'islands#violetStretchyIcon'
             });

             myMap.geoObjects.add(myPlacemark);
        });
}*/
</script>

<script type="text/javascript">
	$(document).ready(function ($) {

		// delegate calls to data-toggle="lightbox"
		$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
			event.preventDefault();
			return $(this).ekkoLightbox({
				onShown: function() {
					if (window.console) {
						return console.log('Checking our the events huh?');
					}
				}
			});
		});
	});
</script>
<?php else: ?>
    <div class="error">Такого товара нет</div>
<?php endif; ?>

	
