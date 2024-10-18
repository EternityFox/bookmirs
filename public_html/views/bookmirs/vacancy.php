<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if($vacancy): // если есть вакансия ?>
<?php
	if($vacancy['sex']==1){
		$sex='женский';
	}
	elseif ($vacancy['sex']==2){
		$sex='мужской';
	}
	else{
		$sex='не имеет значения';
	}
	
	if($vacancy['education']==1){
		$education = 'Высшее';
	}
	elseif($vacancy['education']==2){
		$education = 'Неполное высшее';
	}
	elseif($vacancy['education']==3){
		$education = 'Средне-специальное';
	}
	else{
		$education = 'не имеет значения';
	}
	
	if($vacancy['work']==2){
		$work = 'Неполная';
	}
	else{
		$work = 'Полная';
	}
?>	


	<div class="box-heading">
		<h1><?=$vacancy['title']?></h1>
	</div>
	<div id="vacancy_info">
		<div id="label">город:</div>
		<div id="vacancy_city"><?=$vacancy['city']?></div>
		<div id="label">пол:</div>
		<div id="vacancy_sex"><?=$sex?></div>
		<?php if($vacancy['age']):?>
			<div id="label">возраст:</div>
			<div id="vacancy_age"><?=$vacancy['age']?></div>
		<?php endif;?>
		<div id="label">образование:</div>
		<div id="vacancy_education"><?=$education?></div>
		<?php if($vacancy['expirience']):?>
			<div id="label">опыт работы:</div>
			<div id="vacancy_expirience"><?=$vacancy['expirience']?></div>
		<?php endif;?>
		<div id="label">занятость:</div>
		<div id="vacancy_work"><?=$work?></div>
		<?php if($vacancy['wage']):?>
			<div id="label">зарплата:</div>
			<div id="vacancy_wage"><?=$vacancy['wage']?></div>
		<?php endif;?>
		<?php if($vacancy['requirements']):?>
			<div id="label">требования:</div>
			<div id="vacancy_requirements"><?=$vacancy['requirements']?></div>
		<?php endif;?>
		<?php if($vacancy['responsibilities']):?>
			<div id="label">обязанности:</div>
			<div id="vacancy_responsibilities"><?=$vacancy['responsibilities']?></div>
		<?php endif;?>
		<?php if($vacancy['terms']):?>
			<div id="label">условия:</div>
			<div id="vacancy_terms"><?=$vacancy['terms']?></div>
		<?php endif;?>
		<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
				  <span aria-hidden="true">×</span>
				  <span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Вакансия: <?=$vacancy['title']?></h4>
			  </div>
			  <form id="ajax_call" method="post" action="" class="bs-example bs-example-form" role="form">
				  <div class="modal-body">
						<h4 id="hidden-after-send1">Запросить звонок на номер:</h4>
						<div id="modal-message"> </div>
							<div id="hidden-after-send2" class="input-group">
								<span class="input-group-addon">номер телефона:</span>
								<input type="text" class="form-control" id="phone_number" name="phone_number" />
								<input type="hidden" id="form_vacancy" name="form_vacancy" value="<?=$vacancy['title']?>" />
								<input type="hidden" id="form_vacancy_id" name="form_vacancy_id" value="<?=$vacancy['vacancy_id']?>" />
							</div>
						
						<hr/>
						<p id="hidden-after-send3">Впишите Ваш номер телефона в окошке выше и в ближайшее время мы обязательно Вам позвоним.</p>
						<p>Вы также можете написать нам на e-mail: <a href="mailto:hr-manager@bookmirs.ru"><strong>hr-manager@bookmirs.ru</strong></a> или позвонить по телефону: <strong>(4212) 47-00-47 доб.341 (с 09-00 до 18-00) или 8-924-100-5052 </strong></p>
						</p>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
					<button type="button" onclick="send_call();" id="call_send" class="btn btn-primary">Отправить</input>
				  </div>
			  </form>
			</div>
			<!-- /.modal-content -->
		  </div>
		 </div>
		  <!-- /.modal-dialog -->
		 <?php if($_SESSION['vacancies_send']):?>
			<?php if(!in_array($vacancy['vacancy_id'],$_SESSION['vacancies_send'])):?>
<!--
				<button id="call" class="btn btn-success" data-toggle="modal" data-target="#myModal">
					Запросить звонок
				</button>
