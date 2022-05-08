$(document).ready(function() { 
    $(".add_form").hide();                      
    $("#add_button").click(function() {
        if($(".add_form").is(":visible")){
            $(".add_form").hide();
        }
        else{
            $(".add_form").show();
        }
      
    });
});
