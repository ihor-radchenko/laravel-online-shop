
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.popup .popup-container .closePopup').click(function () {
    $('.popup').fadeOut('slow');
});

$('#btnLogout').click(function (e) {
    e.preventDefault();
    $('#logout-form').submit();
});

$(window).scroll(function () {
    if ($(this).scrollTop() > $(this).height()) {
        $('.go-top').addClass('active');
    } else {
        $('.go-top').removeClass('active');
    }
});
$('.go-top').click(function () {
    $('html, body').stop().animate({scrollTop: 0}, 'slow', 'swing');
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

$(window).scroll(function () {
    var sidebar = $("#cartSidebar");
    if ($(this).scrollTop() > 160) {
        sidebar.addClass('fixed-cart-sidebar');
    } else {
        sidebar.removeClass('fixed-cart-sidebar');
    }
});