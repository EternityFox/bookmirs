<?php defined('IS_I_SITE') or die('Access denied'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#photoimg').die('click').live('change', function() {

            $("#imageform").ajaxForm({target: '#image_preview',
                beforeSubmit:function(){


                    $("#imageloadstatus").show();
                    $("#imageloadbutton").hide();
                },
                success:function(){

                    $("#imageloadstatus").hide();
                    $("#imageloadbutton").show();
                },
                error:function(){

                    $("#imageloadstatus").hide();
                    $("#imageloadbutton").show();
                } }).submit();


        });


    });
</script>
<script>
    function toShort() {
        var text = document.getElementsByTagName("iframe")[0].contentDocument.getElementsByTagName("body")[0].innerHTML;
        var cleartext = $(text).text();
        var max=200;
        var val=cleartext.substring(0,max)+'...';
        $("#short_desc").html(val);
    }
</script>
<?php if ($promo_modal): ?>
    <form role="form" method="POST">
        <div class="form-group">
            <label for="name">Название</label>
            <input id="name" type="text" name="name" class="form-control"
                   value="<?= isset($promo_modal) ? $promo_modal['name'] : '' ?>">
        </div>

        <span style="display: block; margin-bottom: 10px; font-size: 16px; font-weight: 600;">Введите текст для всплывающего окна или выберите изображение или воспользуйтесь html редактор</span>

        <div class="form-group">
            <label for="title">Заголовок</label>
            <input id="title" type="text" name="title" class="form-control"
                   value="<?= isset($promo_modal) ? $promo_modal['title'] : '' ?>">
        </div>


        <div class="form-group">
            <label for="name">Описание</label>
            <input id="description" type="text" name="description" class="form-control"
                   value="<?= isset($promo_modal) ? $promo_modal['description'] : '' ?>">
        </div>

        <div class="form-group">
            <textarea id="content" class="materialize-textarea" class="form-control"
                      name="content"><?= isset($promo_modal) ? $promo_modal['content'] : '' ?></textarea>
        </div>

        <script>
            CKEDITOR.replace('content');
        </script>
        <div class="form-group">
            <?php if (isset($promo_modal['filename']) && !empty($promo_modal['filename'])): ?>
                <div id='image_preview'>
                    <img src="../media/images/<?=$promo_modal['filename']?>" class="img-thumbnail preview"><input type="hidden" name="uploaded-image" value="<?=$promo_modal['filename']?>">
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="url_href">Ссылка, где отобразить модальное окно</label>
            <input id="url_href" type="text" name="url_href" class="form-control"
                   value="<?= isset($promo_modal) ? $promo_modal['url_href'] : '' ?>">
        </div>

        <div class="form-group">
            <label for="url_redirect">Ссылка для перехода на страницу при клике на картинку</label>
            <input id="url_redirect" type="text" name="url_redirect" class="form-control"
                   value="<?= isset($promo_modal) ? $promo_modal['url_redirect'] : '' ?>">
        </div>

        <div class="form-group">
            <label>Анимация для появления окна</label>
            <select name="animations" id="animations" class="form-control">
                <?php foreach ($type_annimations as $key => $value): ?>
                    <option value="<?= $key ?>"<?= isset($promo_modal) && $promo_modal['pop_up_type'] == $key ? ' selected' : '' ?>><?= $value ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="data_start" class="active">Дата начала</label>
            <input id="data_start" type="date" name="data_start" class="form-control"
                   value="<?= isset($promo_modal['data_start']) ? $promo_modal['data_start'] : (isset($mytime) ? $mytime : '') ?>">
        </div>

        <div class="form-group">
            <label for="data_end" class="active">Дата окончания</label>
            <input id="data_end" type="date" name="data_end" class="form-control"
                   value="<?= isset($promo_modal['data_end']) ? $promo_modal['data_end'] : (isset($mytime) ? date('Y-m-d', $mytime + (30 * 24 * 60 * 60)) : '') ?>">
        </div>

        <p class="form-group">
            <label for="action">Отобразить иконку акции</label>
            <input name="action" class="filled-in" type="checkbox" class="form-control"
                   id="action"<?= isset($promo_modal['action']) ? ($promo_modal['action'] == 1 ? ' checked' : '') : '' ?>>
        </p>
        <input type="hidden" name="edit_promo_modal" value="1">
        <button id="promo_modal_submit" type="submit" class="btn btn-lg btn-success">Готово!</button>
    </form>

    <form id="imageform" method="post" enctype="multipart/form-data" action='../../functions/admin/ajax_image.php'>
        Картинка:
        <div id='imageloadstatus' style='display:none'><img src="../views/admin/images/loader.gif" alt="Uploading...."/>
        </div>
        <div id='imageloadbutton'>
            <input type="file" name="photoimg" id="photoimg"/>
        </div>
    </form>

<?php else: ?>
    <div class="alert alert-danger" role="alert">Ошибка редактирования модального окна</div>
<?php endif; ?>

