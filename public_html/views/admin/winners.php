<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if (json_decode($winners, true)): ?>
    <?php
    $winner_prizers = json_decode($winners, true);
    ?>
    <h1 class="page-header">Победители</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Купон</th>
                <th>ФИО</th>
                <th>Почта</th>
                <th>Телефон</th>
                <th>Приз</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($winner_prizers as $winner): ?>
                <tr>
                    <td><?= $winner['code'] ?></td>
                    <td><?= $winner['name'] ?></td>
                    <td><?= $winner['email'] ?></td>
                    <td><?= $winner['phone'] ?></td>
                    <td><?= $winner['prize'] ?></td>
                    <?php if ($winner['email']): ?>
                        <td>
                            <a class="btn btn-xs btn-primary"
                               href="/admin/?view=edit_winner&winner_id=<?= $winner['id'] ?>">отправить письмо на
                                почту</a>
                        </td>
                    <?php else: ?>
                        <td></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>Победителей пока нет</p>
    <a href="/promotion" class="btn btn-sm btn-success" style="margin-bottom: 20px;">Выявить победителей</a>
<?php endif; ?>
