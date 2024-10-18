<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if ($shop): ?>
    <form role="form" method="POST">
        <table class="table table-striped">
            <thead>
            <tr>
                <th></th>
                <th>Оригинальные данные</th>
                <th width="45%">Изменённые</th>
            </tr>
            </thead>
            <tbody>
            <tbody>
            <tr>
                <td><strong>Наименование</strong></td>
                <td><?= $shop['name'] ?></td>
                <td><input type="text" name="re_name" class="form-control" value="<?= $shop['re_name'] ?>"></td>
            </tr>
            <tr>
                <td><strong>Адрес</strong></td>
                <td><?= $shop['adress'] ?></td>
                <td><input type="text" name="re_adress" class="form-control" value="<?= $shop['re_adress'] ?>"></td>
            </tr>
            <tr>
                <td><strong>IP адрес</strong></td>
                <td colspan="2"><input type="text" name="ip_address" class="form-control"
                                       value="<?= $shop['ip_address'] ?>"></td>
            </tr>
            <tr>
                <td><strong>Координаты</strong></td>
                <td><input class="form-control" name="coordinates" type="text" id="coordinate1" readonly
                           value="<?= $shop['coordinates'] ?>"></td>
                <td><input placeholder="Щелкните по карте, для изменения координат..." type="text" id="coordinate"
                           name="re_coordinates" class="form-control" value="<?= $shop['re_coordinates'] ?>"></td>
            </tr>
            <tr>
                <td>Время работы</td>
                <td colspan="2">
                    <div class="form-group">
                        <textarea name="phone" id="phone" class="form-control" rows="2"><?=$shop['phone']?></textarea>
                    </div>
                </td>
            </tr>
            <tr>
                <td>Отображать на карте:</td>
                <td colspan="2"><input name="active" type="checkbox" value="1" <?php if ($shop['active']) {
                        echo 'checked';
                    } ?>></td>
            </tr>
            </tbody>
        </table>
        <input type="hidden" name="edit_shop" value="1">
        <div style="height:500px;" id="map"></div>
        <button id="shop_submit" type="submit" class="btn btn-lg btn-success">Готово!</button>
    </form>

    <?php
    $del_char = array('г. ', 'м-н', '"');
    $ap = explode('телефон', $shop['adress']);
    $adress = explode(",", $ap[0]);
    $city = trim(str_replace($del_char, '', $adress[0]));
    $adress = trim($adress[1]) . ' ' . trim($adress[2]);

    $ep = explode('телефон', $shop['re_adress']);
    $re_adress = explode(",", $ep[0]);
    $re_city = trim(str_replace($del_char, '', $re_adress[0]));
    $re_adress = trim($re_adress[1]) . ' ' . trim($re_adress[2]);

    ?>
    <script type="text/javascript">
        ymaps.ready(init);
        var coords;

        function init() {
            var myMap = new ymaps.Map('map', {
                center: [48.492204, 135.099509],
                zoom: 9
            });
            ymaps.geocode('<?=$city?> <?=$adress?>', {
                results: 1
            }).then(function (res) {
                var firstGeoObject = res.geoObjects.get(0),
                    coords = firstGeoObject.geometry.getCoordinates(),
                    bounds = firstGeoObject.properties.get('boundedBy');
                myMap.setBounds(bounds, {
                    checkZoomRange: true
                });

                var myPlacemark = new ymaps.Placemark(coords, {
                    iconContent: 'Автоопределение',
                    balloonContent: '<?=$city?> <?=$adress?>'
                }, {
                    preset: 'islands#violetStretchyIcon',
                });
                $("#coordinate1").val(coords);
                myMap.geoObjects.add(myPlacemark);
                <?php if($shop['re_coordinates']):?>
                var myPlacemark2 = new ymaps.Placemark([<?=$shop['re_coordinates']?>], {
                    iconContent: 'Ручная установка',
                    balloonContent: '<?=$re_city?> <?=$re_adress?>'
                }, {
                    preset: 'islands#greenStretchyIcon',
                });
                myMap.geoObjects.add(myPlacemark2);
                <?php endif;?>
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
<?php else: ?>
    <div class="error">Ошибка редактирования магазина</div>
<?php endif; ?>


