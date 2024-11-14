<?php defined('IS_I_SITE') or die('Access denied'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#photoimg').die('click').live('change', function () {
            //$("#preview").html('');

            $("#imageform").ajaxForm({
                target: '#image_preview',
                beforeSubmit: function () {


                    $("#imageloadstatus").show();
                    $("#imageloadbutton").hide();
                },
                success: function () {

                    $("#imageloadstatus").hide();
                    $("#imageloadbutton").show();
                },
                error: function () {

                    $("#imageloadstatus").hide();
                    $("#imageloadbutton").show();
                }
            }).submit();


        });


    });
</script>
<script>
    function toShort() {
        var text = document.getElementsByTagName("iframe")[0].contentDocument.getElementsByTagName("body")[0].innerHTML;
        var cleartext = $(text).text();
        var max = 200;
        var val = cleartext.substring(0, max) + '...';
        $("#short_desc").html(val);
    }
</script>
<form role="form" method="POST">
    <div class="form-group">
        <label for="name">Название</label>
        <input id="name" type="text" name="name"
               value="" class="form-control">
    </div>
    <span style="display: block; margin-bottom: 10px; font-size: 16px; font-weight: 600;">Введите текст для всплывающего окна или выберите изображение или воспользуйтесь html редактор</span>
    <div class="form-group">
        <label for="title">Заголовок</label>
        <input id="title" type="text" name="title"
               value="" class="form-control">
    </div>
    <div class="form-group">
        <label for="name">Описание</label>
        <input id="description" type="text" name="description"
               value="" class="form-control">
    </div>
    <div class="form-group col s12">
            <textarea id="content" class="form-control"
                      name="content"></textarea>
    </div>
    <script>
        CKEDITOR.replace('content');
    </script>
    <div class="form-group col s12">
        <label for="url_href">Ссылка, где отобразить модальное окно</label>
        <input id="url_href" type="text" name="url_href"
               value="" class="form-control">
    </div>
    <div class="form-group col s12">
        <label for="url_redirect">Ссылка для перехода на страницу при клике на картинку</label>
        <input id="url_redirect" type="text" name="url_redirect"
               value="" class="form-control">
    </div>
    <div class="form-group col s12">
        <label>Анимация для появления окна</label>
        <select name="animations" id="animations" class="form-control">
            <?php foreach ($type_annimations as $key => $value): ?>
                <option value="<?= $key ?>"><?= $value ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group col s12">
        <label for="data_start" class="active">Дата начала</label>
        <input id="data_start" type="date" name="data_start" class="form-control"
               value="<?= isset($mytime) ? $mytime : '' ?>">
    </div>
    <div class="form-group col s12">
        <label for="data_end" class="active">Дата окончания</label>
        <input id="data_end" type="date" name="data_end" class="form-control"
               value="<?= isset($mytime) ? date('Y-m-d', $mytime + (30 * 24 * 60 * 60)) : '' ?>">
    </div>
    <div class="form-group">
        <label for="action">Отобразить иконку акции</label>
        <input name="action" type="checkbox"
               id="action">
    </div>
    <input type="hidden" name="add_promo_modal" value="1">
    <div id='image_preview'>
    </div>
    <input type="hidden" name="edit_promo_modal" value="1">
    <button id="promo_modal_submit" type="submit" class="btn btn-lg btn-success">Сохранить!</button>
</form>

<form id="imageform" method="post" enctype="multipart/form-data" action='../../functions/admin/ajax_image.php'>
    Картинка:
    <div id='imageloadstatus' style='display:none'><img src="../views/admin/images/loader.gif" alt="Uploading...."/>
    </div>
    <div id='imageloadbutton'>
        <input type="file" name="photoimg" id="photoimg"/>
    </div>
</form>