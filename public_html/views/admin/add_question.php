<?php defined('IS_I_SITE') or die('Access denied'); ?>
<form role="form" method="POST">
    <table class="table table-striped">
        <thead>
        <tr>
            <th></th>
            <th>Данные</th>
        </tr>
        </thead>
        <tbody>
        <tbody>
        <tr>
            <td>Вопрос</td>
            <td colspan="3">
                <div class="form-group">
                    <textarea name="question" id="question" class="form-control" rows="2"></textarea>
                </div>
            </td>
        </tr>
        <tr>
            <td>Ответ</td>
            <td colspan="3">
                <div class="form-group">
                    <textarea name="answer" id="answer" class="form-control" rows="3"></textarea>
                </div>
            </td>
        </tr>
        <tr>
            <td>Отобразить вопрос на сайте:</td>
            <td><input name="active" type="checkbox" value="1" checked></td>
        </tr>
        </tbody>
    </table>
    <input type="hidden" name="edit_question" value="1">
    <input type="hidden" name="add_question" value="1">
    <button id="question_submit" type="submit" class="btn btn-lg btn-success">Сохранить!</button>
</form>
