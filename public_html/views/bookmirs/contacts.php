<?php defined('IS_I_SITE') or die('Access denied'); ?>

<div id="system-message-container"> </div>
<div class="contact">
	<div class="contact-wrap clearfix">
		<div class="row">
			<div class="contact-col2 col-md-6 col-sm-6 col-xs-12">
				<div class="contact-form">
					<h4>Написать нам</h4>
					<form id="contact-form" action="" method="post" class="form-validate form-horizontal">
						<fieldset>
							<legend>Отправка почты. Все поля, помеченные "*" обязательны к заполнению</legend>
							<div class="control-group-header">
								<div class="row">
									<div class="control-contact clearfix col-xs-12 col-sm-12 col-md-6">
										<label id="name-lbl"  class="hasTooltip" required>Ваше имя<span class="star"> *</span></label>
										<input type="text" name="contact_name" id="contact_name" value="" size="30"/>
									</div>
									<div class="control-contact clearfix col-xs-12 col-sm-12 col-md-6">
										<label id="email-lbl"  class="hasTooltip" required>Ваш e-mail<span class="star"> *</span></label>
										<input type="text" name="contact_email" id="contact_email" value="" size="30"/>
									</div>
								</div>
								<div class="control-contact clearfix">
									<label id="message-lbl" class="hasTooltip" required>Текст сообщения<span class="star"> *</span></label>
									<textarea name="contact_message" id="contact_message" cols="50" rows="10"></textarea>
								</div>
<input type="checkbox" name="agree" id="contact_agree" checked required>   Я даю согласие на обработку своих персональных данных.
<a href="http://bookmirs.ru/?view=page&page_id=11" target="_blank">Положение об обработке персональных данных</a>.
								<div class="control-group-footer clearfix">
									<button type="button" onclick="send_contact_form();" id="send_email" class="btn btn-primary">Отправить</input>
								</div>

							</div>
						</fieldset>
					</form>
				</div>
			</div>
			<div class="contact-col2 col-md-6 col-sm-6 col-xs-12">
				<div id="map"> </div>
				<div class="well">
					<h4>ООО "МИРС"</h4>
                                                        <p>Центральный офис</p>
                                                        <p>Адрес: 680000 г. Хабаровск, ул. Промышленная, 11</p>
                                                        <p>Телефон: 47-00-47</p>
                                                        <p>Часы работы в будни 9:00-18:00</p>
				</div>
			</div>
		</div>
	</div>
</div>




<script type="text/javascript">
function send_contact_form(){ // перехватываем все при событии отправки
		$(".invalid").removeClass("invalid");
		var name=document.getElementById('contact_name').value;
		var email = document.getElementById('contact_email').value;
		var message = document.getElementById('contact_message').value;
		var agree = document.querySelector('input[type=checkbox]');
		if ((name=='')||(email=='')||(message=='')||(!agree.checked)) {
			var error = "Вы не указали: <ul>"
			if (name==''){
				$("#contact_name").addClass("invalid");
				error = error + '<li><strong>Ваше имя</strong></li>';
			}
			if(email==''){
				$("#contact_email").addClass("invalid");
				error = error + '<li><strong>Ваш адрес электронной почты</strong></li>';
			}
			if (message=='') {
				$("#contact_message").addClass("invalid");
				error = error + '<li><strong>Текст сообщения</strong></li>';
			}
			error = error + '</ul>';
			if (!agree.checked) {
                                $("#contact_agree").addClass("invalid");
                                error = error + '<li><strong>Вы не дали согласие на обработку персональных данных</strong></li>';
                        }
			$("#system-message-container").html('<div class="alert alert-danger" role="alert">' + error + '</div>');
		}
		else
		{
			 $.ajax({ 
                type: 'POST', 
                url: 'functions/ajax_send_mail.php', 
                dataType: 'json', 
                data: {contact_name: name, contact_email: email, contact_message: message}, 
				
                beforeSend: function(data) { 
					$('#send_email').attr('disabled',true);
                   },
				   
                success: function(data){ // событие после удачного обращения к серверу и получения ответа
                     if (data['error']) { // если обработчик вернул ошибку
						$("#system-message-container").html('<div class="alert alert-danger" role="alert"><strong>'+ data['error'] + '</strong></div>');
                     } else { // если все прошло ок
                         $("#system-message-container").html('<div class="alert alert-success" role="alert"><strong>Ваше сообщение успешно отправлено!</strong></div>');
                     }
                  }
     
			});
		}
		
         return false; // вырубаем стандартную отправку формы
     };
</script>

<script type="text/javascript">
ymaps.ready(init);
var myMap;
function init() {
		myMap = new ymaps.Map('map', {
        center: [48.492204, 135.099509],
        zoom: 9
    });

    // Поиск координат центра Нижнего Новгорода.
    ymaps.geocode('г. Хабаровск, ул. Промышленная 11', {
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
             balloonContent: 'г. Хабаровск, ул. Промышленная 11'
             }, {
             preset: 'islands#violetStretchyIcon'
             });

             myMap.geoObjects.add(myPlacemark);
        });
}
</script>




