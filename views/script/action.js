var result;
$("#actionSubmit").click(function(){
    let dataToServer = {
        "action": $("#actionSubmit").data("action"),
        "value": $("#value").val(),
        "actionPassword": $("#actionPasswordInput").val(),
        "actionCheckPassword": $("#actionCheckPasswordInput").val()};
    $.ajax({
        type: "post",
        url: "dashboard/action",
        data: dataToServer
    }).done(function( response ){
        let action = $("#actionSubmit").data("action");
        $(`#${action}`).html(response);
    });
});