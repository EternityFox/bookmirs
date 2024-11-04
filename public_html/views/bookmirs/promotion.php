<style>
    .container {
        margin-top: 50px;
        text-align: center;
    }

    .container-fon {
        background-image: url('views/bookmirs/images/promotion-fon.webp'); /* Замените на путь к вашему фону */
        background-size: cover;
        background-position: bottom;
        height: 100vh; /* Высота на весь экран */
        position: relative;
        overflow: hidden;
    }

    .promotion-footer .container {
        margin-top: 0;
    }

    .promotion-background-gradient {
        background: linear-gradient(90deg, rgba(43, 70, 116, 1) 0%, rgba(64, 95, 130, 1) 17%, rgba(85, 143, 164, 1) 50%, rgba(70, 108, 140, 1) 82%, rgba(48, 75, 121, 1) 100%);
    }

    .accordion-body p {
        margin: 0;
        padding: 0;
    }


    #scrollspyPrizes, #scrollspyParticipation {
        margin-top: 0;
        padding: 80px 0;
    }

    #participationCarousel {
        width: 850px;
    }

    .promotion-next-icon {
        top: auto;
        bottom: 3.25rem;
        right: 2rem;
        border-radius: 50%;
        background: #094383;
        opacity: 1;
        width: 52px;
        height: 52px;
    }

    .promotion-navbar {
        background: #fff;
        border-radius: .625rem;
        padding: 4px 12px;
        gap: 20px;
        box-shadow: 0px 0px 6px 6px rgba(0, 0, 0, 0.2);
    }

    .promotion-logo {
        width: auto;
        height: 70px;
        margin-top: 8px;
    }

    .promotion-link {
        color: #175CA8;
        font-size: 20px;
    }

    .coin-1 {
        top: 10%;
        left: 10%;
    }

    .coin-2 {
        top: 10%;
        right: 5%;
    }

    .coin-3 {
        top: 50%;
        left: 35%;
    }

    .coin-4 {
        bottom: 5%;
        right: 2%;
    }

    .coin-5 {
        bottom: 10%;
        left: 2%;
    }

    .coin-6 {
        bottom: 10%;
        right: 50%;
    }

    .book-1 {
        top: 20%;
        right: 25%;
    }

    .book-2 {
        bottom: 10%;
        right: 20%;
    }

    .book-3 {
        top: 45%;
        left: 5%;
    }

    .stationery-1 {
        top: 20%;
        left: 50%;
    }

    .stationery-2 {
        bottom: 2%;
        left: 20%;
    }

    .stationery-3 {
        bottom: 50%;
        right: 8%;
    }

    #scrollspyQuestion {
        padding-bottom: 80px;
    }

    .promotion-header-block {
        position: absolute;
        top: 30%;
        left: 0;
        display: flex;
        flex-direction: row;
        width: 100%;
        justify-content: space-evenly;
    }

    .accordion-link {
        color: #175CA8;
    }

    .promotion-header-info {
        display: flex;
        flex-direction: column;
        width: 820px;
        gap: 16px;
    }

    .accordion-header {
        font-weight: 600;
    }

    .promotion-description {
        font-size: 28px;
        font-weight: 600;
        color: #094383;
        text-align: justify
    }

    .promotion-sender-block {
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        gap: 20px;
    }

    .promotion-button {
        display: flex;
        width: 350px;
        text-align: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 600;
        color: #ffffff;
    }

    .promotion-telegram {
        border-radius: 50%;
    }

    .promotion-telegram img {
        width: 90px;
    }

    .promotion-carousel-text img {
        width: 32px;
        margin-top: -6px;
    }

    .promotion-title {
        text-transform: uppercase;
        font-size: 60px;
        font-weight: 600;
    }


    .money-bag {
        background-size: contain;
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 2;
        pointer-events: none;
        transition: transform 0.1s ease;
        transform: translateZ(50px);
    }

    .bag__container {
        height: 400px;
        width: 350px;
        perspective: 600px;
    }


    .floating-items img {
        position: absolute;
        width: 64px;
        animation: float 6s infinite ease-in-out;
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px);
        }
        100% {
            transform: translateY(0px);
        }
    }

    .promotion-prizes-card {
        display: flex;
        flex-direction: column;
        background: linear-gradient(168.17deg, #0196BE 29.93%, #72C44B 97.43%);
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0px 0px 6px 6px rgba(0, 0, 0, 0.2);
    }

    .promotion-prizes-price {
        font-size: 3rem;
        color: #ffffff;
    }

    .promotion-prizes-description {
        font-size: 24px;
    }

    .promotion-carousel-text {
        font-size: 24px;
        font-weight: 600;
        text-align: start;
        color: #000000;
        left: 24px;
    }

    .slider-container {
        display: flex;
        justify-content: space-between;
        margin-top: 50px;
        gap: 40px;
        align-items: stretch;
    }

    .slider-container .carousel-inner {
        border-radius: 16px;
        box-shadow: 0px 0px 6px 6px rgba(0, 0, 0, 0.2);
    }

    .promotion-participation-container {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        width: 45%;
    }

    .promotion-participation-block {
        background-color: #ffffff;
        padding: 20px;
        margin-bottom: 10px;
        border-radius: 5px;
        cursor: pointer;
        position: relative;
        height: 80px;
        display: flex;
        align-items: center;
        font-size: 18px;
        justify-content: center;
        border: 2px solid #646464
    }

    .promotion-participation-number {
        background: #007bff;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        position: absolute;
        top: -10px;
        right: -10px;
        font-size: 24px;
        color: #ffffff;
    }

    .promotion-participation-block:hover, .promotion-participation-block.active {
        background-color: #cee1f5;
    }

    .promotion-shops #scrollspyAddressShops {
        color: #ffffff;
    }

    .promotion-shops .well {
        background: #ffffff;
    }

    .faq-container {
        display: flex;
        justify-content: space-between;
        margin-top: 50px;
    }

    .faq-left {
        width: 60%;
    }

    .faq-right {
        display: flex;
        width: 35%;
        height: 240px;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        flex-direction: column;
        justify-content: center;
    }

    .faq-right h5 {
        margin-bottom: 20px;
    }

    .faq-right button {
        width: 100%;
    }

    .form-checkbox {
        display: flex;
        align-items: flex-start
    }

    .form-checkbox .hidden {
        position: absolute;
        top: 0;
        left: 0;
        margin: 0;
        padding: 0;
        width: 0;
        height: 0;
        border: 0;
        outline: 0;
        -webkit-box-shadow: none;
        box-shadow: none;
        visibility: hidden;
        opacity: 0;
        poMontserrat-events: none;
        z-index: -9999;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        padding: 0;
    }

    .form-checkbox .label-dot {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -ms-flex-negative: 0;
        flex-shrink: 0;
        position: relative;
        bottom: .1875rem;
        margin: 0 .75rem 0 0;
        width: 1.5625rem;
        height: 1.5625rem;
        background: #fff;
        border: .0625rem solid #d6d6d6;
        border-radius: .5rem;
        cursor: pointer;
    }

    .form-checkbox .label-dot:after {
        content: "";
        -ms-flex-negative: 0;
        flex-shrink: 0;
        width: 53%;
        height: 100%;
        background: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTMiIGhlaWdodD0iMTAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTS45ODEgNS4xbDIuODYgMi44NmExIDEgMCAwMDEuNDE0IDBsNi43LTYuNyIgc3Ryb2tlPSIjZmZmIiBzdHJva2Utd2lkdGg9IjIiLz48L3N2Zz4=) no-repeat 50% / contain;
        opacity: 0;
    }

    .form-checkbox input:checked + .label-dot:after {
        opacity: 1;
    }

    .form-checkbox .label-text {
        margin: 0;
        font-weight: 400;
        font-size: 1rem;
        line-height: 1.1;
    }

    .form-checkbox input:checked + .label-dot {
        background: #094383;
        border-color: #094383;
    }

    .form-checkbox .label-text a {
        color: #094383;
        text-decoration: underline;
    }

    .promotion-header .navBtn {
        border: none;
        background: #094383;
        box-shadow: 0px 0px 3px 3px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 769px) {
        .container-fon {
            height: 50vh;
        }

        .promotion-header-block {
            flex-direction: row;
            top: 25%;
        }

        .promotion-header-info {
            width: 50%;
        }

        .promotion-title {
            font-size: 24px;
            text-align: center;
        }

        .promotion-logo {
            z-index: 1;
        }

        .promotion-navbar {
            box-shadow: none;
            margin-top: -15px;
        }

        .promotion-link {
            color: var(--bs-nav-link-color);
        }

        .promotion-prizes-price {
            font-size: 1.2rem;
        }

        .promotion-prizes-card {
            gap: 16px;
        }

        .bag__container {
            height: 250px;
            width: 200px;
        }


        .promotion-description {
            font-size: 14px;
        }

        .promotion-button {
            width: 90%;
        }
        .promotion-telegram img{
            width: 70px;
        }

        .floating-items img {
            width: 32px;
        }

        .coin-1 {
            top: 20%;
            left: 10%;
            right: auto;
            bottom: auto;
        }

        .coin-2 {
            top: 5%;
            right: 25%;
            bottom: auto;
            left: auto;
        }

        .coin-3 {
            top: 50%;
            left: 35%;
            right: auto;
            bottom: auto;
        }

        .coin-4 {
            bottom: 10%;
            right: 20%;
            left: auto;
            top: auto;
        }

        .coin-5 {
            bottom: 10%;
            left: 20%;
            top: auto;
            right: auto;
        }

        .coin-6 {
            top: 20%;
            right: 50%;
            bottom: auto;
            left: auto;
        }

        .book-1 {
            top: 25%;
            right: 10%;
            bottom: auto;
            left: auto;
        }

        .book-2 {
            bottom: 12%;
            right: 1%;
            top: auto;
            left: auto;
        }

        .book-3 {
            bottom: 45%;
            left: 5%;
            top: auto;
            right: auto;
        }

        .stationery-1 {
            bottom: 10%;
            left: 45%;
            top: auto;
            right: auto;
        }

        .stationery-2 {
            bottom: 12%;
            left: 1%;
            top: auto;
            right: auto;
        }

        .stationery-3 {
            bottom: 50%;
            right: 3%;
            top: auto;
            left: auto;
        }

        #scrollspyPrizes, #scrollspyParticipation, #scrollspyQuestion {
            padding: 40px 24px;
            margin-top: 0;
        }

        .promotion-shops {
            margin-top: 0;
        }

        .promotion-shops #scrollspyAddressShops {
            margin-bottom: 50px;
            margin-top: 0 !important;
        }

        .promotion-prizes-title.head-text {
            margin-bottom: 50px;
        }


        .promotion-prizes-description {
            font-size: 16px;
        }

        .slider-container {
            flex-direction: column;
            align-items: center;
        }

        #participationCarousel {
            width: 100%;
        }

        .promotion-carousel-text {
            font-size: 24px;
            left: 24px;
            width: 85%;
        }

        .carousel-caption {
            padding-bottom: 0;
            right: 0;
            bottom: 20px;
        }

        .promotion-next-icon {
            bottom: 2.25rem;
            right: 1rem;
            width: 32px;
            height: 32px;
        }

        .carousel-control-next-icon, .carousel-control-prev-icon {
            width: 1.5rem;
            height: 1.5rem;
        }

        .promotion-participation-container {
            width: 100%;
        }

        .promotion-participation-block {
            font-size: 16px;
        }

        .faq-container {
            flex-direction: column;
            gap: 24px;
        }

        .faq-left {
            width: 100%;
        }

        .faq-right {
            width: 100%;
        }

        .promotion-modal-title {
            font-size: 22px;
            margin: 12px 0
        }

        .promotion-modal-text {
            font-size: 18px;
        }
    }

    @media (max-width: 481px) {
        .container-fon {
            height: 100vh;
        }

        .promotion-background-gradient {
            background: linear-gradient(90deg, rgb(75 119 147) 0%, rgb(79 128 154) 17%, rgb(85 143 164) 50%, rgb(79 129 153) 82%, rgb(77 125 152) 100%);
        }

        .promotion-header-block {
            flex-direction: column;
            top: 15%;
            align-items: center;
            gap: 24px;
            padding: 24px;
        }

        .promotion-carousel-text {
            font-size: 16px;
            left: 15px;
            width: 250px;
        }

        .carousel-caption {
            bottom: 4px;
        }

        .promotion-prizes-card {
            gap: 0;
        }

        .promotion-header-info {
            width: 100%;
        }

        .promotion-prizes-price {
            font-size: 1.5rem;
        }

        .coin-1 {
            top: 15%;
            left: 10%;
        }

        .coin-3 {
            top: 50%;
            left: 5%;
            display: none;
        }

        .coin-4 {
            bottom: 10%;
            right: 2%;
            display: none;
        }

        .coin-5 {
            bottom: 10%;
            left: 2%;
            display: none;
        }

        .coin-6 {
            bottom: 25%;
            right: 50%;
        }

        .stationery-1 {
            top: 30%;
            left: 8%;
        }


        .stationery-3 {
            bottom: 50%;
            right: 8%;
        }


    }

