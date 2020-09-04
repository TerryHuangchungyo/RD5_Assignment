var transData;
$(document).ready(function(){
    $("#transDetail").hide();

    $("#backBtn").click(function(){
        $("#transTable").show();
        $("#transDetail").hide();
    });

    $("table tbody tr").click(function(){
        $("#transTable").hide();
        $("#transDetail").show();
    });

    // 獲取該帳號交易數目
    $.ajax( {
        type: "get",
        url: "transaction"
    }).done(function( response ){
        pages = Math.ceil(response["transCount"]/10);
        setPages( pages );
    }).fail(function(){
        alert("載入失敗");
    });
    
});

function setPages( pages ) {
    var pag = $('#pagination').simplePaginator({

        // the number of total pages
        totalPages: pages,
    
        // maximum of visible buttons
        maxButtonsVisible: 3,
    
        // page selected
        currentPage: 1,
    
        // text labels for buttons
        nextLabel: '>',
        prevLabel: '<',
        firstLabel: '<<',
        lastLabel: '>>',
    
        // specify if the paginator click in the currentButton
        clickCurrentPage: true,
    
        // called when a page is changed.
        pageChange: function(page) { getTransactionData( updateTableUI, 10*(page-1),10 ); }
    
    });
}

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

        span = $("<span></span>").addClass( row["success"] == 1 ? "text-success":"text-danger" )
                          .text( row["success"] == 1 ? "成功":"失敗" );
        $("<td></td>").append(span).appendTo(tableRow);

        $("<td></td>").text( row["residue"] ).appendTo(tableRow);
        $("<td></td>").text( row["date"] ).appendTo(tableRow);
        
        $("#transTableBody").append( tableRow );

        tableRow.click( function(){
            let index = $("#transTableBody tr").index( this );
            let data = transData[index];
            updateDetailUi( data );
        });
    });
}

function updateDetailUi( data ) {
    $("#transTable").hide();
    $("#transDetail").show();
    $("#span-trans-id").text(data["transId"]);
    $("#span-trans-date").text(data["date"]);

    $("#span-trans-action").removeClass("text-success");
    $("#span-trans-action").removeClass("text-danger");
    $("#span-trans-action").text(data["aid"] == 1 ? "存款":"提款");
    if( data["aid"] == 1 ) {
        $("#span-trans-action").addClass("text-success");
    } else {
        $("#span-trans-action").addClass("text-danger");
    }

    $("#span-trans-status").removeClass("text-success");
    $("#span-trans-status").removeClass("text-danger");
    $("#span-trans-status").text(data["success"] == 1 ? "成功":"失敗");
    if( data["success"] == 1 ) {
        $("#span-trans-status").addClass("text-success");
    } else {
        $("#span-trans-status").addClass("text-danger");
    }

    $("#span-trans-accountName").text(data["name"]);
    $("#span-trans-value").text(data["value"]);
    $("#span-trans-residue").text(data["residue"]);
    if( data["success"] == 1 ) {
        $("#errorText").hide();
    } else {
        $("#errorMsg").text(data["errorMsg"]);
        $("#errorText").show();
    }
}
