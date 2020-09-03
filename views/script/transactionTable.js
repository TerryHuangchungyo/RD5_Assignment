var total;
var transData;
$(document).ready(function(){

    // 獲取該帳號交易數目
    $.ajax( {
        type: "get",
        url: "transaction"
    }).done(function( response ){
        total = response["transCount"];
    }).fail(function(){
        alert("載入失敗");
    });

    $("#transDetail").hide();

    $("#backBtn").click(function(){
        $("#transTable").show();
        $("#transDetail").hide();
    });

    $("table tbody tr").click(function(){
        $("#transTable").hide();
        $("#transDetail").show();
    });

    getTransactionData( updateTableUI, 0, 10 );
});

function getTransactionData( callback, offsets, limits ) {
    $.ajax({
        type: "get",
        url: `transaction?offsets=${offsets}&limits=${limits}`
    }).done(function( response ) {
        transData = response;
        callback( response );
    }).fail( function(){
        alert("載入失敗");
    });
}

function updateTableUI( dataset ) {
    $("#transTableBody").empty();
    dataset.forEach( row => {
        let tableRow = $("<tr></tr>");

        $("<th scope='row'></th>").text( row["transId"]).appendTo(tableRow);

        let span = $("<span></span>").addClass( row["aid"] == 1 ? "text-success":"text-danger" )
                          .text( row["aid"] == 1 ? "存款":"提款" );
        $("<td></td>").append(span).appendTo(tableRow);           

        $("<td></td>").text( row["value"] ).appendTo(tableRow);

        span = $("<span></span>").addClass( row["success"] ? "text-success":"text-danger" )
                          .text( row["success"] ? "成功":"失敗" );
        $("<td></td>").append(span).appendTo(tableRow);

        $("<td></td>").text( row["residue"] ).appendTo(tableRow);
        $("<td></td>").text( row["date"] ).appendTo(tableRow);
        
        $("#transTableBody").append( tableRow );

        tableRow.click( function(){
            let index = $("#transTableBody tr").index( this );
            alert( index );
        });
    });
}
