jQuery.validator.addMethod("name_regex", function(value, element) {
    return /^[a-zA-Z0-9]{1,255}$/.test(value);
});

jQuery.validator.addMethod("type_regex", function(value, element) {
    return /^[a-zA-Z0-9 ]{1,255}$/.test(value);
});

jQuery.validator.addMethod("description_regex", function(value, element) {
    return /^[a-zA-Z0-9 .,;]{1,255}$/.test(value);
});

$().ready(function() {
    $("#add_process_form").validate({
        rules: {
            name: {
                required: true,
                name_regex: true
            },
            type: {
                required: true,
                type_regex: true
            },
            description: {
                required: true,
                description_regex: true
            }
        },
        messages: {
            name: {
                required: "Inserire nome processo",
                name_regex: "Inserire nome nel formato corretto"
            },
            type: {
                required: "Inserire tipo",
                type_regex: "Inserire tipo nel formato corretto"
            },
            description: {
                required: "Inserire descrizione",
                description_regex: "Inserire descrizione nel formato corretto"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
