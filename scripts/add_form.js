$(document).ready(function () {
    $(".add_form").hide();
    $("#add_button").click(function () {
        if ($(".add_form").is(":visible")) {
            $(".add_form").hide();
            $("#add_button").css("filter","brightness(1)");
        } else {
            $(".add_form").show();
            $("#add_button").css("filter","brightness(0.75)");
        }
    });
});
