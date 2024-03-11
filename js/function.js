/*!
 *
 * Evgeniy Ivanov - 2018
 * busforward@gmail.com
 * Skype: ivanov_ea
 *
 */

var app = {
    pageScroll: '',
    lgWidth: 1200,
    mdWidth: 992,
    smWidth: 768,
    resized: false,
    iOS: function() { return navigator.userAgent.match(/iPhone|iPad|iPod/i); },
    touchDevice: function() { return ('ontouchstart' in window) || (navigator.maxTouchPoints > 0) || (navigator.msMaxTouchPoints > 0); }
};

function isLgWidth() { return $(window).width() >= app.lgWidth; } // >= 1200
function isMdWidth() { return $(window).width() >= app.mdWidth && $(window).width() < app.lgWidth; } //  >= 992 && < 1200
function isSmWidth() { return $(window).width() >= app.smWidth && $(window).width() < app.mdWidth; } // >= 768 && < 992
function isXsWidth() { return $(window).width() < app.smWidth; } // < 768
function isIOS() { return app.iOS(); } // for iPhone iPad iPod
function isTouch() { return app.touchDevice(); } // for touch device


$(document).ready(function() {
    // Хак для клика по ссылке на iOS
    if (isIOS()) {
        $(function(){$(document).on('touchend', 'a', $.noop)});
    }

	// Запрет "отскока" страницы при клике по пустой ссылке с href="#"
	$('[href="#"]').click(function(event) {
		event.preventDefault();
	});

    // Inputmask.js
    // $('[name=tel]').inputmask("+9(999)999 99 99",{ showMaskOnHover: false });
    // formSubmit();

    // checkOnResize();

    // stikyMenu();


    // $('.woocommerce-cart-form tr').each(function(i, el) {
    //     const del = $(el).find('.product-remove');
    //     const last = $(el).find('td, th').last();
    //     del.insertAfter(last);
    // });

    $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
        $.get( yith_wcwl_l10n.ajax_url, {
            action: 'yith_wcwl_update_wishlist_count'
        }, function( data ) {
            console.log(data.count);
            if (data.count > 0) {
                if (!$('.wishlist_link .wishlistHeader__count').length) {
                    $('.wishlist_link').append('<div class="wishlistHeader__count"></div>');
                }
            } else {
                $('.wishlist_link .wishlistHeader__count').remove();
            }
        } );
    } );

});


// $(window).on('scroll', function(){
//     let scrollPos = $(window).scrollTop();
//     console.log(scrollPos);
//     $('.panther__img').css({
//         transform: 'translate(0px, '+scrollPos+'px) scale('+scrollPos/1000+')',
//         // opacity: scrollPos/1000
//     });
// });

$(window).resize(function(event) {
    var windowWidth = $(window).width();
    // Запрещаем выполнение скриптов при смене только высоты вьюпорта (фикс для скролла в IOS и Android >=v.5)
    if (app.resized == windowWidth) { return; }
    app.resized = windowWidth;

	// checkOnResize();
});

function checkOnResize() {
    // fontResize();
}

function triggerEvent(el, type) {
    if ('createEvent' in document) {
        var e = document.createEvent('HTMLEvents');
        e.initEvent(type, false, true);
        el.dispatchEvent(e);
    } else {
        var e = document.createEventObject();
        e.eventType = type;
        el.fireEvent('on' + e.eventType, e);
    }
}

function updateCartCount() {
    $('.quantity .qty').each(function(i, el) {
        if (el.value == 1) {
            $(el).closest('.quantity').find('.icon_minus').addClass('disabled');
        }
    });
    $( 'body' ).on('click', '.quantity .icon_plus, .quantity .icon_minus', function() {
        console.log('click', this);
        let wrap = $(this).closest('.quantity'),
            qty = wrap.find('input.qty'),
            count = qty.val();

        if ($(this).hasClass('icon_plus')) {
            count++;
            qty.val(count).trigger('change');
        } else {
            if (count > 1) {
                count--;
                qty.val(count).trigger('change');
            }
        }

        if (count > 1) {
            wrap.find('.icon_minus').removeClass('disabled');
        } else {
            wrap.find('.icon_minus').addClass('disabled');
        }
    });

    $( document.body ).on('change', '.qty', (e) => {
        $('[name="update_cart"]').removeAttr('disabled').trigger('click');
        // $( document ).trigger('update_cart');
        // $( document ).trigger('wc_update_cart');
    });
}
updateCartCount();


