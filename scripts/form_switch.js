function switch_form_handler() {
    $("#expert_button").click(function() {
        $("#expert_fields").show();
        $("#entity_fields").hide();
        $(this).attr("disabled", true)
        $("#entity_button").attr("disabled", false)
        $("#register_user_type").prop('checked', false);
    })
    $("#entity_button").click(function(){
        $("#expert_fields").hide();
        $("#entity_fields").show();
        $(this).attr("disabled", true)
        $("#expert_button").attr("disabled", false)
        $("#register_user_type").prop('checked', true);
    })
}
