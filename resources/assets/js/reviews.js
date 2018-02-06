
$(document).ready(function () {
    var offset = 1;
    var maxOffset = $("#maxOffset").val();
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
        btn.text(btn.data('load')).attr('disabled', true);
        $.ajax({
            url: $("#formCreateReview").attr('action'),
            type: 'POST',
            dataType: 'html',
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
                btn.text(btn.data('text')).attr('disabled', false);
            },
            error: function () {
                $('.popup').fadeIn('slow');
                btn.text(btn.data('text')).attr('disabled', false);
            }
        });
    })
});