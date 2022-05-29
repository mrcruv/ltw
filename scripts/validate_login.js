$().ready(function () {
    $("#login_form").validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true
            }
        },
        messages: {
            username: {
                required: "Inserire username",
            },
            password: {
                required: "Inserire password",
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});
