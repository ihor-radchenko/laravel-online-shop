
$(document).ready(function () {
    var offset = 1;
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
});