-->
			<?php else:?>
				<button id="call" class="btn btn-success" disabled="disabled">
					Вы уже отправили запрос по этой вакансии
				</button>
			<?php endif;?>
		<?php else:?>
<!--
			<button id="call" class="btn btn-success" data-toggle="modal" data-target="#myModal">
				Запросить звонок
			</button>
-->
		<?php endif;?>

	</div>
		<div class="well">
			<p>Вce социальные гарантии (оформление по ТК РФ).</p>
			<p>Доставка транспортом фирмы от ост. "Большая" и "Автопарк".</p>
			<p>Собеседование по адресу: <a href="#" data-toggle="modal" data-target="#mapModal">г. Хабаровск, ул. Промышленная, 11</a> (ост. "Большая", "Автопарк") тел. (4212) 47-00-47 доб.341 (с 09-00 до 18-00) или 8-924-100-5052 </p>
			<p>Будем Вам признательны за предварительный звонок по телефону и отправленное резюме по электронной почте hr-manager@bookmirs.ru!
		</div>
		
		
		<div id="mapModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel" aria-hidden="true" style="display: none;">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
				  <span aria-hidden="true">×</span>
				  <span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">г. Хабаровск Промышленная 11</h4>
			  </div>
				  <div class="modal-body">
						<div id="map""></div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
				  </div>
			</div>
			<!-- /.modal-content -->
		  </div>
		 </div>
<script type="text/javascript">
ymaps.ready(init);
var myMap;
function init() {
		myMap = new ymaps.Map('map', {
        center: [48.492204, 135.099509],
        zoom: 9
    });

    // Поиск координат центра Нижнего Новгорода.
    ymaps.geocode('г. Хабаровск, ул. Промышленная, 11', {
        results: 1 
    }).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0),   
                coords = firstGeoObject.geometry.getCoordinates(),
                bounds = firstGeoObject.properties.get('boundedBy');          
            myMap.setBounds(bounds, {
                checkZoomRange: true 
            });


             var myPlacemark = new ymaps.Placemark(coords, {
             iconContent: 'ООО МИРС',
             balloonContent: 'г. Хабаровск, ул. Промышленная, 11'
             }, {
             preset: 'islands#violetStretchyIcon'
             });

             myMap.geoObjects.add(myPlacemark);
        });
}
</script>
<script>

function send_call(){ // перехватываем все при событии отправки
	    var form = $(this); 
        var error = false;
		var phone = '';
		var vid = '';
		var vacancy = '';
		phone = document.getElementById('phone_number').value;
		vacancy = document.getElementById('form_vacancy').value;
		vid = document.getElementById('form_vacancy_id').value;
		if (phone === '')
		{
			$("#modal-message").html('<div id="modal-error"><strong>Вы не указали номер телефона</strong></div>');
			$(".input-group-addon").html('<strong>номер телефона:</strong>');
			error = true;
		}
         if (!error) { // если ошибки нет
             $.ajax({ // инициализируем ajax запрос
                type: 'POST', // отправляем в POST формате, можно GET
                url: 'functions/ajax_mail.php', // путь до обработчика, у нас он лежит в той же папке
                dataType: 'json', // ответ ждем в json формате
                data: {phone_number: phone, vacancy: vacancy, vid: vid}, // данные для отправки
				
                beforeSend: function(data) { // событие до отправки
					$('#call_send').attr('disabled',true);
                   },
				   
                success: function(data){ // событие после удачного обращения к серверу и получения ответа
                     if (data['error']) { // если обработчик вернул ошибку
						$("#modal-message").html('<div id="modal-error"><strong>'+ data['error'] + '</strong></div>');
                     } else { // если все прошло ок
                         $("#modal-message").html('<div id="modal-succes"><h4>Запрос отправлен!</h4><p>Мы свяжемся с Вами в ближайшее время</p></div>');
						 $("#hidden-after-send1").html('');
						 $("#hidden-after-send2").html('');
						 $("#hidden-after-send3").html('');
						 $("#call").attr('disabled',true);
                     }
                  }
     
			});
         }
         return false; // вырубаем стандартную отправку формы
     };
</script>
<?php else: ?>
    <div class="error">Извините, но данная вакансия уже не актуальна</div>
<?php endif; ?>
