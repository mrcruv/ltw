const website_regex = /^((https?|ftp|smtp):\/\/)(www.)[a-z0-9]+\.[a-z]+(\/[a-zA-Z0-9#]+\/?)*$/;

jQuery.validator.addMethod("website_regex", function (value, element) {
    return website_regex.test(value);
});

$().ready(function () {
    $("#update_website_form").validate({
        rules: {
            new_website: {
                required: true,
                website_regex: true
            }
        },
        messages: {
            new_website: {
                required: "Inserire sito web",
                website_regex: "Inserire sito web nel formato corretto"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
