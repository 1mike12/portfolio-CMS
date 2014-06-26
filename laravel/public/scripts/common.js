$(document).ready(function() {
//homepage=============
    var $blink = $(".blinking");
    setInterval(function() {
        $blink.fadeOut("500").fadeIn("500");
    }, 1200);
    //project list page

    var $zaccordion_settings = {
        tabWidth: "5%",
        width: "100%",
        auto: false,
        height: 310,
        easing: "jswing",
        speed: 200
    };
    $("#accordion").zAccordion($zaccordion_settings);


    //sticky header
    var $header = $("#header");
    var paddingTopOG = $header.css("padding-top");
    var opacityOG = $header.css("opacity");
    var heightOG = $header.css("height");

    $(window).scroll(function() {
        var st = $(window).scrollTop();
        if (st > 30) {
            $header.stop().animate({
                opacity: 0.95,
                paddingTop: 5,
                paddingBottom: 5,
                height: 40
            }, 300);
        } else {
            $header.stop().animate({
                opacity: opacityOG,
                paddingTop: paddingTopOG,
                paddingBottom: paddingTopOG,
                height: heightOG
            }, 300);
        }
    });

//project-list============================
    //projectThumbFade
    $("#contentWrapper").on("mouseenter", ".projectThumbFade", function(){
        $(this).animate({opacity:.9},200);
    });
    
    $("#contentWrapper").on("mouseleave", ".projectThumbFade", function(){
        $(this).animate({opacity:0.0},200);
    });

});
