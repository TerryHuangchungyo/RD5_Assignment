var result;
$("#validateSubmit").click(function(){

    let dataToServer = {
        "validatePassword": $("#validatePasswordInput").val(),
        "validateCheckPassword": $("#validateCheckPasswordInput").val(),
        "panel" : ($("a.nav-link.active").prop("id")).slice(0 , -4)
    };

    $.ajax({
        type: "post",
        url: "dashboard/validate",
        data: dataToServer,
    }).done(function( response ){
        let currentPanel = $("a.nav-link.active").prop("id");
        currentPanel = currentPanel.slice( 0, -4 );
        $(`#${currentPanel}`).html(response);
    });
});
