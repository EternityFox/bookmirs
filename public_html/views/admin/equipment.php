<?php defined('IS_I_SITE') or die('Access denied'); ?>
<h1 class="page-header">Оборудование</h1>
<?=pagination(isset($_GET['page']) ? $_GET['page'] : 1, $equipment['count'])?>
<div class="table-responsive">
    <a href="/admin/?view=edit_equipment" class="btn btn-sm btn-success">Добавить оборудование</a>
    <table class="table table-striped" id="import-log">
    <thead><tr><th>ID</th><th>Название</th><th></th></tr></thead>
    <tbody>
        <?php foreach ($equipment['items'] as $item) { ?>
        <tr>
            <td><?=$item['id']?></td>
            <td><?=$item['name']?></td>
            <td>
                <a class="btn btn-xs btn-primary" href="/admin/?view=edit_equipment&id=<?=$item['id']?>">Изменить</a>
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