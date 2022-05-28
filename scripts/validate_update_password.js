const password_regex = /^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/;
const password_minlength = 8;
const password_maxlength = 24; // bcrypt supports max 72 Byte, in MySQL 1 char takes up from 1 Byte to 3 Byte

jQuery.validator.addMethod("password_regex", function (value, element) {
    return password_regex.test(value);
});

$().ready(function () {
    $("#update_password_form").validate({
        rules: {
            old_password: {
                required: true
            },
            new_password: {
                required: true,
                minlength: password_minlength,
                maxlength: password_maxlength,
                password_regex: true
            }
        },
        messages: {
            new_password: {
                required: "Inserire la nuova password",
                minlength: "Lunghezza minima non raggiunta: " + password_minlength,
                maxlength: "Superata lunghezza massima consentita" + password_maxlength,
                password_regex: "La password deve essere lunga almeno 8 caratteri. <br> Inserire:<br>- Almeno un carattere alfanumerico minuscolo<br>- Almeno un carattere alfanumerico maiuscolo<br>- Almeno un carattere numerico<br>- Almeno un carattere speciale"
            },
            old_password: {
                required: "Inserire la password attuale"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
