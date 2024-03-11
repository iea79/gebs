(function () {
    function changeShippingMethods() {
        let select = $('#shipping_methods');

        updateSelect();

        $( document ).on('updated_checkout', function() {
            // console.log($(this).val());
            const price = $('.shipping_method option[selected]').text().split(':')[1];
            const type = $('[name=payment_method]:checked').val();
            const btn = $('#place_order');
            console.log('payment_method === ', type);
            // let price = $('.shipping_method').val();
            if (type === 'square_credit_card') {
                // wrap.show();
                // btn.hide();
            } else {
                // wrap.hide();
                // btn.show();
            }

            updateSelect();
            // console.log(price);
            if (price !== undefined) {
                if ($('.shipping_price').length) {
                    $('.shipping_price').text(price);
                } else {
                    $('.woocommerce-shipping-totals td').append('<span class="shipping_price">'+price+'</span>');
                }
            } else {
                // $('.woocommerce-shipping-totals').hide();
            }
        });

        function updateSelect() {
            select.html('');
            select.append('<option value=""></option>');
            $('.woocommerce-shipping-totals select option').clone().appendTo(select);
            // select.val('').trigger('change');
            // select.find('option').each(function(i, el) {
            //     let text = $(el).text();
            //     $(el).text(text.split(':')[0]);
            // });
            if (!select.hasClass('select2-hidden-accessible')) {
                select.select2({
                    minimumResultsForSearch: Infinity,
                    // allowClear: true
                });
            } else {
                select.select2("destroy");
                select.select2({
                    minimumResultsForSearch: Infinity,
                    // allowClear: true
                });
            }

            select.on('change', function() {
                console.log($(this).val());
                $('.woocommerce-shipping-totals .shipping_method').val($(this).val()).change();
            });
        }
    }
    changeShippingMethods();

    function replaceCheckoutFields() {
        if ( isXsWidth() ) {
            $('.woocommerce-checkout-review-order-table').insertAfter('.col2-set');
        } else {
            $('.woocommerce-checkout-review-order-table').appendTo('.checkout__aside');
        }
    }
    replaceCheckoutFields();

    $(window).on('resize', () => {
        replaceCheckoutFields();
    });

    function squarePaymentMethod() {
        const form = $('#wc-square-digital-wallet');

        form.insertAfter('#payment').wrap('<div class="square-wrapper"></div>');

        checkPaymentMethodSelected();
    }
    squarePaymentMethod();

    function checkPaymentMethodSelected() {
        const radio = $('[name=payment_method]:checked');
        const btn = $('#place_order');
        const wrap = $('.square-wrapper');

        console.log(radio.val());

        if (radio.val() === 'square_credit_card') {
            wrap.show();
            btn.hide();
        } else {
            wrap.hide();
            btn.show();
        }

        $('body').on('change', '[name=payment_method]', function() {
            const butn = $('#place_order');
            console.log($(this).val());
            if ($(this).val() === 'square_credit_card') {
                wrap.show();
                butn.hide();
            } else {
                wrap.hide();
                butn.show();
            }
        })
    }
})();
