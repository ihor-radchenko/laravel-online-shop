$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    $('.popup .popup-container .closePopup').click(function () {
        $('.popup').fadeOut('slow');
    });
});