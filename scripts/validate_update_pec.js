const pec_regex = /[A-z0-9.+_-]+@[pec]+\.[a-z]{2,3}/;
const pec_maxlength = 255;

jQuery.validator.addMethod("pec_regex", function (value, element) {
    return pec_regex.test(value);
});

$().ready(function () {
    $("#update_pec_form").validate({
        rules: {
            new_pec: {
                required: true,
                maxlength: pec_maxlength,
                pec_regex: true
            }
        },
        messages: {
            new_pec: {
                required: "Inserire PEC",
                maxlength: "Superata lunghezza massima consentita: " + pec_maxlength,
                pec_regex: "Inserire PEC nel formato corretto"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
