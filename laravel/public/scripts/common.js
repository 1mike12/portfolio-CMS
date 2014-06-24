$(document).ready(function() {
//homepage
    var $blink = $(".blinking");
    setInterval(function() {
        $blink.fadeOut("500").fadeIn("500");
    }, 1200);
    //project list page

    var $zaccordion_settings = {
        tabWidth:"5%",
        width: "100%",
        auto:false,
        height: 310,
        easing:"jswing",
        speed:200
    };
    $("#accordion").zAccordion($zaccordion_settings);
});
