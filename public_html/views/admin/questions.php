<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if ($questions): ?>
    <h1 class="page-header">Вопросы и ответы</h1>
    <div class="table-responsive">
        <a href="/admin/?view=add_question" class="btn btn-sm btn-success">Добавить вопрос</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Вопрос</th>
                <th>Ответ</th>
                <th>Кто создал?</th>
                <th>Отобразить на сайте?</th>
                <th>Дата создания</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($questions as $question): ?>
                <tr>
                    <td><?= $question['question'] ?></td>
                    <td><?= $question['answer'] ?></td>
                    <td><?php if($question['email'] == 'no-reply@bookmirs.ru'){ echo 'Администратор';}else{echo 'Пользователь';} ?></td>
                    <td><?php if($question['active'] == '1'){ echo '+';}else{echo '-';} ?></td>
                    <td><?=dateFormat($question['created_at'])?></td>
                    <td>
                        <a class="btn btn-xs btn-primary"
                           href="/admin/?view=edit_question&question_id=<?= $question['vid'] ?>">ответить на вопрос</a>
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?= $question['vid'] ?>">
                            <input type="hidden" name="delete_question" value="1">
                            <button class="btn btn-xs btn-danger" type="submit" name="delete_submit">удалить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php else: ?>
    <p>Вопросов пока нет</p>
    <a href="/admin/?view=add_question" class="btn btn-sm btn-success" style="margin-bottom: 20px;">Добавить вопрос</a>
<?php endif; ?>
