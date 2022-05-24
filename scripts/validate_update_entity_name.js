const entity_name_regex = /^[a-zA-Z0-9]{1,30}$/;

jQuery.validator.addMethod("entity_name_regex", function (value, element) {
    return entity_name_regex.test(value);
});

$().ready(function () {
    $("#update_entity_name_form").validate({
        rules: {
            new_entity_name: {
                required: true,
                entity_name_regex: true
            }
        },
        messages: {
            new_entity_name: {
                required: "Inserire denominazione",
                entity_name_regex: "Inserire denominazione nel formato corretto"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
