jQuery.validator.addMethod("name_regex", function(value, element) {
    return /^[a-zA-Z0-9]{1,255}$/.test(value);
});

jQuery.validator.addMethod("area_regex", function(value, element) {
    return /^[a-zA-Z0-9 ]{1,255}$/.test(value);
});

jQuery.validator.addMethod("description_regex", function(value, element) {
    return /^[a-zA-Z0-9 .,;]{1,255}$/.test(value);
});

$().ready(function() {
    $("#add_competence_form").validate({
        rules: {
            name: {
                required: true,
                name_regex: true
            },
            area: {
                required: true,
                area_regex: true
            },
            description: {
                description_regex: true
            }
        },
        messages: {
            name: {
                required: "Inserire nome competenza",
                name_regex: "Inserire nome nel formato corretto"
            },
            area: {
                required: "Inserire area",
                area_regex: "Inserire area nel formato corretto"
            },
            description: {
                description_regex: "Inserire descrizione nel formato corretto"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
