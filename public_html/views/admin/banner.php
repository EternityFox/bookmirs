<?php defined('IS_I_SITE') or die('Access denied'); ?>
    <form role="form" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Заголовок</label>
            <input type="text" name="title" class="form-control" placeholder="Введите заголовок" value="<?=$banner['title']?>">
        </div>
        <div class="form-group">
            <label>Ссылка</label>
            <input type="text" name="url" class="form-control" placeholder="Введите ссылку на страницу" value="<?=$banner['url']?>">
        </div>
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label>Длительность показа</label>
                    <input type="text" name="duration" class="form-control" placeholder="Кол-во секунд" value="<?=$banner['duration']?>">
                </div>
            </div>
        </div>
        <div class="form-group">
             <label>Описание</label>
            <textarea name="description" id="description" class="form-control" rows="10" cols="80"><?=$banner['description']?></textarea>
            <script type="text/javascript">CKEDITOR.replace('description');</script>
        </div>
        <div class="form-group">
            <label>Изображение</label>
            <?php if ($banner['image']) { ?>
            <div id='image_preview'>
                <img src="../media/banners/<?=$banner['id']?>.<?=$banner['image']?>?<?=rand(1, 2000)?>" class="img-thumbnail preview">
            </div>
            <?php } ?>
            <input type="file" name="image" class="form-control">
        </div>
        <?php if (isset($banner['id'])) { ?>
        <input type="hidden" name="id" value="<?=$banner['id']?>">
        <?php } ?>
        <button type="submit" class="btn btn-lg btn-success" name="save">Сохранить</button>
    </form>