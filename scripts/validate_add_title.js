const title_name_regex = /^[a-zA-Z ]{1,255}$/;
const title_notes_regex = /^[a-zA-Z0-9 .,;]{1,255}$/;
const title_grade_regex = /^[0-9]{1,3}$/;
const title_name_maxlength = 255;
const title_notes_maxlength = 255;
const title_grade_maxlength = 3;

jQuery.validator.addMethod("title_name_regex", function (value, element) {
    return title_name_regex.test(value);
});

jQuery.validator.addMethod("title_notes_regex", function (value, element) {
    return title_notes_regex.test(value);
});

jQuery.validator.addMethod("title_grade_regex", function (value, element) {
    return title_grade_regex.test(value);
});

$().ready(function () {
    $("#add_title_form").validate({
        rules: {
            name: {
                required: true,
                maxlength: title_name_maxlength,
                title_name_regex: true
            },
            notes: {
                maxlength: title_notes_maxlength,
                title_notes_regex: true
            },
            grade: {
                maxlength: title_grade_maxlength,
                title_grade_regex: true
            }
        },
        messages: {
            name: {
                required: "Inserire nome titolo",
                maxlength: "Superata lunghezza massima consentita" + title_name_maxlength,
                title_name_regex: "Inserire nome nel formato corretto"
            },
            notes: {
                maxlength: "Superata lunghezza massima consentita" + title_notes_maxlength,
                title_notes_regex: "Inserire note nel formato corretto"
            },
            grade: {
                maxlength: "Superata lunghezza massima consentita" + title_grade_maxlength,
                title_grade_regex: "Inserire voto nel formato corretto"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
