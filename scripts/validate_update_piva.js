const piva_regex = /^[0-9]{11}$/;

jQuery.validator.addMethod("piva_regex", function (value, element) {
    return piva_regex.test(value);
});

$().ready(function () {
    $("#update_piva_form").validate({
        rules: {
            new_piva: {
                required: true,
                piva_regex: true
            }
        },
        messages: {
            new_piva: {
                required: "Inserire Partita IVA",
                piva_regex: "Inserire Partita IVA nel formato corretto"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
