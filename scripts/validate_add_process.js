const process_name_regex = /^[a-zA-Z0-9]{1,255}$/;
const process_type_regex = /^[a-zA-Z0-9 ]{1,255}$/;
const process_description_regex = /^[a-zA-Z0-9 .,;]{1,255}$/;

jQuery.validator.addMethod("process_name_regex", function (value, element) {
    return process_name_regex.test(value);
});

jQuery.validator.addMethod("process_type_regex", function (value, element) {
    return process_type_regex.test(value);
});

jQuery.validator.addMethod("process_description_regex", function (value, element) {
    return process_description_regex.test(value);
});

$().ready(function () {
    $("#add_process_form").validate({
        rules: {
            name: {
                required: true,
                process_name_regex: true
            },
            type: {
                required: true,
                process_type_regex: true
            },
            description: {
                required: true,
                process_description_regex: true
            }
        },
        messages: {
            name: {
                required: "Inserire nome processo",
                process_name_regex: "Inserire nome nel formato corretto"
            },
            type: {
                required: "Inserire tipo",
                process_type_regex: "Inserire tipo nel formato corretto"
            },
            description: {
                required: "Inserire descrizione",
                process_description_regex: "Inserire descrizione nel formato corretto"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
