$(document).ready(function(){

    $(".step1").show();
    $(".step2").hide();
    $(".step3").hide();

    $("#prev").hide();
    $(".register_button").hide();

    $( ".step1" ).addClass( "animation" );
    $( ".step2" ).addClass( "animation" );
    $( ".step3" ).addClass( "animation" );
        
    
    $("#next").click(function(){

        if($(".step1").is(":visible")){

            $(".step1").hide();

            $(".step2").show();

            $("#prev").show();
        }
        else if($(".step2").is(":visible")){

            $(".step2").hide();

            $(".step3").show();

            $("#next").hide();
            $(".register_button").show();
        }


        $("#prev").show();

    });
    
    $("#prev").click(function(){;
        
        if($(".step2").is(":visible")){

            $(".step2").hide();

            $(".step1").show();

            $("#prev").hide();
            $("#next").show();
            $(".register_button").hide();
        }
        else if($(".step3").is(":visible")){

            $(".step3").hide();

            $(".step2").show();

            $("#next").show();
            $("#prev").show();
            $(".register_button").hide();
        }
    });
});
