/* 
 Utilidad para paginacion en tablas
 */
var ContainerTable, firstPage, lastPage, prevPage, nextPage, urlAction, search;

function setVariablesPaginacion(cont,fpage,lpage,ppage,npage,urla,sea){
    ContainerTable = cont;
    firstPage = fpage;
    lastPage = lpage;
    prevPage = ppage;
    nextPage = npage;
    urlAction = urla;
    search =sea;
}

$(ContainerTable).on("click", firstPage, function (e) {
    var data_in= $(this).data("datainic");
       
        var url = urlAction;
        var posting = $.post(url, {"data_ini": data_in});

        posting.done(function (data) {
            if (data !== null) {

                $(ContainerTable).empty();
                $(ContainerTable).html(data);

            }
        });
        posting.fail(function (data) {
            alert("error");
        });
    
});

$(ContainerTable).on("click", lastPage, function (e) {
    
    var data_in= $(this).data("datainic");
       
        var url = urlAction;
        var posting = $.post(url, {"data_ini": data_in});

        posting.done(function (data) {
            if (data !== null) {

                $(ContainerTable).empty();
                $(ContainerTable).html(data);

            }
        });
        posting.fail(function (data) {
            alert("error");
        });
    
});

$(ContainerTable).on("click", prevPage, function (e) {
    
   var data_in = $(search).data("datainic");
        var url = urlAction;
        var posting = $.post(url, {"data_inip": data_in});

        posting.done(function (data) {
            if (data !== null) {

                $(ContainerTable).empty();
                $(ContainerTable).html(data);

            }
        });
        posting.fail(function (data) {
            alert("error");
        });
    
});

$(ContainerTable).on("click", nextPage, function (e) {
    
    var data_in = $(search).data("datainic");
    var url = urlAction;
    var posting = $.post(url, {"data_inin": data_in});

    posting.done(function (data) {
        if (data !== null) {

        $(ContainerTable).empty();
        $(ContainerTable).html(data);

        }
    });
    posting.fail(function (data) {
        alert("error");
    });
    
});
