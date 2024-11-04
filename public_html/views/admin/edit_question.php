<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if($question):?>
    <form role="form" method="POST">
        <div class="form-group">
            <label>ФИО</label>
            <input type="text" value="<?=$question['name']?>" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label>email</label>
            <input type="text" value="<?=$question['email']?>" name="email" class="form-control">
        </div>
        <div class="form-group">
            <label>Вопрос</label>
            <textarea name="question" id="question" class="form-control" rows="2"><?=$question['question']?></textarea>
        </div>
        <div class="form-group">
            <label>Вопрос</label>
            <textarea name="question" id="question" class="form-control" rows="2"><?=$question['question']?></textarea>
        </div>
        <div class="form-group">
            <label>Ответ</label>
            <textarea name="answer" id="answer" class="form-control" rows="3"><?=$question['answer']?></textarea>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-2">
                    <label>Отобразить на сайте:</label>
                </div>
                <div class="col-sm-2">
                    <input name="active" type="checkbox" value="1" <?php if($question['active']){echo 'checked';}?>>
                </div>
            </div>
        </div>
        <input type="hidden" name="edit_question" value="1">
        <button id="question_submit" type="submit" class="btn btn-lg btn-success">Готово!</button>
    </form>

<?php else: ?>
    <div class="alert alert-danger" role="alert">Ошибка редактирования вопроса</div>
<?php endif;?>

