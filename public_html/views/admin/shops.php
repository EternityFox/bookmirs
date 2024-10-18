<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if ($shops): ?>
    <div class="alert alert-info" role="alert">
        <h4>Список магазинов обновляется автоматически!</h4>
        <p>Все данные по магазинам обновляется автоматически из базы данных 1C:Предприятие.</p>
    </div>
    <h1 class="page-header">Магазины</h1>
    <div class="table-responsive">
        <a href="/admin/?view=add_shop" class="btn btn-sm btn-success" style="margin-bottom: 20px;">Добавить магазин</a>
        <?php $i = 0; ?>
        <?php foreach ($shops as $key => $data): ?>
            <h3 class="page-header"><?= $key ?></h3>
            <table class="table table-striped" id="smaller">
                <thead>
                <tr>
                    <th>Магазин</th>
                    <th>Адрес</th>
                    <th>Телефон</th>
                    <th>IP</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data as $shop): ?>
                    <tr <?php if (!$shop['active']) {
                        echo 'class="notin"';
                    } ?>>
                        <td>
                            <?php if (!$shop['coordinates']): ?>
                                <span class="not-active">X</span>
                            <?php endif; ?>
                            <?= $shop['name'] ?>
                            <?php if ($shop['re_name']): ?>
                                <strong>(<?= $shop['re_name'] ?>)</strong>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= $shop['adress'] ?>
                            <?php if ($shop['re_adress']): ?>
                                <strong>(<?= $shop['re_adress'] ?>)</strong>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= $shop['phone'] ?>
                            <?php if ($shop['re_phone']): ?>
                                <strong>(<?= $shop['re_phone'] ?>)</strong>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= $shop['ip_address'] ?>
                        </td>
                        <td>
                            <a class="btn btn-xs btn-primary"
                               href="/admin/?view=edit_shop&shop_id=<?= $shop['shop_id'] ?>">Редактировать</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>
    </div>

<?php else: ?>
    <p>Магазинов нет</p>
    <a href="/admin/?view=add_shop" class="btn btn-sm btn-success" style="margin-bottom: 20px;">Добавить магазин</a>
<?php endif; ?>
