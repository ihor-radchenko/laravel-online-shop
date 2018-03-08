$("#onDelivery").change(function () {
    $("#forAddress").slideUp(1000);
    lockPayment();
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
            $("#priceDelivery").text(0);
            $("#totalPriceWithShipping").text(response.totalPrice);
            $("#forAddress").empty().hide().append(response.content).slideDown(1000);
            unlockPayment();
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
    lockPayment();
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
    lockPayment();
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
    $("#warehouseInfo").empty();
    lockPayment();
    $.ajax({
        url: $("#warehouses").data('route'),
        type: 'GET',
        data: {warehouse: select.val()},
        dataType: 'json',
        success: function (response) {
            $("#warehouseInfo").append(response.content);
        },
        error: function (jqXHR) {
            ajaxError(jqXHR);
        }
    });
});

$(document).on('change', '#tarif_delivery', function () {
    $("#forCategories").empty();
    $.ajax({
        url: $("#tarif_delivery").data('route'),
        type: 'GET',
        data: {tarif: $(this).val()},
        dataType: 'json',
        success: function (response) {
            $("#forCategories").append(response.content);
        },
        error: function (jqXHR) {
            ajaxError(jqXHR);
        }
    });
});

$(document).on('change', '.calc-item', function () {
    var city = $("#city");
    var warehouse = $("#warehouses");
    var scheme = $("#scheme_delivery");
    var category = $("#categories_delivery");
    var dopUslugi = $(".dopUsluga:checked");

    var calc = $("#calculation");
    $("#paymentBtn").addClass('hidden');

    if (city.val() === '' || warehouse.val() === '' || scheme.val() === '' || category.val() === '') {
        calc.prop('disabled', true);
        return false;
    }

    calc.prop('disabled', false);
});

$(document).on('click', '#calculation', function () {
    var city = $("#city");
    var warehouse = $("#warehouses");
    var scheme = $("#scheme_delivery");
    var category = $("#categories_delivery");
    var dopUslugi = $(".dopUsluga:checked");

    var arrDopUslugi = [];
    dopUslugi.each(function () {
        arrDopUslugi.push($(this).val())
    });

    var calc = $(this);
    calc.prop('disabled', true);
    $.ajax({
        url: calc.data('route'),
        type: 'POST',
        data: {
            city: city.val(),
            warehouse: warehouse.val(),
            scheme: scheme.val(),
            category: category.val(),
            dopUslugi: arrDopUslugi,
        },
        success: function (response) {
            $("#priceDelivery").text(response.shippingPrice);
            $("#totalPriceWithShipping").text(response.totalPrice);
            calc.prop('disabled', false);
            unlockPayment();
        },
        error: function (jqXHR) {
            ajaxError(jqXHR);
            calc.prop('disabled', false);
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

function lockPayment() {
    return $("#paymentBtn").addClass('hidden').prop('disabled', true);
}

function unlockPayment() {
    return $("#paymentBtn").removeClass('hidden').prop('disabled', false);
}