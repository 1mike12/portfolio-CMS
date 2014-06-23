$(document).ready(function() {

    //Adding new photo fields
    $("#contentWrapper").on("click", ".addNewPhoto", function() {
        var project_id= $(this).attr("project_id");
        $.ajax({
            url: ADMIN + "photo/photofield",
            type: "GET",
            success: function(data, status) {
                var field= $(data);
                field.find("input[name='project_id']").val(project_id);
                $("#photoFormWrapper").append(field);
            }
        });
    });

    //deleting photo fields
    $("#photoFormWrapper").on("click", ".photoDelete", function() {
        var del = $(this);
        var id = del.closest(".photoForm").find("input[name='id']").val();
        var url = ADMIN + "photo/delete";
        if (id === "") {
            del.closest(".photoForm").remove();
        } else {
            //send some ajax to remove photo
            $.ajax({
                url: url,
                type: "POST",
                data: id,
                success: function(payload, status) {
                    if(payload.success){
                        del.closest(".photoForm").remove();
                    }else{
                        console.log(payload.messages);
                    }
                },
                error: function(payload, status) {
                }
            });
        }
    });

    //submitting photos
    $("#photoFormWrapper").on("submit", ".photoForm", function(e) {
        e.preventDefault();

        var form = $(this);
        var img= form.find(".photoFieldThumbnail");
        img.attr("src", PUBLIC + "assets/loader.gif" );
        var file = form.find("input[name='photo']");
        var submitButton = form.find(".photoSubmit");
        var errorDiv = form.find(".bg-warning");

        var fd = new FormData(e.target);
        var id = form.find("input[name='id']");

        //creating a photo
        if (id.val() === "") {
            var url = ADMIN + "photo/create";
            $.ajax({
                url: url,
                type: "POST",
                data: fd,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                success: function(payload, status) {
                    img.attr("src", payload.data.path);
                    id.val(payload.data.id);
                    console.log(payload);
                },
                error: function(payload, status) {
                    submitButton.button("reset");
                    submitButton.closest(".photoForm").find(".bg-warning").html(url + "not found, 404 error, -1mike12");
                }
            });
        }
    });
});
