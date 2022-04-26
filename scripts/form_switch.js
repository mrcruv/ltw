$(document).ready(function(){
    $("#expert_fields").hide();
    $("#text_expert").hide();
    $("#div_user_type").hide();
    $("#entity_button").attr("disabled", true)
    $("#expert_button").attr("disabled", false)

    $("#expert_button").click(function() {
        $("#expert_fields").show();
        $("#entity_fields").hide();
        $(this).attr("disabled", true)
        $("#entity_button").attr("disabled", false)
        $("#expert_button").attr("disabled", true)
        $("#text_expert").show();
        $("#text_entity").hide();
        $("#usertype_box").prop('checked', false);
    });

    $("#entity_button").click(function(){
        $("#expert_fields").hide();
        $("#entity_fields").show();
        $(this).attr("disabled", true)
        $("#expert_button").attr("disabled", false)
        $("#entity_button").attr("disabled", true)
        $("#text_entity").show();
        $("#text_expert").hide();
        $("#usertype_box").prop('checked', true);
    });

    $('.nav-item a').on('click', function(e) {
        e.preventDefault();
        $('.nav-item a').removeClass('active');
        $(this).addClass('active');
        $('.tab').removeClass('active');
        var tabID = $(this).attr('data-target');
        $('.tab[data-tab="' + tabID + '"]').addClass('active');
    });
});
