<?php defined('IS_I_SITE') or die('Access denied'); ?>
<h1 class="page-header">Баннеры</h1>
<?=pagination(isset($_GET['page']) ? $_GET['page'] : 1, $banners['count'])?>
<div class="table-responsive">
    <a href="/admin/?view=banner" class="btn btn-sm btn-success">Добавить баннер</a>
    <table class="table table-striped" id="import-log">
    <thead><tr><th style="width: 200px;"></th><th>ID</th><th>Название</th><th style="width: 100px;">Длительность</th><th style="width: 200px;"></th></tr></thead>
    <tbody>
        <?php foreach ($banners['items'] as $item) { ?>
        <tr>
            <td><img src="/media/banners/<?=$item['id']?>.<?=$item['image']?>" style="max-width: 200px; max-height: 200px"></td>
            <td><?=$item['id']?></td>
            <td><?=$item['title']?></td>
            <td><?=$item['duration']?> сек.</td>
            <td>
                <a class="btn btn-xs btn-primary" href="/admin/?view=banner&id=<?=$item['id']?>">Изменить</a>
                <form method="POST" action="">
                    <input type="hidden" name="id" value="<?=$item['id']?>">
                    <input type="hidden" name="delete" value="1">
                    <button class="btn btn-xs btn-danger" type="submit">Удалить</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
</div>