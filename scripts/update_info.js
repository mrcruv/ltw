var current_value;

$(document).ready(function () {

    $('.edit').click(function () {
        var id = $(this).attr('id');
        var array = id.split("_");
        current_value = $('#text_' + array[0]).val();
        $('#text_' + array[0]).prop('disabled', false);
        $('#text_' + array[0]).removeClass("hiddenborder");
        $(this).parents("li").find(".edit, .save, .cancel").toggle();
        $(this).parents("li").find(".delete").hide();
    });

    $('.save').click(function () {
        var id = $(this).attr('id');
        var array = id.split("_");
        $('#text_' + array[0]).prop('disabled', true);
        $('#text_' + array[0]).addClass("hiddenborder");
        $(this).parents("li").find(".edit, .save, .cancel").toggle();
        $(this).parents("li").find(".delete").show();
    });

    $('.cancel').click(function () {
        var id = $(this).attr('id');
        var array = id.split("_");
        $('#text_' + array[0]).val(current_value);
        $('#text_' + array[0]).prop('disabled', true);
        $('#text_' + array[0]).addClass("hiddenborder");
        $(this).parents("li").find(".edit, .cancel, .save").toggle();
        $(this).parents("li").find(".delete").show();
    });
});
