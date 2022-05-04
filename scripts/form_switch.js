$(document).ready(function(){
    $("#register_expert_form").hide();
    $("#text_expert").hide();
    $("#entity_button").attr("disabled", true)
    $("#expert_button").attr("disabled", false)

    $("#expert_button").click(function() {
        $("#register_expert_form").show();
        $("#register_entity_form").hide();
        $(this).attr("disabled", true)
        $("#entity_button").attr("disabled", false)
        $("#text_expert").show();
        $("#text_entity").hide();
    });

    $("#entity_button").click(function(){
        $("#register_expert_form").hide();
        $("#register_entity_form").show();
        $(this).attr("disabled", true)
        $("#expert_button").attr("disabled", false)
        $("#text_entity").show();
        $("#text_expert").hide();
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
