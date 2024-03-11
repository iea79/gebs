(function () {
    const variationWrap = $('.variations .value');
    const variationSelect = $('.variations select');
    const variationOptions = $('.variations select option');

    variationOptions.each(function(i, el) {
        // console.log(el.value);
        let checked = '';
        // el.selected ?
        if (el.selected) {
            checked = 'checked';
        }
        if (el.value !== "") {
            variationWrap.append(`<label class="form__check">
                <input type="radio" name="prod-variable" ${checked} value="${el.value}">
                <span>${$(el).html()}</span>
                </label>
            `);
        }
    });

    $('body').on('change', '.variations .value input', function() {
        // console.log($(this).val());
        variationSelect.val($(this).val()).trigger('change');
    });

    function calculatePriceFromSingleProduct() {
        if (!$('div.product').hasClass('product-type-simple')) return false;
        // $('.single-product');
        let price = $('.summary .woocommerce-Price-amount bdi').text(),
            priceNum = +price.replace('$', '');

        // console.log(priceNum);
        setPrice(priceNum);

        function setPrice(num) {
            $('.summary form.cart').prepend(`<p class="price">
                <span class="woocommerce-Price-amount amount">
                    <bdi>$${num}</bdi>
                </span>
            </p>`
            );
        }
    }
    calculatePriceFromSingleProduct();

    function productGallerySlider() {
        const slides = $('.woocommerce-product-gallery__wrapper');

        slides.clone().addClass('gallery_thumbs').appendTo(slides.parent());
        slides.addClass('gallery_slider');

        $('.gallery_slider a, .gallery_thumbs a').on('click', (e) => {
            e.preventDefault();
        });

        $('.related .products').slick({
            infinite: false,
            prevArrow: '<div class="slick-prev"></div>',
            nextArrow: '<div class="slick-next"></div>',
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
            ]
        });

        $('.gallery_slider').slick({
            infinite: false,
            arrows: false,
            draggable: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            // fade: true,
            asNavFor: '.gallery_thumbs'
        });
        $('.gallery_thumbs').slick({
            // arrows: false,
            prevArrow: '<div class="slick-prev"></div>',
            nextArrow: '<div class="slick-next"></div>',
            infinite: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.gallery_slider',
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                },
            ]
        });
    }
    productGallerySlider();

    function replaceReviewForm() {
        $('#review_form_wrapper').appendTo('.reviewModal .modal-body');
    }
    replaceReviewForm();

    if ($('.summary .cart').hasClass('variations_form')) {
        $('.summary .yith-wcwl-add-to-wishlist').appendTo('.summary .single_variation_wrap');
    } else {
        $('.summary .yith-wcwl-add-to-wishlist').appendTo('.summary .cart');
    }

    if ( isXsWidth() ) {
        $('div.product h1.product_title').prependTo('div.product');
    } else {
        $('div.product h1.product_title').prependTo('div.summary');
    }

})();
