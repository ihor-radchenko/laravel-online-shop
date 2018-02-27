$("#onDelivery").change(function () {
    $("#forAddress").slideUp(1000);
    $.ajax({
        url: $(this).data('route'),
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            $("#forAddress").empty().hide().append(response.content).slideDown(1000);
        },
        error: function (jqXHR) {
            ajaxError(jqXHR);
        }
    });
});

$("#offDelivery").change(function () {
    $("#forAddress").slideUp(1000);
    $.ajax({
        url: $(this).data('route'),
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            $("#forAddress").empty().hide().append(response.content).slideDown(1000);
        },
        error: function (jqXHR) {
            ajaxError(jqXHR);
        }
    });
});

$(document).on('change', '#region', function () {
    var select = $(this);
    $("#warehouseInfo").empty();
    $("#city").prop('disabled', true).empty();
    $("#warehouses").prop('disabled', true).empty();
    $.ajax({
        url: $("#region").data('route'),
        type: 'GET',
        data: {region: select.val()},
        dataType: 'json',
        success: function (response) {
            $("#city").append(response.content).prop('disabled', false);
        },
        error: function (jqXHR) {
            ajaxError(jqXHR);
        }
    });
});

$(document).on('change', '#city', function () {
    var select = $(this);
    $("#warehouseInfo").empty();
    $("#warehouses").prop('disabled', true).empty();
    $.ajax({
        url: $("#city").data('route'),
        type: 'GET',
        data: {city: select.val()},
        dataType: 'json',
        success: function (response) {
            $("#warehouses").append(response.content).prop('disabled', false);
        },
        error: function (jqXHR) {
            ajaxError(jqXHR);
        }
    });
});

$(document).on('change', '#warehouses', function () {
    var select = $(this);
    $.ajax({
        url: $("#warehouses").data('route'),
        type: 'GET',
        data: {warehouse: select.val()},
        dataType: 'json',
        success: function (response) {
            $("#warehouseInfo").empty().append(response.content);
        },
        error: function (jqXHR) {
            ajaxError(jqXHR);
        }
    });
});

function ajaxError(jqXHR) {
    if (jqXHR.status === 501) {
        $('.popup h4').empty().append(jqXHR.responseJSON.message);
        $('.popup').show();
    } else {
        $('.popup h4').empty().append($("#ajaxError").data('error'));
        $('.popup').show();
    }
}