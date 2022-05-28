$(document).ready(function () {
    $("#register_expert_form").hide();
    $("#entity_button").attr("disabled", true)
    $("#expert_button").attr("disabled", false)
    $("#expert_button").click(function () {
        $("#register_expert_form").show();
        $("#register_entity_form").hide();
        $(this).attr("disabled", true);
        $("#entity_button").attr("disabled", false);
        $("#entity_button").removeClass("selected");
        $("#expert_button").addClass("selected");
    });
    $("#entity_button").click(function () {
        $("#register_expert_form").hide();
        $("#register_entity_form").show();
        $(this).attr("disabled", true);
        $("#expert_button").attr("disabled", false);
        $("#expert_button").removeClass("selected");
        $("#entity_button").addClass("selected");
    });
    $('.nav-item a').on('click', function (e) {
        e.preventDefault();
        $('.nav-item a').removeClass('active');
        $(this).addClass('active');
        $('.tab').removeClass('active');
        var tabID = $(this).attr('data-target');
        $('.tab[data-tab="' + tabID + '"]').addClass('active');
    });
});
