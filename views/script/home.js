$(document).ready(function(){
    $("#loginModal").on( "hide.bs.modal",function() {
        $("#accoutPassword").val("");
    });

    $("#signupModal").on( "hide.bs.modal",function(){
        $("#signupPassword").val("");
        $("#signupCheckPassword").val("");
    });

    $("#signupBtn").click( function(){
        let dataToServer = { "signupId": $("#signupId").val(),
                        "signupName": $("#signupName").val(),
                        "signupHolder": $("#signupHolder").val(),
                        "signupPassword": $("#signupPassword").val(),
                        "signupCheckPassword": $("#signupCheckPassword").val()};

        $.ajax({
            type: "post",
            url: "home/signup",
            data: dataToServer,
            beforeSend: function() {
                $("#signupModal").modal("hide");
                $("#waitModal").modal("show");
            }
        }).done(function( result ){
            console.log(result);
            if( result["success"] == true ) {
                $("#waitModal").modal("hide");
                $("#successModal").modal("show");
            }
        }).fail(function( error ){
            alert("註冊發生錯誤．．．");
        });
    });
})