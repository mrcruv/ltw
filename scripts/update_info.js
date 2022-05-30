var current_value;

$(document).ready(function () {

    if ($("#text_website").val() == 'N.D.') {
        $(".delete").hide();
    } else {
        $(".delete").show();
    }

    $('.edit').click(function () {
        var id = $(this).attr('id');
        var array = id.split("_");
        current_value = $('#text_' + array[0]).val();
        $('#text_' + array[0]).prop('disabled', false);
        if ($('#text_' + array[0]).val() == 'N.D.') {
            $('#text_' + array[0]).val('');
        }
        $('#text_' + array[0]).removeClass("hiddenborder");
        $(this).parents("li").find(".edit, .save, .cancel").toggle();
        if (array[0] == 'website') {
            $(".delete").hide();
        }

    });

    $('.save').click(function () {
        var id = $(this).attr('id');
        var array = id.split("_");
        $('#text_' + array[0]).prop('disabled', true);
        $('#text_' + array[0]).addClass("hiddenborder");
        $(this).parents("li").find(".edit, .save, .cancel").toggle();
    });

    $('.cancel').click(function () {
        var id = $(this).attr('id');
        var array = id.split("_");

        $(this).parents("li").find(".update").validate().resetForm();

        $('#text_' + array[0]).val(current_value);
        $('#text_' + array[0]).prop('disabled', true);
        $('#text_' + array[0]).addClass("hiddenborder");
        $(this).parents("li").find(".edit, .cancel, .save").toggle();
        if (array[0] == 'website') {
            if ($("#text_website").val() == 'N.D.') {
                $(".delete").hide();
            } else {
                $(".delete").show();
            }
        }

    });

    $('.delete').click(function () {
        $(".delete").hide();
    });
});

