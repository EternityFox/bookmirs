<?php defined('IS_I_SITE') or die('Access denied'); ?>
<span class="head-text d-flex justify-content-center mt-5" id="scrollspyAddressShops">Адреса магазинов ООО "МИРС"</span>
<?php if ($shops): // если получены вакансии   ?>
<?php
$useragent = $_SERVER['HTTP_USER_AGENT'];
$iPod = stripos($useragent, "iPod");
$iPad = stripos($useragent, "iPad");
$iPhone = stripos($useragent, "iPhone");
$Android = stripos($useragent, "Android");
$iOS = stripos($useragent, "iOS");
$DEVICE = ($iPod || $iPad || $iPhone || $Android || $iOS);
?>
<div class="message"></div>
<div class="row">
    <div class="col-12 col-lg-6">
        <div class="row flex-row flex-nowrap flex-lg-wrap scrolling-wrapper" id="city_map">
            <?php $i = 0; ?>
            <?php foreach ($shops

            as $key => $data): ?>
            <div class="col-11 col-lg-12 mt-3">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item">
                <span class="accordion-header" id="<?= "panelsStayOpen-heading" . $i ?>">
                    <?php if ($view == 'promotion'): ?>
                        <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#<?= "panelsStayOpen-collapse" . $i ?>"
                                aria-expanded="false"
                                aria-controls="<?= "panelsStayOpen-collapse" . $i ?>">
                        <span class="accordion-header-text">
                            <?= $key ?>
                        </span>
                    </button>
                    <?php else: ?>
                        <button class="accordion-button<?php if ($i != 0 || $DEVICE) echo " collapsed" ?>" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#<?= "panelsStayOpen-collapse" . $i ?>"
                                aria-expanded="<?php if ($i != 0 || !$DEVICE) echo "false"; else echo "true"; ?>"
                                aria-controls="<?= "panelsStayOpen-collapse" . $i ?>">
                        <span class="accordion-header-text">
                            <?= $key ?>
                        </span>
                    </button>
                    <?php endif; ?>

                </span>
                        <?php if ($view == 'promotion'): ?>
                        <div id="<?= "panelsStayOpen-collapse" . $i ?>"
                             class="accordion-collapse collapse"
                             aria-labelledby="<?= "panelsStayOpen-heading" . $i ?>">
                            <?php else: ?>
                            <div id="<?= "panelsStayOpen-collapse" . $i ?>"
                                 class="accordion-collapse collapse<?php if ($i == 0 && !$DEVICE) echo " show" ?>"
                                 aria-labelledby="<?= "panelsStayOpen-heading" . $i ?>">
                                <?php endif; ?>
                                <div class="accordion-body">
                                    <table class="w-100">
                                        <thead class="accordion-table-thead semibold-18 text-center">
                                        <tr>
                                            <th>Магазин</th>
                                            <th>Адрес</th>
                                            <th>Время работы</th>
                                        </tr>
                                        </thead>
                                        <tbody class="accordion-table-tbody">
                                        <?php foreach ($data as $shop): ?>
                                            <tr id="shop<?= $i ?>"
                                                class="accordion-table-tr regular-14 text-center"
                                                onclick="changeMap('<?= $key ?> <?= $shop['adress'] ?>', '<?= $shop['name'] ?>','shop<?= $i ?>')">
                                                <td class="accordion-table-td">
                                                    <span><?= $shop['name'] ?></span>
                                                </td>
                                                <td class="accordion-table-td">
                                                    <span><?= $shop['adress'] ?></span>
                                                </td>
                                                <td class="accordion-table-td">
                                                    <span><?= $shop['phone'] ?></span>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div id="map-adress" class="col-12 col-lg-6 mt-3">
            <aside>
                <div class="card text-white text-center border-primary">
                    <div class="card-header bg-primary map-header-text p-2"><strong>ООО "МИРС"</strong> - Промышленная
                        д.11
                    </div>
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
                <div class="well text-center mt-2">
                    <h4 class="pt-2">ООО "МИРС"</h4>
                    <p>Адрес: 680000 г. Хабаровск, ул. Промышленная, 11</p>
                    <p class="pb-4">Телефон: (4212) 47-00-47</p>
                </div>
            </aside>
        </div>
    </div>
    <?php else: ?>
        <p>Извините, на данный момент в компании нет открытых вакансий</p>
    <?php endif; ?>
    <script type="text/javascript">
        ymaps.ready(init);
        var myMap;

        function changeMap(adress, name, shop_id) {
            $(".bolded").removeClass("bolded");
            $("#" + shop_id).addClass("bolded");
            $('.panel-heading').html('<strong>' + name + '</strong> - ' + adress);

            if (myMap) {
                myMap.destroy(); // Деструктор карты
                myMap = null;
            }
            myMap = new ymaps.Map('map', {
                center: [48.492204, 135.099509],
                zoom: 9
            });

            ymaps.geocode(adress, {
                results: 1
            }).then(function (res) {
                var firstGeoObject = res.geoObjects.get(0),
                    coords = firstGeoObject.geometry.getCoordinates(),
                    bounds = firstGeoObject.properties.get('boundedBy');
//myMap.geoObjects.add(firstGeoObject);
                myMap.setBounds(bounds, {
                    checkZoomRange: true
                });


                var myPlacemark = new ymaps.Placemark(coords, {
                    iconCaption: name,
                    balloonContent: adress
                }, {
                    preset: 'islands#icon',
                    iconColor: '#EF7F1A'
                });

                myMap.geoObjects.add(myPlacemark);
            });
        }

        function init() {
            myMap = new ymaps.Map('map', {
                center: [48.492204, 135.099509],
                zoom: 9
            });

            ymaps.geocode('г. Хабаровск, ул. Промышленная 11', {
                results: 1
            }).then(function (res) {
                var firstGeoObject = res.geoObjects.get(0),
                    coords = firstGeoObject.geometry.getCoordinates(),
                    bounds = firstGeoObject.properties.get('boundedBy');
//myMap.geoObjects.add(firstGeoObject);
                myMap.setBounds(bounds, {
                    checkZoomRange: true
                });


                var myPlacemark = new ymaps.Placemark(coords, {
                    iconCaption: 'ООО МИРС',
                    balloonContent: 'г. Хабаровск, ул. Промышленная 11'
                }, {
                    preset: 'islands#icon',
                    iconColor: '#EF7F1A'
                });

                myMap.geoObjects.add(myPlacemark);
            });
        }

    </script>