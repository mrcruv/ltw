jQuery.validator.addMethod("name_regex", function(value, element) {
    return /^[a-z A-Z ]{1,255}$/.test(value);
});

// jQuery.validator.addMethod("date_regex", function(value, element) {
//     return /^$/.test(value);
// });

jQuery.validator.addMethod("notes_regex", function(value, element) {
    return /^[a-zA-Z0-9 .,;]{1,255}$/.test(value);
});

jQuery.validator.addMethod("grade_regex", function(value, element) {
    return /^[0-9]{1,3}$/.test(value);
});

$().ready(function() {
    $("#add_title_form").validate({
        rules: {
            name: {
                required: true,
                name_regex: true
            },
            // date: {
            //     date_regex: true
            // },
            notes: {
                notes_regex: true
            },
            grade: {
                grade_regex: true
            }
        },
        messages: {
            name: {
                required: "Inserire nome titolo",
                name_regex: "Inserire nome nel formato corretto"
            },
            // date: {
            //     date_regex: "Inserire data nel formato corretto"
            // },
            notes: {
                notes_regex: "Inserire note nel formato corretto"
            },
            grade: {
                grade_regex: "Inserire voto nel formato corretto"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});
