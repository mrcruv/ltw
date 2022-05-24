const cf_regex = /[A-Za-z]{6}[0-9lmnpqrstuvLMNPQRSTUV]{2}[abcdehlmprstABCDEHLMPRST]{1}[0-9lmnpqrstuvLMNPQRSTUV]{2}[A-Za-z]{1}[0-9lmnpqrstuvLMNPQRSTUV]{3}[A-Za-z]{1}/;

jQuery.validator.addMethod("cf_regex", function (value, element) {
    return cf_regex.test(value);
});

$().ready(function () {
    $("#update_cf_form").validate({
        rules: {
            new_cf: {
                required: true,
                cf_regex: true
            }
        },
        messages: {
            new_cf: {
                required: "Inserire Codice Fiscale",
                cf_regex: "Inserire Codice Fiscale nel formato corretto"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});

