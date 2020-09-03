var result;
$("#changeSubmit").click(function(){
    let dataToServer = {
        "accountName": $("#accountNameInput").val(),
        "accountHolder": $("#accountHolderInput").val(),
        "balanceHide": $("input.form-check-input").eq(0).prop("checked") == true ? 1:0
    };

    $.ajax({
        type: "post",
        url: "dashboard/setting",
        data: dataToServer
    }).done(function( response ){
        $("#setting").html(response);
    });
});