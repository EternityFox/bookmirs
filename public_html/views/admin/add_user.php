<?php defined('IS_I_SITE') or die('Access denied'); ?>
<h1 class="page-header">Пользователь</h1>
<?php if (isset($error)) { ?>
<div class="alert alert-danger"><?=$error?></div>
<?php } ?>


<form method="POST" class="add-user-form">
	<div class="form-group">
		<label>Роль</label>
		<select name="role_id" class="form-control" id="role_id" >
			<option value="1"<?=isset($user) && $user['role_id'] == 1?' selected':''?>>Пользователь</option>
			<option value="7"<?=isset($user) && $user['role_id'] == 7?' selected':''?>>Администратор</option>
            <option value="8"<?=isset($user) && $user['role_id'] == 8?' selected':''?>>Магазин</option>
		</select>
	</div>
    
    <div class="form-group">
		<label>Имя</label>
		<input type="text" name="name" class="form-control"<?=isset($user)?' value="'.$user['name'].'"':''?>>
	</div>
	<div class="form-group">
		<label>E-Mail</label>
		<input type="text" name="email" class="form-control"<?=isset($user)?' value="'.$user['email'].'"':''?>>
	</div>
	<div class="form-group">
		<label>Логин</label>
		<input type="text" name="login" class="form-control"<?=isset($user)?' value="'.$user['login'].'"':''?>>
	</div>
	<div class="form-group">
		<label>Пароль</label>
		<input type="password" name="pwd" class="form-control">
	</div>
	<div class="form-group">
		<label>Пароль ещё раз</label>
		<input type="password" name="pwd2" class="form-control">
	</div>
	<div class="form-group">
		<label>Телефон</label>
		<input type="text" name="phone" class="form-control"<?=isset($user)?' value="'.$user['phone'].'"':''?>>
	</div>
	<div class="form-group">
		<label>Адрес</label>
		<textarea name="address" class="form-control"><?=isset($user)?$user['address']:''?></textarea>
	</div>
	

<?php if ( !isset($_GET['id']) ): ?>    
    <div class="form-group">
		<label>Город</label>
		<select id="city_id" name="city_id" class="form-control">
			<option value="null" selected >Выберете город</option>
            <? foreach($shops['city'] as $city): ?>
			 <option value="<?=$city?>" ><?=$city?></option>
            <? endforeach; ?>
        </select>
	</div>
    
    
    <div class="form-group shop_id" style="display: none;" >
		<label>Магазин</label>
		<select id="shop_id" name="shop_id" class="form-control">
			<option value="null" selected >Выберете магазин</option>
        </select>
	</div>
    
    <script>
        $(document).ready(function(){
            var shops = <?=json_encode($shops['shops'])?>;

            $('#city_id').on('change', function(){
                if( $(this).val() != 'null' ){
                    var city = $(this).val();
                    var shop = shops[city];
                    var sselect = $('#shop_id');
                    sselect.children('option').remove();
                    var resString = '<option value="null" selected >Выберете магазин</option>';
                    
                    $.each(shop,function(i,value){
                        resString += '<option value="' + value.shop_id + '" >' + value.name + ' - ' + value.adress + '</option>';
                    });
                    sselect.html(resString);
                    $('.shop_id').show();
                
                }
            });
            
            $('#role_id').on('change', function(){
                if( $(this).val() == 8 ){
                    var inputHide = '';
                    inputHide = $('.add-user-form').find('input[name="name"]');
                    inputHide.val('shop');
                    inputHide.parent('.form-group').hide();
                    
                    inputHide = $('.add-user-form').find('input[name="email"]');
                    inputHide.val('shop');
                    inputHide.parent('.form-group').hide();
                    
                    inputHide = $('.add-user-form').find('input[name="phone"]');
                    inputHide.val('shop');
                    inputHide.parent('.form-group').hide();
                    
                    inputHide = $('.add-user-form').find('textarea[name="address"]');
                    inputHide.val('shop');
                    inputHide.parent('.form-group').hide();
                } else{
                    $('.form-group').show();
                    $('.add-user-form').find('input[type="text"]').val('');
                    $('.add-user-form').find('textarea').val('');
                }
            });
            
            
        });
    </script>
<?php endif; ?>    
    
	<?php if (isset($_GET['id'])) { ?>
	<input type="hidden" value="<?=$_GET['id']?>" name="id">
	<?php } ?>
	<div class="form-group">
		<input type="submit" value="Сохранить" class="btn btn-success" name="user_edit">
	</div>
</form>