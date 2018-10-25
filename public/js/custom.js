$(document).ready(function () {
    var options = {
        beforeSubmit: showRequest,
        success: showResponse,
        dataType: 'json'
    };

    $('#my_image').change(function () {
        $('#upload').ajaxForm(options).submit();
    });

});

function showRequest(formData, jqForm, options) {

    $("#validation-errors").hide().empty();

    return true;
}

function showResponse(response, statusText, xhr, $form) {
    if (response.success == false) {
        var arr = response.errors;
        $.each(arr, function (index, value) {
            if (value.length != 0) {
                $("#validation-errors").append('<div class="alert alert-error"><strong>' + value + '</strong><div>');
            }
        });
        $("#validation-errors").show();
    } else {
        // this will preview your uploaded file
        $("#user-profile").attr('src', response.file);
    }
}