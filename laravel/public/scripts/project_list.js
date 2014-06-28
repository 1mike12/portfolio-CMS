//project-list============================
$(document).ready(function() {
    var $thumbWrap = $("#projectListThumbWrap");
    var $window = $(window);
//==============================================
//
//zaccordion---------------
    var $zaccordion_settings = {
        tabWidth: "5%",
        width: "100%",
        auto: false,
        height: 310,
        easing: "jswing",
        speed: 200
    };
    $("#accordion").zAccordion($zaccordion_settings);
//isotope resposnive activation-----------
    var isotopeActive = false;

    function isotopeSwitch() {
        var width = $window.width();
        if (width <= 768 && isotopeActive === true) {
            isotopeActive = false;
            $thumbWrap.isotope("destroy");
        } else if (width > 768 && isotopeActive === false) {
            $thumbWrap.isotope({
                itemSelector: '.projectListThumbEpi',
                layoutMode: 'fitRows',
                getSortData: {
                    name: '.name',
                    weight: '.weight',
                    startDate: '.startDate',
                }
            }
            );
            isotopeActive = true;
        }
    }
    isotopeSwitch();
    $window.resize(function() {
        if (window.scrollTimeout) {
            clearTimeout(window.scrollTimeout);
            window.scrollTimeout = null;
        }
        window.scrollTimeout = setTimeout(isotopeSwitch, 250);
    });
//chart sorting--------------
    var $accordion = $("#accordion");
    $accordion.on("click", ".bar", function() {
        var $bar = $(this);
        if ($bar.hasClass("active")) {
            $bar.removeClass("active");
        } else {
            $bar.addClass("active");
        }
        amplify.publish("chartChange");
    });

    amplify.subscribe("chartChange", function() {
        var $selected = $(".bar.active");
        var selectedIDs = [];
        $selected.each(function() {
            var id = $(this).attr("skill_id");
            if (id) {
                selectedIDs.push(id);
            }
        });
        amplify.publish("chartSkills", selectedIDs);
    });

    amplify.subscribe("chartSkills", function(selectedIDs) {
        $thumbWrap.isotope({
            filter: function() {
                var skillIDString = $(this).find(".skills").text();
                var skillIDs = skillIDString.split(",");

                for (var i = 0; i < selectedIDs.length; i++) {
                    var currentID = selectedIDs[i];
                    if (!$.inArray(currentID, skillIDs)) {
                        return false;
                    }
                }
                return true;
            }
        });
    });

//isotope buttons--------------------
    $("#sortWeight").click(function(e) {
        amplify.publish("isotopeSort", {name: "weight", element: $(this)});
    });
    $("#sortName").click(function(e) {
        amplify.publish("isotopeSort", {name: "name", element: $(this)});
    });
    $("#sortDate").click(function(e) {
        amplify.publish("isotopeSort", {name: "startDate", element: $(this)});
    });
    function removeButtonStates() {
        $(".isotopeUI")
            .removeClass("ascending")
            .removeClass("descending")
            .removeClass("active");
    }
    amplify.subscribe("isotopeSort", function(payload) {
        var button = payload.element;

        if (button.hasClass("ascending")) {
            removeButtonStates();
            button.addClass("descending");
            $thumbWrap.isotope({sortBy: payload.name, sortAscending: false});
        } else {
            removeButtonStates();
            button.addClass("ascending");
            $thumbWrap.isotope({sortBy: payload.name, sortAscending: true});
        }
        button.addClass("active");
    });

//projectThumbFade
    var $contentWrapper = $("#contentWrapper");
    $contentWrapper.on("mouseenter", ".projectThumbFade", function() {
        $(this).animate({opacity: .9}, 200);
    });

    $contentWrapper.on("mouseleave", ".projectThumbFade", function() {
        $(this).animate({opacity: 0.0}, 200);
    });
});
