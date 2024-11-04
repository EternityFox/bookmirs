<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if ($coupons): ?>
    <h1 class="page-header">Купоны</h1>
    <div class="table-responsive">
        <a href="/admin/?view=add_coupon" class="btn btn-sm btn-success">Добавить купон</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Купон</th>
                <th>ФИО</th>
                <th>Почта</th>
                <th>Телефон</th>
                <th>Дата регестрации</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($coupons as $coupon): ?>
                <tr>
                    <td><?= $coupon['code'] ?></td>
                    <td><?= $coupon['name'] ?></td>
                    <td><?= $coupon['email'] ?></td>
                    <td><?= $coupon['phone'] ?></td>
                    <td><?=dateFormat($coupon['updated_at'])?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php else: ?>
    <p>Купонов пока нет</p>
    <a href="/admin/?view=add_coupon" class="btn btn-sm btn-success" style="margin-bottom: 20px;">Добавить купон</a>
<?php endif; ?>
