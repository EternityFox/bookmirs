<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if (json_decode($winner, true)): ?>
    <?php
    $winner_prizer = json_decode($winner, true);
    ?>
    <form role="form" method="POST">
        <div class="form-group">
            <label>Купон</label>
            <input type="text" value="<?= $winner_prizer['code'] ?>" name="code" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>ФИО</label>
            <input type="text" value="<?= $winner_prizer['name'] ?>" name="name" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Почта</label>
            <input type="text" value="<?= $winner_prizer['email'] ?>" name="email" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Телефон</label>
            <input type="text" value="<?= $winner_prizer['phone'] ?>" name="phone" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Приз</label>
            <input type="text" value="<?= $winner_prizer['prize'] ?>" name="priz" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Тема для собщения на почту</label>
            <textarea name="subject" id="subject" class="form-control" rows="3">Поздравляем с победой в розыгрыше!!! 🎉</textarea>
        </div>
        <div class="form-group">
            <label>Сообщения для почты (можно своё написать)</label>
            <textarea name="message" id="message" class="form-control" rows="3"><?= $winner_prizer['message'] ?></textarea>
        </div>
        <input type="hidden" name="edit_winner" value="1">
        <button id="winner_submit" type="submit" class="btn btn-lg btn-success">Отправить сообщения на почту</button>
    </form>

<?php else: ?>
    <div class="alert alert-danger" role="alert">Ошибка отправки письма</div>
<?php endif; ?>

