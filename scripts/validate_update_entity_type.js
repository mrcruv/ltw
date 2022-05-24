jQuery.validator.addMethod("entity_type_regex", function (value, element) {
    return /^(pubblico|privato)$/.test(value);
});

$().ready(function () {
    $("#update_entity_type_form").validate({
        rules: {
            new_entity_type: {
                required: true,
                entity_type_regex: true
            }
        },
        messages: {
            new_entity_type: {
                required: "Inserire tipo ente",
                entity_type_regex: "Inserire tipo ente nel formato corretto"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
