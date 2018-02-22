
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var offset = 1;
const maxOffset = $("#maxOffset").val();

$('#showMoreReviews').click(function () {
    var btn = $(this);
    btn.text(btn.data('load')).attr('disabled', true);
    $.ajax({
        url: btn.data('route'),
        type: 'GET',
        data: {page: offset++},
        dataType: 'html',
        success: function (response) {
            $(response).hide().appendTo(".reviews-list").fadeIn(1000);
            if (offset >= maxOffset) {
                btn.remove();
            } else {
                btn.text(btn.data('text')).attr('disabled', false);
            }
        },
        error: function () {
            $('.popup').show();
            btn.text(btn.data('text')).attr('disabled', false);
            offset--;
        }
    });
});

$("#createReview").click(function (e) {
    e.preventDefault();

    var btn = $(this);
    var form = $("#formCreateReview");
    var countDOM = $('#countRating');
    hideErrorByForm(form);
    btn.text(btn.data('load')).attr('disabled', true);

    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: {
            name: $("#name").val(),
            title: $("#title").val(),
            text: $("#text").val(),
            rating: $("input[name=rating]:checked").val(),
            product_id: $("#productId").val(),
            _token: $("input[name=_token]").val()
        },
        success: function (response) {
            $(response.content).hide().appendTo(".forAddReview").fadeIn(1000);
            showAjaxCompleteAddMessage(response.message);

            let count = +countDOM.text();
            countDOM.text(++count);

            btn.text(btn.data('text')).attr('disabled', false);
        },
        error: function (jqXHR) {
            if (jqXHR.status === 422) {
                let response = $.parseJSON(jqXHR.responseText).errors;
                showErrorByForm(response);
            } else {
                $('.popup').show();
            }
            btn.text(btn.data('text')).attr('disabled', false);
        }
    });
});

$('#showMoreComments').click(function () {
    var btn = $(this);
    btn.text(btn.data('load')).attr('disabled', true);
    $.ajax({
        url: btn.data('route'),
        type: 'GET',
        data: {page: offset++},
        dataType: 'html',
        success: function (response) {
            $(response).hide().appendTo(".comments-list").fadeIn(1000);
            if (offset >= maxOffset) {
                btn.remove();
            } else {
                btn.text(btn.data('text')).attr('disabled', false);
            }
        },
        error: function () {
            $('.popup').show();
            btn.text(btn.data('text')).attr('disabled', false);
            offset--;
        }
    });
});

$("#createComment").click(function (e) {
    e.preventDefault();

    var btn = $(this);
    var form = $("#formCreateComment");
    var countDOM = $('#countComments');
    hideErrorByForm(form);
    btn.text(btn.data('load')).attr('disabled', true);

    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        dataType: 'json',
        data: {
            name: $("#name").val(),
            email: $("#email").val(),
            text: $("#text").val(),
            article_id: $("#articleId").val(),
            _token: $("input[name=_token]").val()
        },
        success: function (response) {
            $(response.content).hide().appendTo(".forAddComment").fadeIn(1000);
            showAjaxCompleteAddMessage(response.message);

            let count = +countDOM.text();
            countDOM.text(++count);

            btn.text(btn.data('text')).attr('disabled', false);
        },
        error: function (jqXHR) {
            if (jqXHR.status === 422) {
                let response = $.parseJSON(jqXHR.responseText).errors;
                showErrorByForm(response);
            } else {
                $('.popup').show();
            }
            btn.text(btn.data('text')).attr('disabled', false);
        }
    });
});

$("#registeredUserEmail").change(function () {
    var input = $(this);
    $.ajax({
        url: input.data('route'),
        type: 'GET',
        data: {email: input.val()},
        dataType: 'json',
        success: function (response) {
            if (response.hasUser) {
                input.parent().append('<span class="help-block"><strong>' + response.message + '</strong></span>').parent().addClass('has-error');
                $("button[type=submit]").attr('disabled', true);
            } else {
                input.next('.help-block').remove();
                input.parent().parent().removeClass('has-error');
                $("button[type=submit]").attr('disabled', false);
            }
        }
    });
});

function showAjaxCompleteAddMessage(text) {
    var top = $(".go-top");
    var popup = $(".popupMessage");
    top.removeClass('active');
    popup.html(text).addClass('active');
    setTimeout(function () {
        popup.removeClass('active');
        top.addClass('active');
    }, 5000)
}

function showAjaxErrorMessage(arrayWithMessages, selectorGroup) {
    var list = "";
    for (let i = 0; i < arrayWithMessages.length; i++) {
        list += "<li><strong>" + arrayWithMessages[i] + "</strong></li>"
    }
    $(selectorGroup).addClass('has-error').children(".help-block").empty().append(list);
}

function showErrorByForm(objectWithErrors) {
    for (let property in objectWithErrors) {
        if (! objectWithErrors.hasOwnProperty(property)) continue;
        showAjaxErrorMessage(objectWithErrors[property], '#group-' + property)
    }
}

function hideErrorByForm(formElem) {
    formElem.children().each(function (i, elem) {
        if ($(this).hasClass('has-error')) {
            $(this).removeClass('has-error').children('.help-block').empty();
        }
    });
}

function getProducts(url) {
    $.ajax({
        url: url,
        data: {
            type: $(".showType.active").data('show'),
            brand: $(".brandInput:checked").val() !== undefined ? $(".brandInput:checked").val() : null,
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

$(document).on('click', '.pagination a', function (e) {
    e.preventDefault();
    $('.pagination li').removeClass('active').addClass('disabled');
    $('.load').removeClass('disabled');
    let url = $(this).attr('href');
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
    getProducts(url);
    window.history.pushState('', '', url);
});

$(document).on('change', '.brandInput', function () {
    $('.load').removeClass('disabled');
    let url = '';
    url += $('#currentUrl').val() + '?page=1';
    getProducts(url);
    window.history.pushState('', '', url);
});

$('#deleteFilter').click(function () {
    $('.load').removeClass('disabled');
    $('.brandInput').prop('checked', false);

    $("#sliderPrice").slider( "option", "values", [0, $("#maxPrice").val() + 1]);
    $("#priceFrom").val(0);
    $("#priceTo").val("$" + $("#maxPrice").val() + 1);

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
    getProducts(url);
    window.history.pushState('', '', url);
    btn.removeClass('sort-asc').addClass('sort-desc').attr('title', btn.data('desc'))
        .children('.fa').removeClass('fa-sort-amount-asc').addClass('fa-sort-amount-desc');
});

$("#sliderPrice").slider({
    range: true,
    min: 0,
    max: $("#maxPrice").val() + 1,
    values: [0, $("#maxPrice").val() + 1],
    slide: function( event, ui ) {
        $("#priceFrom").val("$" + ui.values[0]);
        $("#priceTo").val("$" + ui.values[1]);
    }
});

$("#Filter").click(function () {
    $('.load').removeClass('disabled');
    let url = $('#currentUrl').val() + '?page=1';
    getProducts(url);
    window.history.pushState('', '', url);
});