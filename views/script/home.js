var signupResult;
var loginResult;

$(document).ready(function(){
    $("#loginModal").on( "hide.bs.modal",function() {
        $("#accoutPassword").val("");
    });

    $("#loginBtn").click( function(){
        let dataToServer = { "accountId": $("#accountId").val(),
                        "accountPassword": $("#accountPassword").val()};

        $.ajax({
            type: "post",
            url: "home/login",
            data: dataToServer,
            beforeSend: function() {
                $("#accountId").addClass("is-invalid");
                $("#accountId").text("");
                $("#accountPassword").addClass("is-invalid");
                $("#accountPasswordFeedback").text("");
            }
        }).done(function( response ){
            loginResult = response;
            console.log(loginResult);
            if( loginResult["success"] ) {
                window.location = "dashboard";
            } else {
                delete loginResult["success"];
                for( let item in loginResult ) {
                    $(`#${item}`).addClass("is-invalid");
                    $(`#${item}Feedback`).text(loginResult[item]);
                }
                if( loginResult["accountConclude"] != undefined ) {
                    $("#accountId").addClass("is-invalid");
                    $("#accountPassword").addClass("is-invalid");
                    $("#accountPasswordFeedback").text(loginResult["accountConclude"]);
                }
            }
        }).fail(function( error ){
            $("#afterSignupModal").modal("show");
            $("#afterSignupModalLabel").text("登入失敗");
            $("#afterSignupModalContent").text("系統發生錯誤，如有問題請聯絡客服人員。");
        });
    });

    $("#signupModal").on( "hide.bs.modal",function(){
        $("#signupPassword").val("");
        $("#signupCheckPassword").val("");
    });

    $("#signupBtn").click( function(){
        let dataToServer = {
                        "signupId": $("#signupId").val(),
                        "signupName": $("#signupName").val(),
                        "signupHolder": $("#signupHolder").val(),
                        "signupPassword": $("#signupPassword").val(),
                        "signupCheckPassword": $("#signupCheckPassword").val()};

        $.ajax({
            type: "post",
            url: "home/signup",
            data: dataToServer,
            beforeSend: function() {
                for( let item in signupResult ) {
                    $(`#${item}`).removeClass("is-invalid");
                    $(`#${item}Feedback`).text("");
                }
            }
        }).done(function( response ){
            signupResult = response;
            console.log(signupResult);
            if( signupResult["success"] == true ) {
                $("#signupModal").modal("hide");
                $("#afterSignupModal").modal("show");
                $("#afterSignupModalLabel").text("註冊成功");
                $("#afterSignupModalContent").text("請使用剛剛註冊的帳號登入。");
            } else {
                delete signupResult["success"];
                for( let item in signupResult ) {
                    $(`#${item}`).addClass("is-invalid");
                    $(`#${item}Feedback`).text(signupResult[item]);
                }
            }
        }).fail(function( error ){
            $("#afterSignupModal").modal("show");
            $("#afterSignupModalLabel").text("註冊失敗");
            $("#afterSignupModalContent").text("系統發生錯誤，如有問題請聯絡客服人員。");
        });
    });
})