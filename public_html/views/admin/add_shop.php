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
            <td><strong>Наименование</strong></td>
            <td><input type="text" name="name" class="form-control"></td>
        </tr>
        <tr>
            <td><strong>Адрес</strong></td>
            <td><input type="text" name="adress" class="form-control"></td>
        </tr>
        <tr>
            <td><strong>IP адрес</strong></td>
            <td><input type="text" name="ip_address" class="form-control"></td>
        </tr>
        <tr>
            <td><strong>Координаты</strong></td>
            <td><input placeholder="Щелкните по карте, для изменения координат..." type="text" id="coordinate"
                       name="coordinates" class="form-control"></td>
        </tr>
        <tr>
            <td>Время работы</td>
            <td colspan="2">
                <div class="form-group">
                    <textarea name="phone" id="phone" class="form-control" rows="2"></textarea>
                </div>
            </td>
        </tr>
        <tr>
            <td>Отображать на карте:</td>
            <td><input name="active" type="checkbox" value="1" checked></td>
        </tr>
        </tbody>
    </table>
    <input type="hidden" name="edit_shop" value="1">
    <input type="hidden" name="add_shop" value="1">
    <div style="height:500px;" id="map"></div>
    <button id="shop_submit" type="submit" class="btn btn-lg btn-success">Сохранить!</button>
</form>

<script type="text/javascript">
    ymaps.ready(init);
    var coords;

    function init() {
        var myMap = new ymaps.Map('map', {
            center: [48.492204, 135.099509],
            zoom: 9
        });
        myMap.events.add('click', function (e) {
            if (!myMap.balloon.isOpen()) {
                var coords = e.get('coords');
                myMap.balloon.open(coords, {
                    contentHeader: 'Изменение координат',
                    contentBody: '<p>Вы точно уверены, что магазин здесь?</p>' +
                        '<p>Тогда его координаты: ' + [
                            coords[0].toPrecision(6),
                            coords[1].toPrecision(6)
                        ].join(', ') + '</p><div><button type="button" onclick="getCoords(' + [coords[0], coords[1]].join(', ') + ');" class="btn btn-xs btn-primary">Да!</button></div>',
                    contentFooter: '<sup>Щелкните еще раз</sup>'
                });
            } else {
                myMap.balloon.close(coords[0]);
            }


        });
    }

</script>

<script>
    function getCoords(coordsX, coordsY) {
        $("#coordinate").val([coordsX, coordsY].join(', '));
    }
</script>