</style>
<div class="promotion-background-gradient">
    <div class="container-fon">
        <div class="promotion-header-block">
            <div class="bag__container">
                <img src="views/bookmirs/images/moneys-bag.png" alt="Мешок с деньгами" class="money-bag">
            </div>
            <div class="promotion-header-info">
                <div class="promotion-title">Акция «Мешок денег за чек от 1000 рублей»</div>
                <div class="promotion-description">С 15.11.2024 по 15.12.2024 совершите покупку в наших магизнах от 1000
                    рублей, регестрируйте купон и получайте призы
                </div>
                <div class="promotion-sender-block">
                    <button class="promotion-button btn btn-blue-mirs" data-bs-toggle="modal"
                            data-bs-target="#modalViewPromotionRegistration">Зарегестрировать купон
                    </button>
                    <div class="promotion-telegram">
                        <a href="https://t.me/mirs_dv">
                            <img src="views/bookmirs/images/icon-telegram.png" alt="Иконка телеграмма">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="floating-items" id="floating-items-container">
        </div>
    </div>
    <div class="container" id="scrollspyPrizes">
        <div class="promotion-prizes row gap-3 gap-md-4">
            <h2 class="promotion-prizes-title head-text text-white">Выигрывай призы</h2>
            <div class="promotion-prizes-card col">
                <div class="promotion-prizes-price">50 000 ₽</div>
                <div class="promotion-prizes-description">Главный приз</div>
            </div>
            <div class="promotion-prizes-card col">
                <div class="promotion-prizes-price">20 000 ₽</div>
                <div class="promotion-prizes-description">3 приза</div>
            </div>
            <div class="promotion-prizes-card col">
                <div class="promotion-prizes-price">10 000 ₽</div>
                <div class="promotion-prizes-description">5 призов</div>
            </div>
            <div class="promotion-prizes-card col">
                <div class="promotion-prizes-price">5 000 ₽</div>
                <div class="promotion-prizes-description">10 призов</div>
            </div>
        </div>
    </div>
    <div class="container" id="scrollspyParticipation">
        <div class="promotion-prizes">
            <h2 class="promotion-prizes-title head-text text-white">Как принять участие в акции?</h2>
            <div class="slider-container">
                <!-- Bootstrap Carousel -->
                <div id="participationCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="views/bookmirs/images/promotion-slider-1.png" class="d-block w-100" alt="Слайд 1">
                            <div class="carousel-caption promotion-carousel-text">
                                <p>Покупайте товары в нашем магазине от 1000 ₽</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="views/bookmirs/images/promotion-slider-2.png" class="d-block w-100" alt="Слайд 2">
                            <div class="carousel-caption promotion-carousel-text">
                                <p>Получайте купон и чек на кассе</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="views/bookmirs/images/promotion-slider-3.png" class="d-block w-100" alt="Слайд 3">
                            <div class="carousel-caption promotion-carousel-text">
                                <p>Зарегистрируйте купон на сайте</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="views/bookmirs/images/promotion-slider-4.png" class="d-block w-100" alt="Слайд 4">
                            <div class="carousel-caption promotion-carousel-text">
                                <p>Победитель будет выбран 16.12.2024 в нашем телеграмм канале <a
                                            href="https://t.me/mirs_dv">
                                        <img src="views/bookmirs/images/icon-telegram.png" alt="Иконка телеграмма">
                                    </a></p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="views/bookmirs/images/promotion-slider-5.png" class="d-block w-100" alt="Слайд 5">
                            <div class="carousel-caption promotion-carousel-text">
                                <p>В случае победы, с вами связывается менеджер по телефону и email</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-next promotion-next-icon" type="button"
                            data-bs-target="#participationCarousel"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- Пронумерованные блоки -->
                <div class="promotion-participation-container">
                    <div class="promotion-participation-block active" data-slide-to="0">
                        <span class="promotion-participation-number">1</span>
                        Покупайте товары в нашем магазине от 1000 ₽
                    </div>
                    <div class="promotion-participation-block" data-slide-to="1">
                        <span class="promotion-participation-number">2</span>
                        Получайте купон и чек на кассе
                    </div>
                    <div class="promotion-participation-block" data-slide-to="2">
                        <span class="promotion-participation-number">3</span>
                        Зарегистрируйте купон на сайте
                    </div>
                    <div class="promotion-participation-block" data-slide-to="3">
                        <span class="promotion-participation-number">4</span>
                        Победитель будет выбран 16.12.2024 в нашем телеграмм канале
                    </div>
                    <div class="promotion-participation-block" data-slide-to="4">
                        <span class="promotion-participation-number">5</span>
                        В случае победы, с вами связывается менеджер по телефону и email
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container promotion-shops" id="scrollspyShops">
        <?php include 'shops.php' ?>
    </div>
    <div class="container" id="scrollspyQuestion">
        <h2 class="promotion-prizes-title head-text text-white">Вопросы и ответы</h2>
        <div class="faq-container">
            <div class="faq-left">
                <?php if ($questions): ?>
                    <div class="accordion" id="accordionExample">
                        <?php foreach ($questions as $question): ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading<?= $question['id'] ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse<?= $question['id'] ?>" aria-expanded="false"
                                            aria-controls="collapse<?= $question['id'] ?>">
                                        <?= $question['question'] ?>
                                    </button>
                                </h2>
                                <div id="collapse<?= $question['id'] ?>" class="accordion-collapse collapse"
                                     aria-labelledby="heading<?= $question['id'] ?>"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?= $question['answer'] ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Правый блок с текстом и кнопкой -->
            <div class="faq-right">
                <h5>Не нашел ответ на свой вопрос?</h5>
                <p>Задавай его нам, и мы обязательно ответим!</p>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#modalViewPromotionQuestion">Задать вопрос
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalViewPromotionQuestion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <img src="views/test/images/logo_mirs.png" alt="Логотип компании" width="150"
                     height="50"
                     class="ms-auto d-block">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-12 modal-title text-center w-100 bold-30">Задать вопрос</div>
            <div class="modal-body">
                <div id="resultMessage" class="mt-3"></div>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <form method="POST" role="form" id="sendQuestion">
                                <label for="name" class="form-label semibold-24">ФИО</label>
                                <input type="text" class="form-control form-control-lg mb-3 regular-14"
                                       id="name"
                                       name="name" placeholder="Иван Иванов Иванович">
                                <label for="email" class="form-label semibold-24">Email</label>
                                <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
                                       class="form-control form-control-lg mb-3 regular-14" id="email"
                                       name="email" placeholder="example@mail.ru" required>
                                <label for="question" class="form-label semibold-24">Вопрос</label>
                                <textarea class="form-control regular-14" id="question" style="height: 150px"
                                          required placeholder="Введите ваш вопрос"></textarea>
                                <button class="btn btn-blue-mirs text-white btn-lg my-3 mx-auto d-block"
                                        name="submit" id="btnSend"
                                        type="submit">Отправить
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalViewPromotionRegistration" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <img src="http://bookmirs.ru/views/test/images/logo_mirs.png" alt="Логотип компании" width="150"
                     height="50"
                     class="ms-auto d-block">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="col-12 modal-title text-center w-100 bold-30 promotion-modal-title">Зарегестрировать
                купон
            </div>
            <div class="modal-body">
                <div id="resultMessage" class="mt-3"></div>
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <form role="form" method="post" id="sendCoupon">
                                <label for="name"
                                       class="form-label semibold-24 promotion-modal-text">ФИО</label>
                                <input type="text" class="form-control form-control-lg mb-3 regular-14"
                                       id="name"
                                       name="name" required>
                                <label for="phone" class="form-label semibold-24">Телефон</label>
                                <input type="tel" class="form-control form-control-lg mb-3 regular-14"
                                       id="phone" name="phone" placeholder="+7(123) 456-78-90" required>
                                <label for="phone" class="form-label semibold-24">Email</label>
                                <input type="email"
                                       class="form-control form-control-lg mb-3 regular-14" id="email"
                                       name="email" placeholder="example@mail.ru">
                                <label for="coupon" class="form-label semibold-24">Купон</label>
                                <input type="text" class="form-control form-control-lg mb-3 regular-14"
                                       id="coupon"
                                       name="coupon" required>
                                <div class="form-checkboxes">
                                    <div class="form-checkbox">
                                        <input id="check-os-1" type="checkbox" class="hidden" checked>
                                        <label for="check-os-1" class="label-dot"></label>
                                        <label for="check-os-1" class="label-text">
                                            Я даю согласие на обработку<br> <a href="./personal-data.pdf"
                                                                               target="_blank">персональных
                                                данных</a></label></div>
                                </div>
                                <button class="btn btn-blue-mirs text-white btn-lg my-3 mx-auto d-block"
                                        name="submit" id="btnSend"
                                        type="submit">Отправить
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Функция для создания монет
    function createCoins(container, count) {
        for (let i = 1; i <= count; i++) {
            let coin = document.createElement('img');
            coin.src = 'views/bookmirs/images/coin.png';
            coin.alt = 'Монета';
            coin.classList.add(`coin-${i}`);
            container.appendChild(coin);
        }
    }

    // Функция для создания книг
    function createBooks(container, count) {
        for (let i = 1; i <= count; i++) {
            let book = document.createElement('img');
            book.src = 'views/bookmirs/images/book.png';
            book.alt = 'Книга';
            book.classList.add(`book-${i}`);
            container.appendChild(book);
        }
    }

    // Функция для создания канцтоваров
    function createStationery(container, count) {
        for (let i = 1; i <= count; i++) {
            let stationery = document.createElement('img');
            stationery.src = 'views/bookmirs/images/school-bag.png';
            stationery.alt = 'Канцтовары';
            stationery.classList.add(`stationery-${i}`);
            container.appendChild(stationery);
        }
    }

    // Генерация монет, книг и канцтоваров
    var container = document.getElementById('floating-items-container');
    createCoins(container, 6);
    createBooks(container, 3);
    createStationery(container, 3);

    document.querySelectorAll('.promotion-participation-block').forEach(function (block) {
        block.addEventListener('click', function () {
            $('.promotion-participation-block.active').removeClass('active');
            this.classList.add('active');
            var slideTo = this.getAttribute('data-slide-to');
            $('#participationCarousel').carousel(parseInt(slideTo));
        });
    });


    // JavaScript для 3D вращения мешка с деньгами только внутри контейнера
    var onCardOver = function (e, card, container) {
        var rect = container.getBoundingClientRect(); // Получаем границы контейнера
        var mouseX = e.clientX - rect.left; // Позиция мыши относительно контейнера
        var mouseY = e.clientY - rect.top;

        var containerWidth = container.offsetWidth;
        var containerHeight = container.offsetHeight;

        var mousePercX = Math.round((mouseX / containerWidth) * 100);
        var mousePercY = Math.round((mouseY / containerHeight) * 100);

        var subtletyModifier = 0.5;
        card.style.transform =
            'rotateY(' + (((mousePercX) - 50) * subtletyModifier) * -1 + 'deg) ' +
            'rotateX(' + ((mousePercY) - 50) * subtletyModifier + 'deg)';
    };

    (function () {
        var container = document.querySelector('.bag__container');
        var card = document.querySelector('.money-bag');

        container.addEventListener('mousemove', function (e) {
            onCardOver(e, card, container);
        });
        container.addEventListener('mouseleave', function () {
            card.style.transform = 'rotateY(0deg) rotateX(0deg)';
        });
    })();
</script>
