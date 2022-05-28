const competence_name_regex = /^[a-zA-Z0-9]{1,255}$/;
const competence_area_regex = /^[a-zA-Z0-9 ]{1,255}$/;
const competence_description_regex = /^[a-zA-Z0-9 .,;]{1,255}$/;
const competence_name_maxlength = 255;
const competence_area_maxlength = 255;
const competence_description_maxlength = 255;

jQuery.validator.addMethod("competence_name_regex", function (value, element) {
    return competence_name_regex.test(value);
});

jQuery.validator.addMethod("competence_area_regex", function (value, element) {
    return competence_area_regex.test(value);
});

jQuery.validator.addMethod("competence_description_regex", function (value, element) {
    return competence_description_regex.test(value);
});

$().ready(function () {
    $("#add_competence_form").validate({
        rules: {
            name: {
                required: true,
                competence_name_regex: true
            },
            area: {
                required: true,
                competence_area_regex: true
            },
            description: {
                competence_description_regex: true
            }
        },
        messages: {
            name: {
                required: "Inserire nome competenza",
                maxlength: "Superata lunghezza massima consentita: " + competence_name_maxlength,
                competence_name_regex: "Inserire nome nel formato corretto"
            },
            area: {
                required: "Inserire area",
                maxlength: "Superata lunghezza massima consentita: " + competence_area_maxlength,
                competence_area_regex: "Inserire area nel formato corretto"
            },
            description: {
                maxlength: "Superata lunghezza massima consentita: " + competence_description_maxlength,
                competence_description_regex: "Inserire descrizione nel formato corretto"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
