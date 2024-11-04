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
            <td>Купон</td>
            <td colspan="3">
                <div class="form-group">
                    <textarea name="code" id="code" class="form-control" rows="2"></textarea>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <input type="hidden" name="add_coupon" value="1">
    <button id="coupon_submit" type="submit" class="btn btn-lg btn-success">Сохранить!</button>
</form>
