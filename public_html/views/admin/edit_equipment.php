<?php defined('IS_I_SITE') or die('Access denied'); ?>
    <form role="form" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Заголовок</label>
            <input type="text" name="name" class="form-control" placeholder="Введите заголовок" value="<?=$equipment['name']?>">
        </div>
        <div class="form-group">
             <label>Описание</label>
            <textarea name="description" id="description" class="form-control" rows="10" cols="80"><?=$equipment['description']?></textarea>
            <script type="text/javascript">CKEDITOR.replace('description');</script>
        </div>
        <div class="form-group">
            <label>Изображение</label>
            <?php if ($equipment['image']) { ?>
            <div id='image_preview'>
                <img src="../media/equipment/<?=$equipment['id']?>.<?=$equipment['image']?>?<?=rand(1, 2000)?>" class="img-thumbnail preview">
            </div>
            <?php } ?>
            <input type="file" name="image" class="form-control">
        </div>
        <?php if (isset($equipment['id'])) { ?>
        <input type="hidden" name="id" value="<?=$equipment['id']?>">
        <?php } ?>
        <button type="submit" class="btn btn-lg btn-success" name="save">Сохранить</button>
    </form>