$.getScript("regex.js", function () {
});

jQuery.validator.addMethod("pec_regex", function (value, element) {
    return /pec_regex/.test(value);
});

$().ready(function () {
    $("#update_pec_form").validate({
        rules: {
            new_pec: {
                required: true,
                pec_regex: true
            }
        },
        messages: {
            new_pec: {
                required: "Inserire PEC",
                pec_regex: "Inserire PEC nel formato corretto"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
