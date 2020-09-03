$(document).ready(function(){
    var lastSeleted = $("#accountInfo");

    $("#accountInfo-tab").click(function(){
        $.ajax({
            url: "dashboard/panel/info",
            method: "GET"
        }).then(function( result ){
            lastSeleted.html("");
            $("#accountInfo").html(result);
            lastSeleted = $("#accountInfo");
        })
    });

    $("#deposit-tab").click(function(){
        $.ajax({
            url: "dashboard/panel/deposit",
            method: "GET"
        }).then(function( result ){
            lastSeleted.html("");
            $("#deposit").html(result);
            lastSeleted = $("#deposit");
        })
    });

    $("#withdraw-tab").click(function(){
        $.ajax({
            url: "dashboard/panel/withdraw",
            method: "GET"
        }).then(function( result ){
            lastSeleted.html("");
            $("#withdraw").html(result);
            lastSeleted = $("#withdraw");
        })
    });
    
    $("#transaction-tab").click(function(){
        $.ajax({
            url: "dashboard/panel/validate",
            method: "GET"
        }).then(function( result ){
            lastSeleted.html("");
            $("#transaction").html(result);
            lastSeleted = $("#transaction");
        })
    });

    $("#setting-tab").click(function(){
        $.ajax({
            url: "dashboard/panel/validate",
            method: "GET"
        }).then(function( result ){
            lastSeleted.html("");
            $("#setting").html(result);
            lastSeleted = $("#setting");
        })
    });

    $("#changePassword-tab").click(function(){
        $.ajax({
            url: "dashboard/panel/changePassword",
            method: "GET"
        }).then(function( result ){
            lastSeleted.html("");
            $("#changePassword").html(result);
            lastSeleted = $("#changePassword");
        })
    });
    $("#transaction-tab").trigger("click");
});