// Stiky menu // Липкое меню. При прокрутке к элементу #header добавляется класс .stiky который и стилизуем
function stikyMenu() {
    let HeaderTop = $('header').offset().top + $(window).height();
    let currentTop = $(window).scrollTop();

    setNavbarPosition();

    $(window).scroll(function(){
        setNavbarPosition();
    });

    function setNavbarPosition() {
        currentTop = $(window).scrollTop();

        if( currentTop > HeaderTop ) {
            $('header').addClass('stiky');
        } else {
            $('header').removeClass('stiky');
        }

        $('.navbar__link').each(function(index, el) {
            let section = $(this).attr('href');

            if ($('section').is(section)) {
                let offset = $(section).offset().top;

                if (offset <= currentTop && offset + $(section).innerHeight() > currentTop) {
                    $(this).addClass('active');
                } else {
                    $(this).removeClass('active');
                }
            }
        });
    }
}

function toggleFaqs() {
    $('.faqSection__name').on('click', function() {
        const item = $(this).closest('.faqSection__item');
        const text = item.find('.faqSection__text');
        $('.faqSection__item').not(item).removeClass('open');
        $('.faqSection__text').not(text).hide();
        item.toggleClass('open');
        if (item.hasClass('open')) {
            text.slideDown(400);
        } else {
            text.hide();
        }
    });
}
toggleFaqs();

function toggleTabs() {
    let toggle = $('[data-tab]');
    toggle.on('click', (e) => {
        let self = e.target;
        $('[data-tab]').removeClass('active');
        $(self).addClass('active');
        $('[data-plate]').removeClass('active');
        $('[data-plate='+self.dataset.tab+']').addClass('active');
    });
}
toggleTabs();

function openMobileNav() {
    $('.menu__toggle').on('click', function() {
        var wrapp = $('.nav');

        wrapp.toggleClass('open');
        $(this).toggleClass('active');
    });
}
openMobileNav();

// Scroll to ID // Плавный скролл к элементу при нажатии на ссылку. В ссылке указываем ID элемента
function srollToId() {
    $('[data-scroll-to]').click( function(){
        var scroll_el = $(this).attr('href');
        if ($(scroll_el).length != 0) {
            $('html, body').animate({ scrollTop: $(scroll_el).offset().top }, 500);
        }
        return false;
    });
}

function fontResize() {
    var windowWidth = $(window).width();
    if (windowWidth >= 1200) {
    	var fontSize = windowWidth/19.05;
    } else if (windowWidth < 1200) {
    	var fontSize = 60;
    }
	$('body').css('fontSize', fontSize + '%');
}

// Проверка направления прокрутки вверх/вниз
function checkDirectionScroll() {
    var tempScrollTop, currentScrollTop = 0;

    $(window).scroll(function(){
        currentScrollTop = $(window).scrollTop();

        if (tempScrollTop < currentScrollTop ) {
            app.pageScroll = "down";
        } else if (tempScrollTop > currentScrollTop ) {
            app.pageScroll = "up";
        }
        tempScrollTop = currentScrollTop;

    });
}
checkDirectionScroll();

// Видео youtube для страницы
function uploadYoutubeVideo() {
    if ($(".js-youtube")) {

        $(".js-youtube").each(function () {
            // Зная идентификатор видео на YouTube, легко можно найти его миниатюру
            $(this).css('background-image', 'url(http://i.ytimg.com/vi/' + this.id + '/sddefault.jpg)');

            // Добавляем иконку Play поверх миниатюры, чтобы было похоже на видеоплеер
            $(this).append($('<img src="img/play.svg" alt="Play" class="video__play">'));

        });

        $('.video__play, .video__prev').on('click', function () {
            // создаем iframe со включенной опцией autoplay
            let wrapp = $(this).closest('.js-youtube'),
                videoId = wrapp.attr('id'),
                iframe_url = "https://www.youtube.com/embed/" + videoId + "?autoplay=1&autohide=1";

            if ($(this).data('params')) iframe_url += '&' + $(this).data('params');

            // Высота и ширина iframe должны быть такими же, как и у родительского блока
            let iframe = $('<iframe/>', {
                'frameborder': '0',
                'src': iframe_url,
                'allow': "autoplay"
            })

            // Заменяем миниатюру HTML5 плеером с YouTube
            $(this).closest('.video__wrapper').append(iframe);

        });
    }
};

