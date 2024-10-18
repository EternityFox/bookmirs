<?php defined('IS_I_SITE') or die('Access denied'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="main_map" id="map">
			<div class="map_overlay"><a href="?view=shops" class="btn btn-lg btn-primary">Адреса наших магазинов >></a></div>
		</div>
	</div>
</div>



<script type="text/javascript">
if (typeof ymaps != 'undefined') {
	ymaps.ready(init);

	function init () {
	    var myMap = new ymaps.Map("map", {
	            center: [48.4835, 135.197],
	            zoom: 12
	        });

	    myMap.geoObjects
			<?php foreach($shops as $key=>$data):?><?php foreach($data as $shop):?>
				.add(new ymaps.Placemark([<?=$shop['coordinates']?>], {
					balloonContent: '<?=$key?>, <?=$shop['adress']?>'
				}, {
					preset: 'islands#dotIcon',
					iconColor: '#3b5998'
				}))
			<?php endforeach;?><?php endforeach;?>
			;
	}
}
</script>






