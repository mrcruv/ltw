const title_name_regex = /^[a-zA-Z ]{1,255}$/;
const title_notes_regex = /^[a-zA-Z0-9 .,;]{1,255}$/;
const title_grade_regex = /^[0-9]{1,3}$/;
//const title_date_regex = /^$/;

jQuery.validator.addMethod("title_name_regex", function (value, element) {
    return title_name_regex.test(value);
});

// jQuery.validator.addMethod("title_date_regex", function(value, element) {
//     return title_date_regex.test(value);
// });

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
                title_name_regex: true
            },
            // date: {
            //     title_date_regex: true
            // },
            notes: {
                title_notes_regex: true
            },
            grade: {
                title_grade_regex: true
            }
        },
        messages: {
            name: {
                required: "Inserire nome titolo",
                title_name_regex: "Inserire nome nel formato corretto"
            },
            // date: {
            //     title_date_regex: "Inserire data nel formato corretto"
            // },
            notes: {
                title_notes_regex: "Inserire note nel formato corretto"
            },
            grade: {
                title_grade_regex: "Inserire voto nel formato corretto"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
