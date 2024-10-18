<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if ($vacancies): // если получены вакансии  ?>
    <div class="container-fluid">
        <div class="container">
            <span class="head-text d-flex justify-content-center mt-5" id="scrollspyVacancys">Актуальные вакансии ООО "МИРС"</span>
        </div>
        <div id="carouselVacancies" class="carousel slide carousel-dark" data-bs-ride="true">
            <div class="container">
                <div class="carousel-indicators">
                    <?php $i = 0; ?>
                    <?php foreach ($vacancies as $vacancy): ?>
                        <button type="button" data-bs-target="#carouselVacancies" data-bs-slide-to="<?= $i ?>"
                                class="btn-vacancies<?php if ($i == 0) echo " active"; ?>"
                                aria-current="true" aria-label="Slide <?= $i ?>"></button>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </div>
                <div class="carousel-inner">
                    <?php $i = 0; ?>
                    <?php foreach ($vacancies as $vacancy): ?>
                        <?php
                        if ($vacancy['expirience']) {
                            $expirience = $vacancy['expirience'];
                        } else {
                            $expirience = "Можно без опыта работы";
                        }
                        if ($vacancy['sex'] == 1) {
                            $sex = 'женский';
                        } elseif ($vacancy['sex'] == 2) {
                            $sex = 'мужской';
                        } else {
                            $sex = 'не имеет значения';
                        }

                        if ($vacancy['education'] == 1) {
                            $education = 'Образование: высшее';
                        } elseif ($vacancy['education'] == 2) {
                            $education = 'Образование: неполное высшее';
                        } elseif ($vacancy['education'] == 3) {
                            $education = 'Образование: средне-специальное';
                        } else {
                            $education = 'Образование: не имеет значения';
                        }

                        if ($vacancy['work'] == 2) {
                            $work = 'Неполный';
                        } else {
                            $work = 'Полный';
                        }
                        ?>
                        <div class="carousel-item<?php if ($i == 0) echo " active"; ?>">
                            <div class="row g-2">
                                <p class="card-title vacancy-card-head-text text-center d-lg-none d-block"><?= $vacancy['title'] ?></p>
                                <div class="col-12 col-lg-6">
                                    <img src="http://bookmirs.ru/views/test/images/<?= $vacancy['img'] ?>" class="vacacies-img"
                                         alt="Картинка вакансии">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="card border-0">
                                        <div class="card-body p-0 p-lg-3">
                                            <p class="card-title vacancy-card-head-text text-center d-lg-block d-none"><?= $vacancy['title'] ?></p>
                                            <div class="d-flex flex-row align-items-center mt-3 justify-content-lg-start justify-content-center">
                                                <img src="http://bookmirs.ru/views/test/images/money_rub.svg" alt="Иконка денег"
                                                     width="60px" height="45px">
                                                <div class="d-flex flex-column ms-3 text-center">
                                                    <span class="news-card-body-head-text">ЗП <?= $vacancy['wage'] ?> руб.</span>
                                                    <span class="news-card-body-text"><?= $work ?> рабочий день</span>
                                                </div>
                                            </div>
                                            <span class="news-card-body-head-text mt-3">Требования:</span>
                                            <ul class="news-card-body-text">
                                                <li><?= $education ?></li>
                                                <li><?= $expirience ?></li>
                                                <li><?= $vacancy['requirements'] ?></li>
                                            </ul>
                                            <span class="news-card-body-head-text mt-3">Условия работы:</span>
                                            <ul class="news-card-body-text">
                                                <li>Вce социальные гарантии (оформление по ТК РФ)</li>
                                                <li>Доставка транспортом фирмы от ост. "Большая" и "Автопарк"</li>
                                                <?php if ($vacancy['terms']) echo '<li>' . $vacancy['terms'] . '</li>' ?>
                                            </ul>
                                            <span class="news-card-body-footer-text mt-3">Собеседование по адресу: г. Хабаровск, ул. Промышленная, 11</span>
                                            <div class="d-flex flex-row align-items-center mt-3 mb-5">
                                                <img src="http://bookmirs.ru/views/test/images/mail_phone.svg"
                                                     alt="Иконка телефона и почты" width="60px" height="45px">
                                                <div class="d-flex flex-column ms-3">
                                                    <span class="news-card-body-head-text">+7 (924) 100-50-52</span>
                                                    <span class="news-card-body-text">manager@bookmirs.ru!</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <button class="carousel-control-prev d-none d-lg-block" type="button" data-bs-target="#carouselVacancies"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next d-none d-lg-block" type="button" data-bs-target="#carouselVacancies"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>


<?php else: ?>
    <p>Извините, на данный момент в компании нет открытых вакансий</p>
<?php endif; ?>

<!--
<div class="box-content">
    <?php if ($vacancies): // если получены вакансии                        ?>
    <div class="message"></div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Вакансия</th>
            <th>Город</th>
            <th>Дата добавления</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($vacancies as $vacancy): ?>
            <tr>
                <td><a href="?view=vacancy&vacancy_id=<?= $vacancy['vacancy_id'] ?>"
                       title="<?= $vacancy['title'] ?> в городе <?= $vacancy['city'] ?>"><?= $vacancy['title'] ?></a>
                </td>
                <td><?= $vacancy['city'] ?></td>
                <td><?= date("d.m.Y", strtotime($vacancy['add_date'])) ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="well">
        <p>Вce социальные гарантии (оформление по ТК РФ).</p>
        <p>Доставка транспортом фирмы от ост. "Большая" и "Автопарк".</p>
        <p>Собеседование по адресу: <a href="#" data-toggle="modal" data-target="#myModal">г. Хабаровск, ул.
                Промышленная, 11</a> (ост. "Большая", "Автопарк") тел. (4212) 47-00-47 доб.341 (с 09-00 до 18-00)
            или
            8-924-100-5052 </p>
        <p>Будем Вам признательны за предварительный звонок по телефону и отправленное резюме по электронной почте
            hr-manager@bookmirs.ru!
    </div>
    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true"
         style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">г. Хабаровск Промышленная 11</h4>
                </div>
                <div class="modal-body">
                    <div id="map"
                    ">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>-->
        <!-- /.modal-content --> <!--
    </div>
</div>
    <script type="text/javascript">
        ymaps.ready(init);
        var myMap;

        function init() {
            myMap = new ymaps.Map('map', {
                center: [48.492204, 135.099509],
                zoom: 9
            });

            // Поиск координат центра Нижнего Новгорода.
            ymaps.geocode('г. Хабаровск, ул. Промышленная, 11', {
                results: 1
            }).then(function (res) {
                var firstGeoObject = res.geoObjects.get(0),
                    coords = firstGeoObject.geometry.getCoordinates(),
                    bounds = firstGeoObject.properties.get('boundedBy');
                myMap.setBounds(bounds, {
                    checkZoomRange: true
                });


                var myPlacemark = new ymaps.Placemark(coords, {
                    iconContent: 'ООО МИРС',
                    balloonContent: 'г. Хабаровск, ул. Промышленная, 11'
                }, {
                    preset: 'islands#violetStretchyIcon'
                });

                myMap.geoObjects.add(myPlacemark);
            });
        }
    </script>
<?php else: ?>
    <p>Извините, на данный момент в компании нет открытых вакансий</p>
<?php endif; ?>
</div>
-->




