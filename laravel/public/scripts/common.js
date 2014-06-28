$(document).ready(function() {
    window.scrollTimeout;
    var $window = $(window);
    //homepage=============
    var $blink = $(".blinking");
    setInterval(function() {
        $blink.fadeOut("500").fadeIn("500");
    }, 1000);

    //sticky header------------------
    var $header = $("#header");
    var paddingTopOG = $header.css("padding-top");
    var opacityOG = $header.css("opacity");
    var heightOG = $header.css("height");

    function stickyHeader() {
        var st = $window.scrollTop();
        if (st > 30) {
            $header.stop().animate({
                opacity: 0.99,
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
    }

    $window.scroll(function() {
        if (window.scrollTimeout) {
            clearTimeout(window.scrollTimeout);
            window.scrollTimeout = null;
        }
        window.scrollTimeout = setTimeout(stickyHeader, 250);
    });
});
