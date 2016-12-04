//var codigoUsuario;
$("#frmSearchAlum").submit(function (event) {

    searchParticipante(event);

});

function searchParticipante(event) {
    event.preventDefault();
    $('#containerDetPag').empty();
    var posting = $.post('PagosController/buscarAlum/', $('#frmSearchAlum').serializeArray());
    posting.done(function (data) {
        if (data !== null) {
            $('#containerTablePagingPag').empty();
            $('#containerTablePagingPag').html(data);

        }
    });
    posting.fail(function (data) {
        var obj = jQuery.parseJSON(data);
        alert(obj.Error);
    });
}

$("#txtNombAlum").on("keypress", function (e) {
    e.stopImmediatePropagation();
    //e.preventDefault();
    if (e.which === 13) {
        searchParticipante(e);
    }
});
$("#txtCarnetAlum").on("keypress", function (e) {
    e.stopImmediatePropagation();
    //e.preventDefault();
    if (e.which === 13) {
        searchParticipante(e);
    }
});
$("#txtDuiAlum").on("keypress", function (e) {
    e.stopImmediatePropagation();
    //e.preventDefault();
    if (e.which === 13) {
        searchParticipante(e);
    }
});
function detallarPago(codGpart) {
    var posting = $.post('PagosController/buscarPagoDet/', {codUser: codGpart});
    posting.done(function (data) {
        if (data !== null) {
            $('#containerDetPag').empty();
            $('#containerDetPag').html(data);

        }
    });
    posting.fail(function (data) {

        alert(data);
    });
}

function ejecutarPago() {

    var posting = $.post($("#frmPago").attr("action"), $("#frmPago").serializeArray());
    posting.done(function (data) {
        if (data !== null) {
            $('#containerDetPag').empty();
            $('#containerDetPag').html(data);
            $('#tableParticipantesPag').find('#trAlum' + $('#codGrupPar').val()).find('.estadoPag').html('CANCELADO');
        $('#divMsgExito').html('<p>Pago Ingresado correctamente</p>')
        }
    });
    posting.fail(function (data) {
        var obj = jQuery.parseJSON(data);
        alert(obj.Error);
    });

}

function cerrarDivPagosDet() {
    $('#containerDetPag').empty();
}