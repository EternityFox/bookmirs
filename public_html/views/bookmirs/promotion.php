<style>
    .promotion-link:hover, .promotion-link:focus, .promotion-link:active, .promotion-link.active {
        color: #ef7f1a !important;
    }

    .winner-prize-title {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .winner-prize-title p {
        font-size: 24px;
    }

    .winner-item {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 10px;
        font-size: 18px;
        margin-bottom: 8px;
    }

    #summaryContent {
        max-height: 300px;
        overflow: hidden;
        transition: max-height 0.5s ease;
    }


    .modal-dialog.modal-promo {
        position: relative;
        min-width: 800px;
    }

    .close-modal-promo {
        position: absolute;
        top: 15px;
        z-index: 10;
        right: 16px;
    }

    #promoModal {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .close-modal-promo .btn-close {
        width: 3em;
        height: 3em;
        background-size: 50% 50%;
        opacity: 0.7;
        filter: invert(1);
    }

    .modal-wins-img {
        position: absolute;
        top: 20px;
    }

    .modal-wins-img img {
        width: 1200px;
    }

    .modal-content.modal-content-promo {
        background: transparent;
        box-shadow: none;
        border: none;
        align-items: center;
    }

    .carousel-item-text h3 {
        font-size: 30px;
        margin: 0;
        padding: 0;
    }

    .carousel-item-text {
        text-align: center;
        background: #ffffff;
        width: 475px;
        padding: 16px;
        border: 5px solid transparent;
        border-image: radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        -moz-border-image: -moz-radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        -webkit-border-image: -webkit-radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        border-image-slice: 1;
    }

    .promo-win-block:after {
        content: '';
        position: absolute;
        height: 40px;
        top: -45px;
        right: 25%;
        background: #ef7f1a;
        border: 1px solid transparent;
        border-image: radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        -moz-border-image: -moz-radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        -webkit-border-image: -webkit-radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        border-image-slice: 1;
    }

    .promo-win-block:before {
        content: '';
        position: absolute;
        top: -45px;
        left: 25%;
        height: 40px;
        background: #ef7f1a;
        border: 1px solid transparent;
        border-image: radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        -moz-border-image: -moz-radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        -webkit-border-image: -webkit-radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        border-image-slice: 1;
    }

    .promo-win-block {
        background: #ffffff;
        position: relative;
        padding: 24px;
        margin-top: 16px;
        width: 600px;
        border: 5px solid transparent;
        border-image: radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        -moz-border-image: -moz-radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        -webkit-border-image: -webkit-radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        border-image-slice: 1;
    }

    .promo-win-btn {
        color: #ffffff;
        margin: 40px auto 0;
        display: flex;
        width: 300px;
        font-size: 20px;
        text-align: center;
        justify-content: center;
    }

    .carousel-control-promo {
        opacity: 0.7;
    }

    .carousel-control-promo .carousel-control-prev-icon, .carousel-control-promo .carousel-control-next-icon {
        width: 3rem;
        height: 3rem;
        border: 4px solid #ef7f1a;
        border-radius: 50%;
        background-size: 80% 80%;
    }

    .carousel-control-promo .carousel-control-prev-icon {
        background-position: 25%;
    }

    .carousel-control-promo .carousel-control-next-icon {
        background-position: 50%;
    }

    .digits {
        display: flex;
        justify-content: center;
        font-size: 36px;
        margin: 20px 0;
    }

    .digit {
        width: 30px;
        height: 50px;
        overflow: hidden;
        position: relative;
        text-align: center;
        border: 1px solid #444;
        background: #ef7f1a;
        color: #fff;
        margin: 0 5px;
        border-radius: 5px;
    }

    .digit .numbers {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
    }

    .digit .numbers span {
        display: block;
        height: 50px;
        line-height: 50px;
    }

    /* Начальные стили для блока победителя */
    .winner {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(1);
        border: 5px solid transparent;
        border-image: radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        -moz-border-image: -moz-radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        -webkit-border-image: -webkit-radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        border-image-slice: 1;
        background: #fff;
        padding: 20px;
        opacity: 0;
        transition: transform 0.5s ease, opacity 0.5s ease;
        z-index: 999;
    }

    /* Появление блока победителя */
    .winner.show {
        opacity: 1;
        transform: translate(-50%, -50%) scale(3); /* Увеличение блока */
    }

    /* Переход блока к списку победителей */
    .winner.to-list {
        position: absolute;
        transform: translate(0, 0) scale(1);
        top: 40%;
        right: 5%;
        transition: transform 1s ease, opacity 0.5s ease;
        z-index: 0;
        opacity: 0;
    }


    .modal-content {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    #winnerList.hide {
        opacity: 0;
    }

    #winnerList.show {
        opacity: 1;
    }

    #winnerList {
        position: absolute;
        top: 30%;
        right: 5%;
        background: #ffffff;
        padding: 24px;
        margin-top: 16px;
        width: 350px;
        border: 5px solid transparent;
        border-image: radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        -moz-border-image: -moz-radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        -webkit-border-image: -webkit-radial-gradient(circle, rgba(239, 127, 26, 1) 0%, rgba(255, 255, 255, 1) 50%, rgba(239, 127, 26, 1) 100%);
        border-image-slice: 1;
        transition: opacity 0.5s ease;
        display: flex;
        flex-direction: column;
        gap: 12px;
        font-size: 16px;
        font-weight: 600;
    }

    .wins-list {
        text-align: center;
        margin-bottom: 12px;
        font-size: 18px;
    }

    .winnerList .win-item {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .winnerList .win-item span {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
        display: inline-block;
    }

    #draw:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    #draw:enabled {
        background-color: #007bff;
    }

    /* Общий стиль */
    .promo-wrapper {
        display: flex;
        flex-direction: row;
        margin: 20px auto;
        padding: 20px;
        gap: 20px;
        background: #f5f5f5;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        animation: fadeIn 1s ease-in-out;
    }

    .telegram-button {
        display: inline-block;
        padding: 10px 20px;
        background: linear-gradient(92.04deg, #084D99 4.31%, #195EAA 94.63%);
        box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.27), -4px -4px 12px rgba(255, 255, 255, 0.24);
        border-radius: 10px;
        color: #fff;
        text-decoration: none;
        font-weight: bold;
        text-align: center;
        transition: background 0.3s ease-in-out;
    }

    .telegram-button:hover {
        animation: pulse 1s;
        box-shadow: 0 0 0 2em transparent;
        color: #000000;
    }

    .info-card-title {
        font-size: 18px;
        font-weight: 600;
    }

    .info-card {
        background: linear-gradient(145deg, #f0f0f0, #fafafa);
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        animation: scaleUp 0.5s ease-in-out;
    }

    .info-card-items {
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 16px;
        align-items: flex-start;
    }

    .info-card-item {
        position: relative;
        display: flex;
        flex-direction: row;
        gap: 10px;
        align-items: center;
    }

    .info-card-item .info-card-item-number {
        background: #175CA8;
        border-radius: 50%;
        font-size: 18px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        min-width: 30px;
        color: #ffffff;
        max-width: 30px;
    }

    .info-card-item-text {
        text-align: left;
    }

    .info-card-description {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 8px;
        justify-content: center;
    }

    /* Заголовки */
    .promo-participants-title {
        font-size: 1.6rem;
        color: #333;
        text-align: center;
        margin-bottom: 15px;
        font-weight: 600;
    }

    /* Поле поиска */
    .search-person-container {
        width: 100%;
        margin: 20px 0;
        text-align: center;
    }

    #searchInput, #searchCouponInput {
        width: 100%;
        text-align: center;
        max-width: 350px;
        padding: 10px;
        font-size: 1rem;
        border: 1px solid #ddd;
        border-radius: 30px;
        background: #fff;
        transition: box-shadow 0.3s ease, transform 0.2s ease;
    }

    .promo-table-container {
        overflow-x: auto;
    }

    .promo-table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .promo-table th, .promo-table td {
        padding: 10px;
        text-align: center;
        border: 1px solid #eee;
    }

    .promo-table th {
        background: #175CA8;
        color: #fff;
        font-weight: bold;
    }

    .promo-table tbody tr:nth-child(even) {
        background: #f9f9f9;
    }

    .promo-table tbody tr:hover {
        background: #f1f7fd;
    }

    #searchInput:focus {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transform: scale(1.05);
    }

    /* Участники */
    .promo-participants {
        width: 60%;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .promo-info {
        width: 40%;
        position: sticky;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .participant-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
        animation: slideIn 0.5s ease-in-out;
    }

    .participant-row:last-child {
        border-bottom: none;
    }

    .participant-number {
        font-weight: bold;
        color: #555;
        width: 40px;
    }

    .participant-name {
        flex: 1;
        text-align: left;
        color: #333;
        font-size: 1rem;
    }

    .participant-chance {
        width: 100%;
        max-width: 200px;
    }

    /* Прогресс-бар */
    .progress-bar-container {
        width: 100%;
        background: #eee;
        border-radius: 5px;
        position: relative;
        height: 30px;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(168.17deg, #0196BE 29.93%, #72C44B 97.43%);
        color: #fff;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
    }

    .progress-text {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        font-weight: bold;
        color: #686767;
    }

    /* Кнопка "Показать ещё" */
    .load-more-button {
        margin: 20px auto;
        background: linear-gradient(92.04deg, #084D99 4.31%, #195EAA 94.63%);
        box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.27), -4px -4px 12px rgba(255, 255, 255, 0.24);
        padding: 10px 24px;
        font-size: 1rem;
        color: #fff;
        border: none;
        border-radius: 30px;
        cursor: pointer;
        text-align: center;
        transition: background 0.3s ease, transform 0.2s ease;
    }

    .load-more-button:hover {
        transform: scale(1.05);
    }

    /* Анимации */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideIn {
        from {
            transform: translateX(-20px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes grow {
        from {
            width: 0;
        }
        to {
            width: var(--width);
        }
    }

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

    .promotion-info-block {
        padding-bottom: 40px;
    }

    .promotion-info-block .promotion-info-link {
        font-size: 24px;
        color: #ffffff;
        text-decoration: none;
    }

    .promotion-info-block .promotion-info-text {
        font-size: 14px;
        color: #ffffff;
        padding: 20px 0;
        text-align: center;
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
        margin-top: 4px;
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
        text-align: center;
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
        white-space: nowrap;
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
        justify-content: center;
        width: 45%;
        gap: 16px;
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
        background: #175CA8;
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
        .promotion-info-block .promotion-info-text {
            font-size: 12px;
            padding: 20px 12px;
            text-align: justify;
        }

        .promo-wrapper {
            flex-direction: column;
        }

        .promo-participants, .promo-info {
            width: 100%;
        }

        .container-fon {
            height: 50vh;
        }

        .count-coupons {
            display: none;
        }

        .promo-info h3 {
            font-size: 30px;
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
            height: 50px;
            margin-top: 0;
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

        .promotion-telegram img {
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
                <div class="promotion-title">Акция «Мешочек денег»</div>
                <div class="promotion-description">С 15.11.2024 по 15.12.2024 совершите покупку в наших магазинах от
                    1000
                    рублей, регистрируйте купон и получайте призы
                </div>
                <div class="promotion-sender-block">
                    <button class="promotion-button btn btn-blue-mirs" data-bs-toggle="modal"
                            data-bs-target="#modalViewPromotionRegistration">Зарегистрировать купон
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
    <?php if ($_SESSION['auth']['role'] == 7): ?>
        <div class="modal show" tabindex="-1"
             style="background: rgba(0, 0, 0, 0.8);" id="promoModal">
            <div class="modal-header close-modal-promo border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-wins-img">
                <img src="views/bookmirs/images/wins.png" alt="Лента с деньгами и кубком">
            </div>
            <button class="carousel-control-prev carousel-control-promo" type="button" data-bs-target="#prizeCarousel"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Предыдущий</span>
            </button>
            <button class="carousel-control-next carousel-control-promo" type="button" data-bs-target="#prizeCarousel"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Следующий</span>
            </button>
            <div id="winnerList" class="hide">
            </div>
            <div class="winner" id="winner"></div>
            <div class="modal-dialog modal-promo">
                <div class="modal-content modal-content-promo">
                    <div id="prizeCarousel" class="carousel slide my-4 carousel-dark carousel-promo"
                         data-bs-ride="false">
                        <div class="carousel-inner">
                            <!-- Призы в порядке возрастания -->
                            <div class="carousel-item active carousel-item-promo" data-prize-index="0">
                                <div class="carousel-item-text"><h3>Приз на 5 000 ₽</h3></div>
                            </div>
                            <div class="carousel-item carousel-item-promo" data-prize-index="1">
                                <div class="carousel-item-text"><h3>Приз на 10 000 ₽</h3></div>
                            </div>
                            <div class="carousel-item carousel-item-promo" data-prize-index="2">
                                <div class="carousel-item-text"><h3>Приз на 20 000 ₽</h3></div>
                            </div>
                            <div class="carousel-item carousel-item-promo" data-prize-index="3">
                                <div class="carousel-item-text"><h3>Главный приз на 50 000 ₽</h3></div>
                            </div>
                        </div>
                    </div>
                    <div class="promo-win-block">
                        <div class="digits" id="digits">
                            <?php for ($i = 0; $i < 10; $i++): ?>
                                <div class="digit">
                                    <div class="numbers">
                                        <?php for ($j = 0; $j < 10; $j++): ?>
                                            <span><?= $j ?></span>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                        <button class="btn promo-win-btn btn-blue-mirs" id="draw">Выявить победителя</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.querySelector('.close-modal-promo').addEventListener('click', function () {
                const modal = document.getElementById('promoModal');
                modal.classList.remove('show'); // Hide the modal
                modal.style.display = 'none'; // Optional: hide modal from layout
            });
            let prizeWinners = {0: [], 1: [], 2: [], 3: []};
            let prizeRemaining = {0: 10, 1: 5, 2: 3, 3: 1};
            const drawButton = document.getElementById('draw');
            let activeSlide = document.querySelector('.carousel-item.active');
            let prizeIndex = activeSlide.getAttribute('data-prize-index');
            document.getElementById('draw').addEventListener('click', async () => {
                // Блокируем кнопку, чтобы избежать повторных нажатий
                drawButton.disabled = true;

                // Блокируем переключение слайдов
                const prevButton = document.querySelector('.carousel-control-prev');
                const nextButton = document.querySelector('.carousel-control-next');
                prevButton.disabled = true;
                nextButton.disabled = true;
                // Имитируем запрос на сервер
                const response = await fetch('/functions/ajax_calculate_win.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({prizeIndex})
                });
                const data = await response.json();
                const winnerCode = data.code;

                const digits = document.querySelectorAll('.digit .numbers');
                const winnerBlock = document.getElementById('winner');

                // Сбрасываем барабаны
                digits.forEach(numbers => {
                    numbers.style.transition = 'none'; // Отключаем transition
                    numbers.style.transform = 'translateY(0)';

                    // Включаем transition обратно
                    setTimeout(() => {
                        numbers.style.transition = 'transform 4.5s cubic-bezier(0.68, -0.55, 0.27, 1.55)';
                    }, 50);
                });

                // Добавляем задержку перед началом анимации вращения
                setTimeout(() => {
                    [...winnerCode].forEach((targetDigit, index) => {
                        setTimeout(() => {
                            const numbersElement = digits[index];
                            if (!numbersElement) return;
                            const spins = Math.floor(Math.random() * 5) + 5; // Полные обороты
                            const targetPosition = targetDigit * 50; // Позиция целевой цифры
                            const totalHeight = spins * 500 + targetPosition; // Общая высота прокрутки
                            const adjustedHeight = totalHeight % 500; // Корректируем высоту
                            numbersElement.style.transform = `translateY(-${adjustedHeight}px)`; // Итоговая позиция
                        }, index * 500); // Задержка для последовательности
                    });

                    // Показ победителя после завершения всех анимаций
                    setTimeout(() => {
                        const fullName = data.name.split(' ');
                        const initials = `${fullName[1]} ${fullName[0][0]}.`;
                        winnerBlock.innerHTML = `<span>Победитель: ${initials} <br>${data.code}</span>`;
                        winnerBlock.classList.add('show');
                        setTimeout(() => {
                            // Перемещаем блок в список победителей
                            winnerBlock.classList.remove('show');
                            winnerBlock.classList.add('to-list');
                        }, 3000); // Время для завершения перемещения
                        loadWinners(prizeIndex);
                        winnerBlock.classList.remove('to-list');


                        // Разблокируем переключение слайдов
                        prevButton.disabled = false;
                        nextButton.disabled = false;
                    }, winnerCode.length * 1000); // Задержка до вывода победителя
                }, 1000); // Задержка перед началом анимации
            });

            // Обработчик переключения слайдера
            document.querySelector('#prizeCarousel').addEventListener('slid.bs.carousel', (event) => {
                activeSlide = document.querySelector('.carousel-item.active');
                prizeIndex = activeSlide.getAttribute('data-prize-index');
                loadWinners(prizeIndex);
            });

            async function loadWinners(prizeIndex) {
                const response = await fetch(`/functions/ajax_show_wins.php?prizeIndex=${prizeIndex}`);
                const winners = await response.json();
                const winnerList = document.getElementById('winnerList');
                winnerList.innerHTML = ''; // Очищаем старый список

                if (winners.length > 0) {
                    prizeWinners[prizeIndex] = [];
                    winnerList.innerHTML = '<div class="wins-list">Список победителей</div>';
                    winners.forEach((winner, index) => {
                        prizeWinners[prizeIndex].push({code: winner.code, name: winner.name});
                        prizeRemaining[prizeIndex]--;
                        const winnerItem = document.createElement('div');
                        winnerItem.classList.add('win-item');
                        winnerItem.innerHTML = `${index + 1}. <span>${winner.name}</span> (${winner.code})`;
                        winnerList.appendChild(winnerItem);
                    });
                    if (winnerList.classList.contains('hide')) {
                        winnerList.classList.remove('hide');
                        winnerList.classList.add('show');
                    }
                } else {
                    if (winnerList.classList.contains('show')) {
                        winnerList.classList.remove('show');
                        winnerList.classList.add('hide');
                    }
                }
                if (prizeRemaining[prizeIndex] <= 0) {
                    drawButton.disabled = true;
                } else {
                    drawButton.disabled = false;
                }
            }

            loadWinners(prizeIndex);
        </script>
        <div class="container" id="scrollspyWins">
            <?php if (json_decode($winners, true)): ?>
                <?php
                $winner_prizers = json_decode($winners, true);
                ?>
                <div class="promo-wrapper align-items-center">
                    <div class="promo-participants">
                        <h2 class="promo-participants-title">🎉 Поздравляем победителей розыгрыша! 🎉</h2>
                        <div class="search-person-container">
                            <input type="text" id="searchCouponInput" placeholder="Введите номер купона..."/>
                        </div>
                        <div id="summaryContent">
                            <?php foreach ($winner_prizers as $winners_prizer): ?>
                                <div class="winner-prize-title"><?= $winners_prizer['prize'] ?>
                                    <?php foreach ($winners_prizer['winners'] as $index => $winner): ?>
                                        <div class="winner-item"><span
                                                    class="winner-number"><?= $index + 1 ?>.</span><?= $winner['code'] ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button id="toggleSummaryButton" class="load-more-button mt-4">Отобразить все</button>
                    </div>
                    <div class="promo-info">
                        <iframe width="100%" height="450" src="https://www.youtube.com/embed/T7UeYZEgLAg"
                                title="White Diamond" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen></iframe>
                    </div>
                    <script>
                        const toggleButton = document.getElementById('toggleSummaryButton');
                        const summaryContent = document.getElementById('summaryContent');
                        const searchCouponInput = document.getElementById('searchCouponInput');

                        let isExpanded = false;

                        // Отображение/скрытие полного списка
                        toggleButton.addEventListener('click', () => {
                            isExpanded = !isExpanded;
                            summaryContent.style.maxHeight = isExpanded ? 'none' : '300px';
                            toggleButton.textContent = isExpanded ? 'Скрыть' : 'Отобразить все';
                        });

                        // Поиск по номеру купона
                        searchCouponInput.addEventListener('input', () => {
                            const query = searchCouponInput.value.trim(); // Получаем введенный текст
                            const winnerItems = document.querySelectorAll('#summaryContent .winner-item');

                            // Обходим все элементы winner-item и фильтруем их
                            winnerItems.forEach(item => {
                                const couponNumber = item.textContent.trim(); // Извлекаем текст номера купона
                                if (couponNumber.includes(query) || query === '') {
                                    item.style.display = 'block'; // Показываем элемент, если он соответствует запросу
                                } else {
                                    item.style.display = 'none'; // Скрываем, если не соответствует
                                }
                            });

                            // Скрываем категории, где все элементы скрыты
                            const prizeTitles = document.querySelectorAll('#summaryContent .winner-prize-title');
                            prizeTitles.forEach(title => {
                                const visibleItems = title.querySelectorAll('.winner-item:not([style*="display: none"])');
                                title.style.display = visibleItems.length > 0 ? 'block' : 'none';
                            });
                        });
                    </script>
                </div>
            <?php else: ?>
            <?php
            // Получаем данные о шансах на победу
            $chanceData = json_decode($coupons_chance, true);
            $coupons = $chanceData['coupons'];
            $chances = $chanceData['chances'];
            $participants = [];

            foreach ($chances as $phone => $chance) {
                // Фильтруем купоны по номеру телефона
                $userCoupons = array_filter($coupons, function ($coupon) use ($phone) {
                    return $coupon['phone'] === $phone;
                });

                // Получаем FIO из первого купона, если оно есть
                $fio = isset(current($userCoupons)['name']) ? current($userCoupons)['name'] : 'Не указано';

                // Преобразуем имя
                $fioFormatted = preg_replace_callback('/^([А-Яа-яЁё-]+(?:\s+[А-Яа-яЁё-]+)*)$/u', function ($matches) {
                    $fullName = $matches[1];

                    // Если строка содержит пробел (есть имя и фамилия)
                    if (strpos($fullName, ' ') !== false) {
                        // Разделяем по пробелу и берем имя и фамилию
                        $nameParts = explode(' ', $fullName);
                        $name = $nameParts[1];
                        $surname = $nameParts[0];

                        // Если фамилия с дефисом (например, "Осьминина-Ширай")
                        if (strpos($surname, '-') !== false) {
                            // Фамилия после дефиса
                            $surname = explode('-', $surname)[1];
                        }

                        // Возвращаем Имя и первую букву фамилии
                        return $name . ' ' . mb_substr($surname, 0, 1) . '.';
                    }

                    // Если нет пробела, то просто фамилия (или одно слово)
                    if (strpos($fullName, '-') !== false) {
                        // Если фамилия через дефис, то берем после дефиса
                        $surname = explode('-', $fullName)[1];
                        return $surname . ' ' . mb_substr($fullName, 0, 1) . '.';
                    }

                    // Если нет пробела и дефиса — выводим одну строку как есть
                    return $fullName;
                }, $fio);

                // Добавляем участника с массивом купонов и количеством
                $participants[] = [
                    'fio' => $fioFormatted,
                    'chance' => number_format($chance, 2),
                    'coupons' => $userCoupons,  // Здесь сохраняем сам массив купонов
                    'coupon_count' => count($userCoupons),  // Добавляем количество купонов
                ];
            }

            // JSON для использования в JavaScript
            $jsonParticipants = json_encode($participants);
            ?>
                <div class="promo-wrapper">
                    <div class="promo-participants">
                        <h2 class="promo-participants-title">Участники</h2>
                        <div class="search-person-container">
                            <input type="text" id="searchInput" placeholder="Введите № купона..."/>
                        </div>
                        <div class="promo-table-container">
                            <table id="participantsTable" class="promo-table">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Имя участника</th>
                                    <th class="count-coupons">Количество купонов</th>
                                    <th>Шанс на победу</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <button id="loadMoreButton" class="load-more-button">Показать ещё</button>
                    </div>
                    <div class="promo-info">
                        <div class="info-card">
                            <h3>Дата розыгрыша</h3>
                            <div class="info-card-title">📅 16.12.2024</div>
                            <div class="info-card-description">Результаты будут опубликованы на сайте и в <a
                                        href="https://t.me/mirs_dv">
                                    <img src="views/bookmirs/images/icon-telegram.png" alt="Иконка телеграмма"
                                         style="width: 32px;">
                                </a></div>
                        </div>
                        <div class="info-card">
                            <h3>Порядок получения подарков</h3>
                            <div class="info-card-items">
                                <div class="info-card-item">
                                    <span class="info-card-item-number">1</span>
                                    <span class="info-card-item-text">Менеджер связывается с победителем по телефону (WhatsApp, эл. почта).</span>
                                </div>
                                <div class="info-card-item">
                                    <span class="info-card-item-number">2</span>
                                    <span class="info-card-item-text">Договаривается с победителем о месте и времени получения подарка.</span>
                                </div>
                                <div class="info-card-item">
                                    <span class="info-card-item-number">3</span>
                                    <span class="info-card-item-text">Менеджер отправляет подарок на магазин.</span>
                                </div>
                                <div class="info-card-item">
                                    <span class="info-card-item-number">4</span>
                                    <span class="info-card-item-text">Сотрудник магазина передает подарок победителю.</span>
                                </div>
                                <div class="info-card-item">
                                    <span class="info-card-item-number">5</span>
                                    <span class="info-card-item-text">Победитель заполняет Акт о получении подарка и предоставляет персональные данные (паспорт и ИНН).</span>
                                </div>
                            </div>
                        </div>
                        <a href="https://t.me/mirs_dv" target="_blank" class="telegram-button">Перейти в Telegram</a>
                    </div>
                </div>

                <script>
                    const participants = <?php echo $jsonParticipants; ?>;
                    const participantsTable = document.querySelector('#participantsTable tbody');
                    const loadMoreButton = document.getElementById('loadMoreButton');
                    const searchInput = document.getElementById('searchInput');
                    let visibleParticipants = 0;
                    const participantsPerPage = 25;

                    // Функция для отображения участников
                    function displayParticipants(filter = '') {
                        participantsTable.innerHTML = ''; // Очистить текущий список
                        let count = 0;

                        participants.forEach((participant, index) => {
                            if (count >= visibleParticipants) return;

                            let isMatch = false;

                            // Получаем список купонов для каждого участника
                            let userCoupons = participant.coupons;

                            // Проверяем, если coupons это объект, превращаем его в массив
                            if (userCoupons && typeof userCoupons === 'object' && !Array.isArray(userCoupons)) {
                                userCoupons = Object.values(userCoupons); // Преобразуем объект в массив
                            }

                            // Если фильтр — это номер купона
                            if (filter) {
                                // Проходим по каждому купону и проверяем, совпадает ли его номер с фильтром
                                if (userCoupons.some(coupon => coupon.code.includes(filter))) {
                                    isMatch = true;
                                }
                            } else {
                                // Если фильтра нет — отображаем всех участников
                                isMatch = true;
                            }

                            if (isMatch) {
                                const row = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${participant.fio}</td>
                        <td class="count-coupons">${userCoupons.length}</td>
                        <td>
                            <div class="progress-bar-container">
                                <div class="progress-bar" style="width: ${participant.chance}%; animation: grow ${participant.chance / 100 + 0.5}s ease-in-out;">
                                    <span class="progress-text">${participant.chance}%</span>
                                </div>
                            </div>
                        </td>
                    </tr>`;
                                participantsTable.insertAdjacentHTML('beforeend', row);
                                count++;
                            }
                        });

                        // Скрыть кнопку "Показать ещё", если больше нечего показывать
                        loadMoreButton.style.display =
                            visibleParticipants >= participants.length ? 'none' : 'block';
                    }

                    // Загрузить начальные участники
                    visibleParticipants = participantsPerPage;
                    displayParticipants();

                    // Обработчик для кнопки "Показать ещё"
                    loadMoreButton.addEventListener('click', () => {
                        visibleParticipants += participantsPerPage;
                        displayParticipants(searchInput.value);
                    });

                    // Обработчик для поиска
                    searchInput.addEventListener('input', (e) => {
                        const filter = e.target.value;
                        visibleParticipants = participantsPerPage;
                        displayParticipants(filter);
                    });
                </script>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="container" id="scrollspyParticipation">
        <div class="promotion-prizes">
            <h2 class="promotion-prizes-title head-text text-white">Как принять участие в акции?</h2>
            <div class="slider-container">
                <!-- Bootstrap Carousel -->
                <div id="participationCarousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="views/bookmirs/images/promotion-slider-1.png" class="d-block w-100"
                                 alt="Слайд 1">
                            <div class="carousel-caption promotion-carousel-text">
                                <p>Совершите покупку на сумму от 1000 рублей</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="views/bookmirs/images/promotion-slider-2.png" class="d-block w-100"
                                 alt="Слайд 2">
                            <div class="carousel-caption promotion-carousel-text">
                                <p>Получите чек и купон участника</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="views/bookmirs/images/promotion-slider-3.png" class="d-block w-100"
                                 alt="Слайд 3">
                            <div class="carousel-caption promotion-carousel-text">
                                <p>Зарегистрируйте купон на сайте</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="views/bookmirs/images/promotion-slider-4.png" class="d-block w-100"
                                 alt="Слайд 4">
                            <div class="carousel-caption promotion-carousel-text">
                                <p>Дождитесь итогов розыгрыша и получите свой приз <a
                                            href="https://t.me/mirs_dv">
                                        <img src="views/bookmirs/images/icon-telegram.png" alt="Иконка телеграмма">
                                    </a></p>
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
                <div class="promotion-participation-container">
                    <div class="promotion-participation-block active" data-slide-to="0">
                        <span class="promotion-participation-number">1</span>
                        Совершите покупку на сумму от 1000 рублей
                    </div>
                    <div class="promotion-participation-block" data-slide-to="1">
                        <span class="promotion-participation-number">2</span>
                        Получите чек и купон участника
                    </div>
                    <div class="promotion-participation-block" data-slide-to="2">
                        <span class="promotion-participation-number">3</span>
                        Зарегистрируйте купон на сайте
                    </div>
                    <div class="promotion-participation-block" data-slide-to="3">
                        <span class="promotion-participation-number">4</span>
                        Дождитесь итогов розыгрыша и получите свой приз
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
                                    <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse"
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
    <div class="container promotion-info-block">
        <div class="d-flex justify-content-evenly pb-4 flex-wrap gap-4">
            <a href="../files/rules.pdf" class="promotion-info-link" target="_blank">Правила акции</a>
            <a href="../files/confidential.pdf" class="promotion-info-link" target="_blank">Политика
                конфиденциальности</a>
            <a href="#" data-bs-toggle="modal" data-bs-email="kds@bookmirs.ru" data-bs-target="#modalSendMessage"
               class="promotion-info-link">Обратная связь</a>
        </div>
        <div class="promotion-info-text">
            Срок участия в Акции с 15.11.2024г. по 15.12.2024г. Общий срок Акции, включая срок вручения призов с
            15.11.2024г. по 31.12.2024г. Информация об организаторе Акции, правилах ее проведения, участвующей в
            Акции
            продукции, сроках, количестве призов, месте и порядке их получения размещены на сайте bookmirs.ru в
            разделе
            "Акция"
        </div>
    </div>
</div>
<div class="notification-system">
    <div class="notification_list_bottom">
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
            <div class="col-12 modal-title text-center w-100 bold-30 promotion-modal-title">Зарегистрировать
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
                                            Я даю согласие на обработку<br> <a href="../files/confidential.pdf"
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
