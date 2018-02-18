
$(document).on("click", ".addItemToCart", function () {
    var btns = $(".addItemToCart");
    btns.attr('disabled', true);
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
            btns.attr('disabled', false);
            $("#cartCount").text(response.totalQuantity);
        },
        error: function () {
            btns.attr('disabled', false);
            $('.popup').show();
        }
    })
});