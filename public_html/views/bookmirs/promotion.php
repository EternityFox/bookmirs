<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php require_once 'inc/header.php' ?>
<style>
    /* Настройка контейнера для Particles.js */
    #particles-js {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: -1;
    }

    /* Стили для заголовка акции */
    .hero-section {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .hero-section h1 {
        font-size: 3rem;
        font-weight: bold;
        color: #fff;
    }
</style>
<div id="particles-js"></div>

<!-- Главный блок с заголовком акции -->
<div class="hero-section">
    <h1>Акция «Мешок денег за чек от 1000 рублей»</h1>
</div>
<div class="container mt-5">
    <h1 class="text-center">Акция «Мешок денег за чек от 1000 рублей»</h1>
    <p class="text-center">с 01.11.2024 по 30.11.2024</p>

    <section class="mt-5">
        <h2>Условия участия</h2>
        <ol>
            <li>Совершите покупку товаров на сумму от 1000 рублей в магазинах <strong>«Большой книжный»</strong>, «Пиши-Читай», «Пиши-Читай-Играй», «Плюшкин».</li>
            <li>Получите купон с номером участника у продавца-консультанта и сохраните чек.</li>
            <li>Зарегистрируйте чек и купон на сайте <strong>bookmirs.ru</strong> с 01.11.2024 по 30.11.2024.</li>
        </ol>
    </section>

    <section class="mt-5">
        <h2>Регистрация чека</h2>
        <form action="submit.php" method="post">
            <div class="form-group">
                <label for="surname">Фамилия*</label>
                <input type="text" class="form-control" id="surname" name="surname" required>
            </div>
            <div class="form-group">
                <label for="name">Имя*</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="patronymic">Отчество</label>
                <input type="text" class="form-control" id="patronymic" name="patronymic">
            </div>
            <div class="form-group">
                <label for="phone">Контактный телефон*</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="email">Адрес электронной почты</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
                <label for="check_number">№ Чека*</label>
                <input type="text" class="form-control" id="check_number" name="check_number" required>
            </div>
            <div class="form-group">
                <label for="coupon_number">№ Купона*</label>
                <input type="text" class="form-control" id="coupon_number" name="coupon_number" required>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="data_consent" name="data_consent" required>
                <label class="form-check-label" for="data_consent">
                    Согласен на обработку персональных данных
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Зарегистрировать</button>
        </form>
    </section>

    <section class="mt-5">
        <h2>Призовой фонд</h2>
        <ul>
            <li>1 приз - 50 000 рублей</li>
            <li>3 приза - по 20 000 рублей</li>
            <li>5 призов - по 10 000 рублей</li>
            <li>10 призов - по 5 000 рублей</li>
        </ul>
    </section>

    <section class="mt-5">
        <h2>Даты проведения</h2>
        <p>Регистрация чеков проводится с 01.11.2024 по 30.11.2024, розыгрыш призов состоится 01.12.2024.</p>
        <p>Победители будут определены с помощью генератора чисел в аккаунте <a href="https://t.me/mirs_dv" target="_blank">Telegram</a>.</p>
    </section>

</div>
<!-- Подключение Particles.js -->
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

<!-- Конфигурация Particles.js для эффекта конфетти -->
<script>
    particlesJS('particles-js', {
        particles: {
            number: {
                value: 100,
                density: {
                    enable: true,
                    value_area: 800
                }
            },
            color: {
                value: ['#f9d423', '#e65c00', '#9b59b6', '#3498db', '#e74c3c', '#2ecc71']
            },
            shape: {
                type: 'circle',
                stroke: {
                    width: 0,
                    color: '#000000'
                },
                polygon: {
                    nb_sides: 5
                }
            },
            opacity: {
                value: 1,
                random: false,
                anim: {
                    enable: false,
                    speed: 1,
                    opacity_min: 0.1,
                    sync: false
                }
            },
            size: {
                value: 5,
                random: true,
                anim: {
                    enable: false,
                    speed: 40,
                    size_min: 0.1,
                    sync: false
                }
            },
            line_linked: {
                enable: false
            },
            move: {
                enable: true,
                speed: 6,
                direction: 'none',
                random: false,
                straight: false,
                out_mode: 'out',
                bounce: false,
                attract: {
                    enable: false,
                    rotateX: 600,
                    rotateY: 1200
                }
            }
        },
        interactivity: {
            detect_on: 'canvas',
            events: {
                onhover: {
                    enable: true,
                    mode: 'repulse'
                },
                onclick: {
                    enable: true,
                    mode: 'push'
                },
                resize: true
            }
        },
        retina_detect: true
    });
</script>
<footer>
    <?php require_once 'inc/footer.php' ?>
</footer>
</body>
</html>