function onVisible( selector, callback, playback, threshold=[0.5] ) {

    let options = {
        threshold: threshold
    };
    let observer = new IntersectionObserver( onEntry, options );
    let elements = document.querySelectorAll( selector );
    // let play = selector.querySelector('.video__play');

    for ( let elm of elements ) {
        observer.observe( elm );
    }

    function onEntry( entry ) {
        entry.forEach( change => {
            let elem = change.target;
            let frame = elem.querySelector('iframe');
            if ( change.isIntersecting ) {
                // console.log('show', elem);
                callback(elem);
            } else {
                // console.log('hidden', elem);
                playback(elem);
            }
        } );
    }
}


// Деление чисел на разряды Например из строки 10000 получаем 10 000
// Использование: thousandSeparator(1000) или используем переменную.
// function thousandSeparator(str) {
//     var parts = (str + '').split('.'),
//         main = parts[0],
//         len = main.length,
//         output = '',
//         i = len - 1;

//     while(i >= 0) {
//         output = main.charAt(i) + output;
//         if ((len - i) % 3 === 0 && i > 0) {
//             output = ' ' + output;
//         }
//         --i;
//     }

//     if (parts.length > 1) {
//         output += '.' + parts[1];
//     }
//     return output;
// };


// Хак для яндекс карт втавленных через iframe
// Страуктура:
//<div class="map__wrap" id="map-wrap">
//  <iframe style="pointer-events: none;" src="https://yandex.ru/map-widget/v1/-/CBqXzGXSOB" width="1083" height="707" frameborder="0" allowfullscreen="true"></iframe>
//</div>
// Обязательное свойство в style которое и переключет скрипт
// document.addEventListener('click', function(e) {
//     var map = document.querySelector('#map-wrap iframe')
//     if(e.target.id === 'map-wrap') {
//         map.style.pointerEvents = 'all'
//     } else {
//         map.style.pointerEvents = 'none'
//     }
// })

// Простая проверка форм на заполненность и отправка аяксом
// function formSubmit() {
//     $("[type=submit]").on('click', function (e){
//         e.preventDefault();
//         var form = $(this).closest('.form');
//         var url = form.attr('action');
//         var form_data = form.serialize();
//         var field = form.find('[required]');
//         // console.log(form_data);

//         empty = 0;

//         field.each(function() {
//             if ($(this).val() == "") {
//                 $(this).addClass('invalid');
//                 // return false;
//                 empty++;
//             } else {
//                 $(this).removeClass('invalid');
//                 $(this).addClass('valid');
//             }
//         });

//         // console.log(empty);

//         if (empty > 0) {
//             return false;
//         } else {
//             $.ajax({
//                 url: url,
//                 type: "POST",
//                 dataType: "html",
//                 data: form_data,
//                 success: function (response) {
//                     // $('#success').modal('show');
//                     // console.log('success');
//                     console.log(response);
//                     // console.log(data);
//                     // document.location.href = "success.html";
//                 },
//                 error: function (response) {
//                     // $('#success').modal('show');
//                     // console.log('error');
//                     console.log(response);
//                 }
//             });
//         }

//     });

//     $('[required]').on('blur', function() {
//         if ($(this).val() != '') {
//             $(this).removeClass('invalid');
//         }
//     });

//     $('.form__privacy input').on('change', function(event) {
//         event.preventDefault();
//         var btn = $(this).closest('.form').find('.btn');
//         if ($(this).prop('checked')) {
//             btn.removeAttr('disabled');
//             // console.log('checked');
//         } else {
//             btn.attr('disabled', true);
//         }
//     });
// }


// Проверка на возможность ввода только русских букв, цифр, тире и пробелов
// $('#u_l_name').on('keypress keyup', function () {
//     var that = this;
//
//     setTimeout(function () {
//         if (that.value.match(/[ -]/) && that.value.length == 1) {
//             that.value = '';
//         }
//
//         if (that.value.match(/-+/g)) {
//             that.value = that.value.replace(/-+/g, '-');
//         }
//
//         if (that.value.match(/ +/g)) {
//             that.value = that.value.replace(/ +/g, ' ');
//         }
//
//         var res = /[^а-яА-Я -]/g.exec(that.value);
//
//         if (res) {
//             removeErrorMsg('#u_l_name');
//             $('#u_l_name').after('<div class="j-required-error b-check__errors">Измените язык ввода на русский</div>');
//         }
//         else {
//             removeErrorMsg('#u_l_name');
//         }
//
//         that.value = that.value.replace(res, '');
//     }, 0);
// });
