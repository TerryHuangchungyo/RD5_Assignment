
var result;
$("#changeSubmit").click(function(){
    let dataToServer = {
        "changePassword": $("#changePasswordInput").val(),
        "changeCheckPassword": $("#changeCheckPasswordInput").val(),
        "password": $("#passwordInput").val(),
        "checkPassword": $("#checkPasswordInput").val()};
    $.ajax({
        type: "post",
        url: "dashboard/changePassword",
        data: dataToServer
    }).done(function( response ){
        $("#changePassword").html(response);
    });
});
