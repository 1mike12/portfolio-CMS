$(document).ready(function() {

    //Adding new photo fields
    $("#contentWrapper").on("click", ".addNewPhoto", function() {
        var project_id = $(this).attr("project_id");
        $.ajax({
            url: ADMIN + "photo/photofield",
            type: "GET",
            success: function(data, status) {
                var field = $(data);
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
                data: {"id": id},
                success: function(payload, status) {
                    if (payload.success) {
                        del.closest(".photoForm").remove();
                    } else {
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
        var img = form.find(".photoFieldThumbnail");
        var imgOG = img.attr("src");
        var imgOGPath = img.attr("src");

        var file = form.find("input[name='photo']");
        var submitButton = form.find(".photoSubmit");
        var errorDiv = form.find(".errorMessage");
        errorDiv.html("");//reset the error message

        var fd = new FormData(e.target);
        var id = form.find("input[name='id']");

        //creating a photo////////////////////////////
        if (id.val() === "") {
            //change image to spinner
            img.attr("src", PUBLIC + "assets/loader.gif");
            var url = ADMIN + "photo/create";
            $.ajax({
                url: url,
                type: "POST",
                data: fd,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                success: function(payload, status) {
                    if (payload.success) {//image uploaded
                        img.attr("src", payload.data.path);
                        id.val(payload.data.id);
                        form.addClass("success");
                        
                        setTimeout(function(){
                            form.removeClass("success");
                        }, 300);
                    } else {
                        img.attr("src", imgOG);
                        errorDiv.html(payload.messages);
                        
                        form.addClass("notSuccess");
                        setTimeout(function(){
                            form.removeClass("notSuccess");
                        }, 300);
                    }
                    console.log(payload);
                },
                error: function(payload, status) {
                    errorDiv.html(url + "not found, 404 error, -1mike12");
                }
            });
            //editing a photo///////////////////////////
        } else {
            var url = ADMIN + "photo/edit";
            $.ajax({
                url: url,
                type: "POST",
                data: fd,
                processData: false, // tell jQuery not to process the data
                contentType: false, // tell jQuery not to set contentType
                success: function(payload, status) {
                    if (payload.success) {
                        img.attr("src", imgOGPath + "?timestamp=" + new Date().getTime());
                        form.addClass("success");
                        setTimeout(function(){
                            form.removeClass("success");
                        }, 300);
                    } else {
                        errorDiv.html(payload.messages);
                        img.attr("src", imgOGPath);
                        
                        form.addClass("notSuccess");
                        setTimeout(function(){
                            form.removeClass("notSuccess");
                        }, 300);
                    }
                    console.log(payload);
                },
                error: function(payload, status) {
                    errorDiv.html(url + "not found, 404 error, -1mike12");
                }
            });
        }
    });
});
