
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