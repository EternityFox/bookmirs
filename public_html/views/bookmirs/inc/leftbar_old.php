<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if($view=='page' && $page_id=='3'):?>
	<div class="gift-cards">
		<img src="<?=PRODUCTIMG?>images/podarochnie-karty.jpg" alt="<?=$page['title']?>" title="<?=$page['title']?>"/>
	</div>
<?php endif;?>


<?php if($view=='books'):?>
<script>
$(document).ready(function() { $("#authors").select2(); });
$(document).ready(function() { $("#publishes").select2(); });
</script>
<script>
$(document).ready(function() {
	$('#author').select2({
		placeholder: "Укажите автора",
		minimumInputLength: 3,
		ajax: {
			url: "functions/ajax_authors.php",
			dataType: 'json',
			quietMillis: 100,
			data: function(term, page) {
				return {
					term: term
				};
			},
			results: function (data, page) {
				return {
					results: data.results.authors
				}
			}
		},
		formatResult: function (authors) {
			return "<div class='select2-user-result'>" + authors.term + "</div>";
		},
		formatSelection: function (authors) {
			return authors.term;
		},
		initSelection: function (element, callback) {
			var elementText = $(element).attr('data-init-text');
			callback({
				"term": elementText
			});
		}
	});
	
	$('#publish').select2({
		placeholder: "Укажите издательство",
		minimumInputLength: 3,
		ajax: {
			url: "functions/ajax_publishes.php",
			dataType: 'json',
			quietMillis: 100,
			data: function(term, page) {
				return {
					term: term
				};
			},
			results: function (data, page) {
				return {
					results: data.results.publishes
				}
			}
		},
		formatResult: function (publishes) {
			return "<div class='select2-user-result'>" + publishes.term + "</div>";
		},
		formatSelection: function (publishes) {
			return publishes.term;
		},
		initSelection: function (element, callback) {
			var elementText = $(element).attr('data-init-text');
			callback({
				"term": elementText
			});
		}
	});
	
});
					
			
</script>
<div class="filter">
	<form method="POST">
		<input type="hidden" name="setFilter" value="1"/>
		<div class="form-group">
		  <input type="text" class="form-control" name="title" id="title" value="<?=$_SESSION['filter']['title']?>" placeholder="Наименование содержит...">
		</div>
		<div class="form-group">
		  <input type="text" class="form-control" value="<?=$_SESSION['filter']['isbn']?>" name="isbn" id="isbn" placeholder="ISBN...">
		</div>

		<div class="form-group">
			<input type="hidden" value="<?php echo $_SESSION['filter']['authors'];?>" data-init-text="Укажите автора..." name="authors"  id="author"/>
		</div>
		<div class="form-group">
			<input type="hidden" value="<?php echo $_SESSION['filter']['publishes'];?>" data-init-text="Укажите издательство..." name="publishes"  id="publish"/>
		</div>
		<div class="form-group">
			<label for="amount">Год:</label>
			<select name="year-min" id="year-min">
				<?php 
					for($i=$years['min'];$i<=$years['max'];$i++) {
						echo '<option value="'.$i.'"';
						if($_SESSION['filter']['year-min']==$i) {echo " selected ";}
						echo '>'.$i.'</option>';
					}
				?>
			</select>
			 - 
			<select name="year-max" id="year-max">
				<?php 
					for($i=$years['min'];$i<=$years['max'];$i++) {
						echo '<option value="'.$i.'"';
						if($_SESSION['filter']['year-max']==$i) {echo " selected ";}
						echo '>'.$i.'</option>';
					}
				?>
			</select>
			<div id="years"></div>
		</div>
		<button type="submit" class="btn btn-primary">Поставить фильтр</button>
	</form>
	<?php if($_SESSION['filter']):?>
		<form method="POST">
			<input type="hidden" name="clear_filter" value="1">
			<button id="clear_filter" type="submit" class="btn btn-danger">X</button>
		</form>
	<?php endif;?>
	<?php 
		if($_SESSION['filter']['year-min']) {$ymin=$_SESSION['filter']['year-min'];}
		else {$ymin=$years['min'];}
		if($_SESSION['filter']['year-max']) {$ymax=$_SESSION['filter']['year-max'];}
		else {$ymax=$years['max'];}
	?>
	<script>
	$('#years').noUiSlider({
		start: [ <?=$ymin?>, <?=$ymax?> ],
		step:1,
		connect: true,
		range: {
			'min': <?=$years['min']?>,
			'max': <?=$years['max']?>
		}
	});
	</script>
	<script>
	// A select element can't show any decimals
	$('#years').Link('lower').to($('#year-min'), null, wNumb({
		decimals: 0
	}));

	$('#years').Link('upper').to($('#year-max'), null, wNumb({
		decimals: 0
	}));
	</script>

	<?php if($_SESSION['filter']['authors']):?>
		<script>
			$(document).ready(function() { $("#select2-chosen-1").html('<?=$_SESSION['filter']['authors']?>'); });
		</script>
	<?php endif;?>
	<?php if($_SESSION['filter']['publishes']):?>
		<script>
			$(document).ready(function() { $("#select2-chosen-2").html('<?=$_SESSION['filter']['publishes']?>'); });
		</script>
	<?php endif;?>
</div>
<?php endif;?>


<?php if($view!='shops'):?>
	<div id="nav-bar">
		<h3 class="left-bar-title">Каталог</h3>	
		<?php echo createTree($cats, 1); ?>	
	</div>
	<div id="user-menu">
		<ul>
			<li><a href="?view=compare">Избранные товары (<span id="total_feautured"><?=$_SESSION['total_feautured']?></span>)</a></li>
		</ul>
	</div>
<?php endif;?>



