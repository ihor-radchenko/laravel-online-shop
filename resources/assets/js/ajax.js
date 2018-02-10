
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
            $('.popup').fadeIn('slow');
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
        data: {
            name: $("#name").val(),
            title: $("#title").val(),
            text: $("#text").val(),
            rating: $("input[name=rating]:checked").val(),
            product_id: $("#productId").val(),
            _token: $("input[name=_token]").val()
        },
        success: function (response) {
            $(response).hide().appendTo(".forAddReview").fadeIn(1000);

            let count = +countDOM.text();
            countDOM.text(++count);

            btn.text(btn.data('text')).attr('disabled', false);
        },
        error: function (jqXHR) {
            if (jqXHR.status === 422) {
                let response = $.parseJSON(jqXHR.responseText).errors;
                showErrorByForm(response);
            } else {
                $('.popup').fadeIn('slow');
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
            $('.popup').fadeIn('slow');
            btn.text(btn.data('text')).attr('disabled', false);
            offset--;
        }
    });
});

function showAjaxErrorMessage(arrayWithMessages, selectorGroup) {
    var list = "";
    for (let i = 0; i < arrayWithMessages.length; i++) {
        list += "<li>" + arrayWithMessages[i] + "</li>"
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