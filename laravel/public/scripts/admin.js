$(document).ready(function() {
    $("#contentWrapper").on("click", ".addNewPhoto", function() {
        $.ajax({
            url: ADMIN + "photo/photofield",
            type: "GET",
            success: function(data, status) {
                $("#photoFormWrapper").prepend(data);
            },
            error: function(xhr, desc, err) {
            }
        });
    });
});