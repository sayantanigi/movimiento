(function($) {
    'use strict';
    var form = $('#unsubscribe-form');
    var formMessages = $('#form-messages');
    var baseUrl = $('#baseUrl').val();
    $(form).submit(function(e) {
        e.preventDefault();
        var formData = $(form).serialize();
        $.ajax({
            type: 'POST',
            url: baseUrl + 'home/EmailUnsubcribeSubmit',
            data: formData
        })
        .done(function(response) {
            if(response==0){
            $(formMessages).removeClass('success');
            $(formMessages).addClass('error');
            $(formMessages).text("Email id already exist");
            }
            else{
            // alert(response);
            $(formMessages).removeClass('error');
            $(formMessages).addClass('success');
            $(formMessages).text(response);
            }
            // $('#email').val('');
        })
        .fail(function(data) {
            $(formMessages).removeClass('success');
            $(formMessages).addClass('error');
            console.log(data);
            if (data.responseText !== '') {
                $(formMessages).text(data.responseText);
            } else {
                $(formMessages).text('Oops! An error occured and your message could not be sent.');
            }
        });
    });
})(jQuery);
