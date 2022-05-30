var current_cf;
var current_piva;
var current_website;
var current_pec;
var current_entityName;
var current_entityType;

$(document).ready(function () {

    if ($("#text_website").val() == 'N.D.') {
        $(".delete").hide();
    } else {
        $(".delete").show();
    }

    $('.edit').click(function () {
        var id = $(this).attr('id');
        var array = id.split("_");
        if (array[0] == 'cf') {
            current_cf = $('#text_' + array[0]).val();
        }
        if (array[0] == 'piva') {
            current_piva = $('#text_' + array[0]).val();
        }
        if (array[0] == 'website') {
            current_website = $('#text_' + array[0]).val();
        }
        if (array[0] == 'pec') {
            current_pec = $('#text_' + array[0]).val();
        }
        if (array[0] == 'entityName') {
            current_entityName = $('#text_' + array[0]).val();
        }
        if (array[0] == 'entityType') {
            current_entityType = $('#text_' + array[0]).val();
        }
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

        if (array[0] == 'cf') {
            $('#text_' + array[0]).val(current_cf);
        }
        if (array[0] == 'piva') {
            $('#text_' + array[0]).val(current_piva);
        }
        if (array[0] == 'website') {
            $('#text_' + array[0]).val(current_website);
        }
        if (array[0] == 'pec') {
            $('#text_' + array[0]).val(current_pec);
        }
        if (array[0] == 'entityName') {
            $('#text_' + array[0]).val(current_entityName);
        }
        if (array[0] == 'entityType') {
            $('#text_' + array[0]).val(current_entityType);
        }
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

