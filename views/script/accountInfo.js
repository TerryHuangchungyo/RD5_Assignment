$(document).ready(function(){
    $("#eyeCloseBtn").hide();
    $("#validateForm").hide();

    $("#eyeShowBtn").click(function(){
        $("#validateForm").show();
        $("#info").hide();
    });

    $("#eyeCloseBtn").click( function(){
        $("#residueContent").html("*****");
        $("#eyeCloseBtn").hide();
        $("#eyeShowBtn").show();
        $("#validatePasswordInput").val("");
        $("#validateCheckPasswordInput").val("");
        document.cookie = 'eyeshow=; expires=Thu, 01 Jan 1970 00:00:00 GMT';
    });

    $("#validateCancel").click(function(){
        $("#validateForm").hide();
        $("#info").show();
        $("#validatePasswordInput").val("");
        $("#validateCheckPasswordInput").val("");
        $("#validatePasswordInput").removeClass("is-invalid");
        $("#validateCheckPasswordInput").removeClass("is-invalid");
    });

    $("#validateSubmit").click(function(){
        let dataToServer = {
            "validatePassword": $("#validatePasswordInput").val(),
            "validateCheckPassword": $("#validateCheckPasswordInput").val()
        };

        $.ajax({
            type: "post",
            url: "dashboard/info",
            data: dataToServer
        }).done(function( response ){
            console.log(response);
            if( response["success"]) {
                $("#residueContent").html(response["content"]);
                $("#validateForm").hide();
                $("#info").show();
                $("#eyeCloseBtn").show();
                $("#eyeShowBtn").hide();
            } else {
                delete response["success"];
                for( let item in response ) {
                    $(`#${item}Input`).addClass("is-invalid");
                    $(`#${item}Feedback`).text( response[item] );
                }
            }
        });
    });
});