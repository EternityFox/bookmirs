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
                                class="<?php if ($i == 0) echo " active"; ?>"
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
                            $work = 'Неполный рабочий день';
                        } else {
                            $work = 'Полный рабочий день';
                        }
                        ?>
                        <div class="carousel-item<?php if ($i == 0) echo " active"; ?>">
                            <div class="row g-2">
                                <p class="card-title vacancy-card-head-text text-center d-lg-none d-block"><?= $vacancy['title'] ?></p>
                                <div class="col-12 col-lg-6">
                                    <img src="<?=PRODUCTIMG?>images/<?= $vacancy['img'] ?>"
                                         class="vacacies-img"
                                         alt="Картинка вакансии">
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="card border-0">
                                        <div class="card-body p-0 p-lg-3">
                                            <p class="card-title vacancy-card-head-text text-center d-lg-block d-none"><?= $vacancy['title'] ?></p>
                                            <div class="d-flex flex-row align-items-center mt-3 justify-content-center">
                                                <img src="http://bookmirs.ru/views/test/images/money_rub.svg"
                                                     alt="Иконка денег"
                                                     width="60px" height="45px">
                                                <div class="d-flex flex-column ms-3 text-center">
                                                    <span class="news-card-body-head-text">ЗП <?= $vacancy['wage'] ?></span>
                                                    <span class="news-card-body-text"><?= $work ?></span>
                                                </div>
                                            </div>
                                            <?php
                                            if (!empty($vacancy['requirements'])) {
                                                echo '<span class="news-card-body-head-text mt-3">Требования:</span>';
                                                echo '<ul class="news-card-body-text">';
                                                echo '<li>' . $education . '</li>';
                                                echo '<li>' . $expirience . '</li>';
                                                if (count(explode('*', $vacancy['requirements'])) == 1) {
                                                    echo '<li>' . $vacancy['requirements'] . '</li>';
                                                }
                                                for ($i = 1; $i < count(explode('*', $vacancy['requirements'])); $i++) {
                                                    echo '<li>' . explode('*', $vacancy['requirements'])[$i] . '</li>';
                                                }
                                                echo '</ul>';
                                            }
                                            ?>
                                            <?php
                                            if (!empty($vacancy['responsibilities'])) {
                                                echo '<span class="news-card-body-head-text mt-3">Обязанности:</span>';
                                                echo '<ul class="news-card-body-text">';
                                                if (count(explode('*', $vacancy['responsibilities'])) == 1) {
                                                    echo '<li>' . $vacancy['responsibilities'] . '</li>';
                                                }
                                                for ($i = 1; $i < count(explode('*', $vacancy['responsibilities'])); $i++) {
                                                    echo '<li>' . explode('*', $vacancy['responsibilities'])[$i] . '</li>';
                                                }
                                                echo '</ul>';
                                            }
                                            ?>
                                            <?php
                                            if (!empty($vacancy['terms'])) {
                                                echo '<span class="news-card-body-head-text mt-3">Условия работы:</span>';
                                                echo '<ul class="news-card-body-text">';
                                                if (count(explode('*', $vacancy['terms'])) == 1) {
                                                    echo '<li>' . $vacancy['terms'] . '</li>';
                                                }
                                                for ($i = 1; $i < count(explode('*', $vacancy['terms'])); $i++) {
                                                    echo '<li>' . explode('*', $vacancy['terms'])[$i] . '</li>';
                                                }
                                                echo '</ul>';
                                            }
                                            ?>
                                            <span class="news-card-body-footer-text mt-3">Собеседование по адресу: г. Хабаровск, ул. Промышленная, 11</span>
                                            <div class="d-flex flex-row align-items-center mt-3 mb-5">
                                                <img src="http://bookmirs.ru/views/test/images/mail_phone.svg"
                                                     alt="Иконка телефона и почты" width="60px" height="45px">
                                                <div class="d-flex flex-column ms-3">
                                                    <span class="news-card-body-head-text"><?= $vacancy['phone'] ?></span>
                                                    <span class="news-card-body-text"><?= $vacancy['email'] ?></span>
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




