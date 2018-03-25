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

function hideErrorByForm(formElem) {
    formElem.children().each(function (i, elem) {
        if ($(this).hasClass('has-error')) {
            $(this).removeClass('has-error').children('.help-block').empty();
        }
    });
}

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

$(document).on('click', '.confirm-delete-comment', function () {
    $(this).parent().parent().children('.shade').addClass('active');
});

$(document).on('click', '.btn-no-delete-comment', function () {
    $(this).parent().parent().parent().removeClass('active');
});

$(document).on('click', '.btn-delete-comment', function () {
    var btn = $(this);
    $.ajax({
        url: btn.data('route'),
        type: 'DELETE',
        success: function (response) {
            if (response.status) {
                btn.parent().parent().parent().parent().remove();
            }
        }
    })
});

$(document).on('click', '.btn-update-comment', function () {
    var btn = $(this);
    $.ajax({
        url: btn.data('route'),
        type: 'PUT',
        data: {
            text: $("#update-text-" + btn.data('id')).val()
        },
        success: function (response) {
            $("#modal-" + btn.data('id')).modal('hide');
            $("#text-" + btn.data('id')).empty().append(response.text);
        }
    })
});