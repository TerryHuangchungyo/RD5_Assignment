var where = $("#continue").data("where");

$("#continue").click(function(){
    $(`#${where}-tab`).trigger("click");
});
