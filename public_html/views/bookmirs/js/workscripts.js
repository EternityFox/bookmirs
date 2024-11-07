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

    $('footer .footer-text a[data-bs-target="#modalSendMessage"]').on('click', function (e) {
        $('#modalSendMessage #send_mail').val($(this).text());
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
                    $('#modalSendMessage #resultMessage').html('<div class="alert alert-success">' + response + '</div>');
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
        $.ajax({
            url: '/functions/ajax_send_coupon.php',
            type: 'POST',
            dataType: 'json',
            data: {
                coupon: $('#sendCoupon #coupon').val(),
                name: $('#sendCoupon #name').val(),
                email: $('#sendCoupon #email').val(),
                phone: $('#sendCoupon #phone').val(),
                agree: $("#sendCoupon #check-os-1").is(":checked")
            },
            success: function (response) {
                console.log(response);
                if (response.success) {
                    $('#modalViewPromotionRegistration #resultMessage').html('<div class="alert alert-success">' + response.message + '</div>');
                    $('#sendCoupon')[0].reset();
                } else {
                    $('#modalViewPromotionRegistration #resultMessage').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function () {
                $('#modalViewPromotionRegistration #resultMessage').html('<div class="alert alert-danger">Произошла ошибка при отправке запроса.</div>');
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
    
