$(document).ready(function(){
    $("#loginModal").on( "hide.bs.modal",function() {
        $("#accoutPassword").val("");
    });

    $("#signupModal").on( "hide.bs.modal",function(){
        $("#signupPassword").val("");
        $("#signupCheckPassword").val("");
    });
})