const cf_regex = /[A-Za-z]{6}[0-9lmnpqrstuvLMNPQRSTUV]{2}[abcdehlmprstABCDEHLMPRST]{1}[0-9lmnpqrstuvLMNPQRSTUV]{2}[A-Za-z]{1}[0-9lmnpqrstuvLMNPQRSTUV]{3}[A-Za-z]{1}/;
const cf_maxlength = 9;

jQuery.validator.addMethod("cf_regex", function (value, element) {
    return cf_regex.test(value);
});

$().ready(function () {
    $("#update_cf_form").validate({
        rules: {
            new_cf: {
                required: true,
                maxlength: cf_maxlength,
                cf_regex: true
            }
        },
        messages: {
            new_cf: {
                required: "Inserire Codice Fiscale",
                maxlength: "Superata lunghezza massima consentita" + cf_maxlength,
                cf_regex: "Inserire Codice Fiscale nel formato corretto"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});

