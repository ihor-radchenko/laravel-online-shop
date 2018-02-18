
$(document).on("click", ".addItemToCart", function () {
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
            $("#cartCount").text(response.totalQuantity);
        },
        error: function () {
            $('.popup').show();
        }
    })
});