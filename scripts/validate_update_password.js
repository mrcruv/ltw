jQuery.validator.addMethod("password_regex", function(value, element) {
    return /^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/.test(value);
});

$().ready(function() {
    $("#update_password_form").validate({
        rules : {
            new_password : {
                required: true,
                password_regex: true
            }
        },
        messages: {
            new_password : {
                required: "Inserire password",
                password_regex: "La password deve essere lunga almeno 8 caratteri. <br> Inserire:<br>- Almeno un carattere alfanumerico minuscolo<br>- Almeno un carattere alfanumerico maiuscolo<br>- Almeno un carattere numerico<br>- Almeno un carattere speciale"
            }
        },
        // Settiamo il submit handler per la form
        submitHandler: function(form) {
            form.submit();
        }
    });
});
