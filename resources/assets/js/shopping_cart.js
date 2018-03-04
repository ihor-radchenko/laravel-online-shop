
$(document).on("click", ".addItemToCart", function () {
    var btns = $(".addItemToCart");
    disabledOn(btns);
    var btn = $(this);
    var quantity = $("#qty");
    $.ajax({
        url: btn.data('route'),
        type: 'GET',
        data: {
            product: btn.data('product'),
            quantity: quantity.val() ? quantity.val() : 1
        },
        success: function (response) {
            disabledOff(btns);
            $("#cartCount").text(response.totalQuantity);
            if (response.item.quantity === response.item.product.quantity) {
                disabledOn(btn).removeClass('addItemToCart').empty().text(btn.data('msgnotinstock'));
                disabledOn(quantity);
            } else {
                quantity.attr('max', response.item.product.quantity - response.item.quantity).val(1);
            }
        },
        error: function (jqXHR) {
            disabledOff(btns);
            if (jqXHR.status === 422) {
                $('.popup h4').empty().append(jqXHR.responseJSON.message);
                $('.popup').show();
            } else {
                $('.popup').show();
            }
        }
    })
});

$(document).on('click', '.subtractItem', function () {
    disabledOn($(".changeQuantity"));
    var btn = $(this);
    btn.siblings('.addItem').addClass('changeQuantity');
    var quantity = $('.num').text();
    ajaxChangeCart(btn, -1);
});

$(document).on('click', '.addItem', function () {
    disabledOn($(".changeQuantity"));
    var btn = $(this);
    ajaxChangeCart(btn, 1);
});

function ajaxChangeCart(btn, quantity) {
    $.ajax({
        url: btn.data('route'),
        type: 'GET',
        data: {
            product: btn.data('product'),
            quantity: quantity
        },
        success: function (response) {
            console.log(response);
            disabledOff($(".changeQuantity"));
            $("#cartCount").text(response.totalQuantity);
            if (response.item === null) {
                btn.parent().parent().parent().fadeOut('slow');
                return;
            }

            if (response.item.quantity === response.item.product.quantity) {
                disabledOn(btn.removeClass('changeQuantity'));
            }

            let qty = btn.siblings('.num');
            qty.text(response.item.quantity);
            btn.parent().parent().siblings('.amountPrice').children('span').text(response.amount);
            $('#totalPrice').text(response.totalPrice);
        },
        error: function (jqXHR) {
            disabledOff($('.changeQuantity'));
            if (jqXHR.status === 422) {
                $('.popup h4').empty().append(jqXHR.responseJSON.message);
                $('.popup').show();
            } else {
                $('.popup h4').empty().append($("#ajaxError").data('error'));
                $('.popup').show();
            }
        }
    })
}

$(document).on('click', '.removeItem', function () {
    var btn = $(this);
    disabledOn($('.changeQuantity'));
    disabledOn($('.removeItem'));
    $.ajax({
        url: btn.data('route'),
        type: 'GET',
        data: {product: btn.data('product')},
        dataType: 'json',
        success: function (response) {
            disabledOff($('.changeQuantity'));
            disabledOff($('.removeItem'));
            $("#cartCount").text(response.totalQuantity);
            $('#totalPrice').text(response.totalPrice);
            btn.parent().parent().fadeOut('slow');
        },
        error: function () {
            disabledOff($('.changeQuantity'));
            disabledOff($('.removeItem'));
            $('.popup').show();
        }
    });
});

function disabledOn(selector) {
    return selector.attr('disabled', true);
}

function disabledOff(selector) {
    return selector.attr('disabled', false);
}