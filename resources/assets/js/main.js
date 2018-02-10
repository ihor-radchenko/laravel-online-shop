
$('.popup .popup-container .closePopup').click(function () {
    $('.popup').fadeOut('slow');
});

$('#btnLogout').click(function (e) {
    e.preventDefault();
    $('#logout-form').submit();
});