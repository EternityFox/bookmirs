$(document).ready(function () {
    var maskedInput = function () {
        $('input[name="phone"]').mask('+7(999) 999-99-99');
    }
    maskedInput();
    /*$("form").on('submit', function (e) {

    });*/
    $('#sendQuestion').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/functions/ajax_send_question.php',
            type: 'POST',
            data: {
                name: $('#sendQuestion #name').val(),
                email: $('#sendQuestion #email').val(),
                question: $('#sendQuestion #question').val()
            },
            success: function (response) {
                if (response) {
                    $('#modalViewPromotionQuestion #resultMessage').html('<div class="alert alert-success">' + response + '</div>');
                    $('#sendQuestion')[0].reset();
                } else {
                    $('#modalViewPromotionQuestion #resultMessage').html('<div class="alert alert-danger">Проверьте, что все поля были заполнены</div>');
                }
            },
            error: function () {
                $('#modalViewPromotionQuestion #resultMessage').html('<div class="alert alert-danger">Произошла ошибка при отправке запроса.</div>');
            }
        });
    });

    $('a[data-bs-target="#modalSendMessage"]').on('click', function (e) {
        $('#modalSendMessage #send_mail').val($(this).attr('data-bs-email'));
    });

    $('#sendMessage').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/functions/ajax_send_mails.php',
            type: 'POST',
            data: {
                name: $('#sendMessage #name').val(),
                phone: $('#sendMessage #phone').val(),
                email: $('#sendMessage #email').val(),
                message: $('#sendMessage #message').val(),
                sender: $('#sendMessage #send_mail').val(),
            },
            success: function (response) {
                if (response) {
                    $('#modalSendMessage #resultMessage').html('<div class="alert alert-success">Сообщение успешно отправлено</div>');
                    $('#sendMessage')[0].reset();
                } else {
                    $('#modalSendMessage #resultMessage').html('<div class="alert alert-danger">Проверьте, что все поля были заполнены</div>');
                }
            },
            error: function () {
                $('#modalSendMessage #resultMessage').html('<div class="alert alert-danger">Произошла ошибка при отправке запроса.</div>');
            }
        });
    });

    $('#sendCoupon').on('submit', function (e) {
        e.preventDefault();
        const notificationContainer = $('.notification-system .notification_list_bottom');
        const resultMessage = $('#modalViewPromotionRegistration #resultMessage');
        const createNotification = (message, isSuccess) => {
            const notification = `
            <div class="notification">
                <div class="notification_text-block">
                    <div class="notification_title ${isSuccess}">${message}</div>
                </div>
                <div class="notification_close">
                    <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8.00386 9.41816C7.61333 9.02763 7.61334 8.39447 8.00386 8.00395C8.39438 7.61342 9.02755 7.61342 9.41807 8.00395L12.0057 10.5916L14.5907 8.00657C14.9813 7.61605 15.6144 7.61605 16.0049 8.00657C16.3955 8.3971 16.3955 9.03026 16.0049 9.42079L13.4199 12.0058L16.0039 14.5897C16.3944 14.9803 16.3944 15.6134 16.0039 16.0039C15.6133 16.3945 14.9802 16.3945 14.5896 16.0039L12.0057 13.42L9.42097 16.0048C9.03045 16.3953 8.39728 16.3953 8.00676 16.0048C7.61624 15.6142 7.61624 14.9811 8.00676 14.5905L10.5915 12.0058L8.00386 9.41816Z" fill="#ed691f"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M23 12C23 18.0751 18.0751 23 12 23C5.92487 23 1 18.0751 1 12C1 5.92487 5.92487 1 12 1C18.0751 1 23 5.92487 23 12ZM3.00683 12C3.00683 16.9668 7.03321 20.9932 12 20.9932C16.9668 20.9932 20.9932 16.9668 20.9932 12C20.9932 7.03321 16.9668 3.00683 12 3.00683C7.03321 3.00683 3.00683 7.03321 3.00683 12Z" fill="#ed691f"></path>
                    </svg>
                </div>
            </div>`;
            notificationContainer.html(notification);
            notificationContainer.find('.notification_close').on('click', () => notificationContainer.empty());
            setTimeout(() => notificationContainer.empty(), 5000);
        };
        const form = $('#sendCoupon');
        const formData = {
            coupon: form.find('#coupon').val(),
            name: form.find('#name').val(),
            email: form.find('#email').val(),
            phone: form.find('#phone').val(),
            agree: form.find('#check-os-1').is(':checked')
        };

        notificationContainer.empty();
        $.ajax({
            url: '/functions/ajax_send_coupon.php',
            type: 'POST',
            dataType: 'json',
            data: formData,
            success: (response) => {
                if (response.success) {
                    form[0].reset();
                    resultMessage.html(`<div class="alert alert-success">${response.message}</div>`);
                    createNotification(response.message, 'success');
                } else {
                    resultMessage.html(`<div class="alert alert-danger">${response.message}</div>`);
                    createNotification(response.message, 'error');
                }
            },
            error: () => {
                const errorMessage = 'Произошла ошибка при отправке запроса.';
                resultMessage.html(`<div class="alert alert-danger">${errorMessage}</div>`);
                createNotification(errorMessage, 'error');
            }
        });
    });

    const navList = document.querySelector('.navList');
    const navBtn = document.querySelector('.navBtn');
    if ($(navBtn).css('display') === 'block') {
        const navLinks = document.querySelectorAll('.navLi');
        const navLinksA = document.querySelectorAll('.navLi a');
        const events = {
            navBtn,
            ...navLinksA
        };
        for (const elem in events) {
            events[elem].addEventListener('click', () => {
                navBtn.classList.toggle('navBtnToggle');
                navList.classList.toggle('navActive');
                navLinks.forEach((item, index) => {
                    const delay = index / 10 + 0.05;
                    if (item.style.animation)
                        item.style.animation = '';
                    else
                        item.style.animation = `SlideIn 0.5s forwards ${delay}s`;
                })
            });
        }
    }
    $(window).scroll(function () {
        if ($(window).scrollTop() >= $('header').innerHeight() - 650) {
            $('#navbar-scroll').addClass('focus');
        } else {
            $('#navbar-scroll').removeClass('focus');
        }

    });
    $("a[href='#top']").click(function () {
        $("html, body").animate({scrollTop: 0}, "slow");
        return false;
    });

    if (ie === true) {
        $("#ie-detected").html("<div class=\"alert alert-danger\" role=\"alert\"><strong>Вы используете старый бразуер Internet Explorer 8.</strong><br/>Вам будут недоступны некоторые функции нашего сайта. Рекомендуем обновить браузер или установить нормальный:<br/> <a blank=\"_target\" href=\"https://www.mozilla.org/ru/firefox/new/\">Mozilla Firefox</a> / <a blank=\"_target\"  href=\"http://www.google.ru/chrome/browser/\">Google Chrome</a> / <a blank=\"_target\"  href=\"http://www.opera.com/\">Opera</a></div>");
    }
    $('#header-search').click(function () {
        $('#header-block').slideToggle(250);
        return false;
    });
    $('#close-search').click(function () {
        $('#header-block').slideToggle(250);
        return false;
    });

    $('.show-more').click(function (e) {
        e.preventDefault();
        link = $(this);
        $.ajax({
            url: '/',
            method: 'GET',
            data: {'view': 'search', 'q': link.attr('data-string'), 'page': parseInt(link.attr('data-page')) + 1},
            success: function (data) {
                $('.product-grid').append($(data).find('.product-grid > div'));
                $('.pagination').html($(data).find('.pagination').html());
                link.attr('data-page', parseInt(link.attr('data-page')) + 1);
                if (link.attr('data-page') >= link.attr('data-max')) link.remove();
            }
        })
    });

    var owl = $('.first-news').owlCarousel({
        items: 1,
        loop: true,
        nav: true,
        navText: ['<i class="glyphicon glyphicon-chevron-left"></i>', '<i class="glyphicon glyphicon-chevron-right"></i>'],
        mouseDrag: false,
        touchDrag: false,
        pullDrag: false,
        margin: 2,
        onInitialized: function () {
            rotate();
        },
    });
    owl.on('change.owl.carousel', rotate);
    var timeout = null;

    $('.pop_text').magnificPopup({
        removalDelay: 500, //delay removal by X to allow out-animation
        callbacks: {
            beforeOpen: function () {
                this.st.mainClass = this.st.el.attr('data-effect');
            }
        },
        midClick: true // allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source.
    });

    $('.label_promotions').magnificPopup({
        delegate: 'a',
        callbacks: {
            beforeOpen: function () {
                this.st.mainClass = this.st.el.attr('data-effect');
            }
        },
        midClick: true
    });

    $('.label_promotions').click(function (e) {
        if (e.clientX <= $(this).offset().left) {
            $('.label_promotions').toggleClass('opened');
        }
    });
    $('.label_promotions a').trigger('click');

    function rotate() {
        if (timeout) clearTimeout(timeout);
        setTimeout(function () {
            duration = $('.owl-item.active .first-news-inner').attr('data-duration') * 1000;
            timeout = setTimeout(function () {
                owl.trigger('next.owl.carousel');
            }, duration);
        }, 100);
    }

    $(function () {
        // Проверяем запись в куках о посещении
        // Если запись есть - ничего не происходит
        if (!$.cookie('hideModal')) {
            // если cookie не установлено появится окно
            // с задержкой 5 секунд
            var delay_popup = 1000;
            setTimeout("document.querySelector('.bottom__cookie-block').style.display='inline-block'", delay_popup);
        }
        $.cookie('hideModal', true, {
            // Время хранения cookie в днях
            expires: 30,
            path: '/'
        });
    });
    // Закрытие полосы cookie
    $('.ok').click(function () {
        $('.bottom__cookie-block').fadeOut();
    });


});
    
