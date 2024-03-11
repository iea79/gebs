$(document).ready(() => {
    $('.orderby').select2({
        minimumResultsForSearch: Infinity,
        theme: "default orderby"
    });

    $( document ).on('added_to_cart', () => {
        if (!$('.cartHeader__count').length) {
            $('.header__right .cart_link').append('<div class="cartHeader__count"></div>');
        }
        $('.add_to_cart_button.added').text('Added');
    });

    $('.filter__toggle, .filter__close').on('click', function() {
        $('.filter').toggleClass('open');
    });
});
