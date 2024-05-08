(function($) {
    var form = $('#contact-form');
    var formMessages = $('#form-messages');
    var baseUrl = $('#baseUrl').val();
    $(form).submit(function(e) {
        alert();
        e.preventDefault();
        var formData = $(form).serialize();
        $.ajax({
            type: 'POST',
            url: baseUrl + 'home/contactFormSubmit',
            data: formData
        })
        .done(function(response) {
            $(formMessages).removeClass('error');
            $(formMessages).addClass('success');
            $(formMessages).text(response);
            //$('#name, #email, #phone, #subject, #message, ').val('');
            $('#contact-form')[0].reset();
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