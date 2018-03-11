
$(document).on('click', '.view-order', function () {
    var btn = $(this);
    $.ajax({
        url: btn.data('route'),
        data: {order: btn.data('id')},
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            $("#order-modal-body").empty().append(response.content);
            $("#order-modal").modal('show');
        },
        error: function (jqXHR) {
            $('.popup').show();
        }
    })
});