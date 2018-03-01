
$(document).on('click', '.pagination a', function (e) {
    e.preventDefault();
    $('.pagination li').removeClass('active').addClass('disabled');
    $('.load').removeClass('disabled');
    let url = $(this).attr('href');
    url += brandInUrl();
    getProducts(url);
    window.history.pushState('', '', url);
});

const buttons = $(".showType");
buttons.click(function () {
    buttons.each(function () {
        $(this).removeClass('active');
    });
    $(this).addClass('active');
    $('.load').removeClass('disabled');
    let url = '';
    let paginate = $('.pagination .active').data('url');
    if (paginate !== undefined) {
        url += paginate;
    } else {
        url += $('#currentUrl').val();
    }
    url += brandInUrl();
    getProducts(url);
    window.history.pushState('', '', url);
});

$(document).on('change', '.brandInput', function () {
    $('.load').removeClass('disabled');
    let url = '';
    url += $('#currentUrl').val() + '?page=1';
    url += brandInUrl();
    getProducts(url);
    window.history.pushState('', '', url);
});

$('#deleteFilter').click(function () {
    $('.load').removeClass('disabled');
    $('.brandInput').prop('checked', false);

    $("#sliderPrice").slider( "option", "values", [0, Math.ceil(+$("#maxPrice").val())]);
    $("#priceFrom").val(0);
    $("#priceTo").val(Math.ceil(+$("#maxPrice").val()));

    let url = $('#currentUrl').val() + '?page=1';
    $('#sort_type').val(undefined);
    getProducts(url);
    window.history.pushState('', '', url);
});

$(document).on('click', '.sort-desc', function () {
    $('.load').removeClass('disabled');
    let btn = $(this);
    let url = $('#currentUrl').val() + '?page=1';
    $('#sort_type').val('desc');
    url += brandInUrl();
    getProducts(url);
    window.history.pushState('', '', url);
    btn.removeClass('sort-desc').addClass('sort-asc').attr('title', btn.data('asc'))
        .children('.fa').removeClass('fa-sort-amount-desc').addClass('fa-sort-amount-asc');
});

$(document).on('click', '.sort-asc', function () {
    $('.load').removeClass('disabled');
    let btn = $(this);
    let url = $('#currentUrl').val() + '?page=1';
    $('#sort_type').val('asc');
    url += brandInUrl();
    getProducts(url);
    window.history.pushState('', '', url);
    btn.removeClass('sort-asc').addClass('sort-desc').attr('title', btn.data('desc'))
        .children('.fa').removeClass('fa-sort-amount-asc').addClass('fa-sort-amount-desc');
});

$("#sliderPrice").slider({
    range: true,
    min: 0,
    max: Math.ceil(+$("#maxPrice").val()),
    values: [0, Math.ceil(+$("#maxPrice").val())],
    slide: function( event, ui ) {
        $("#priceFrom").val(ui.values[0]);
        $("#priceTo").val(ui.values[1]);
    }
});

$("#Filter").click(function () {
    $('.load').removeClass('disabled');
    let url = $('#currentUrl').val() + '?page=1';
    url += brandInUrl();
    getProducts(url);
    window.history.pushState('', '', url);
});

function getProducts(url) {
    $.ajax({
        url: url,
        data: {
            type: $(".showType.active").data('show'),
            sort: $('#sort_type').val() !== undefined ? $('#sort_type').val() : null,
            price: {
                min: $("#priceFrom").val(),
                max: $("#priceTo").val()
            }
        },
        success: function (response) {
            $('.load').addClass('disabled');
            $(".products-list").empty().append(response);
        },
        error: function () {
            $('.load').addClass('disabled');
            $('.popup').show();
        }
    });
}

function brandInUrl() {
    return $(".brandInput:checked").val() !== undefined
        ? "&brand=" + $(".brandInput:checked").val()
        : "";
}