var codigoR;

$("#tableRol").on("click", ".btn_modificar_rol", function (e) {
    var trRol = $(this).parent().parent().parent();

    var dataR = trRol.data("rold");
    var tdRol = trRol.find('.nombre_Rol');
    tdRol.empty();
    tdRol.append('<input id="txtEditRol" class="form-control" type="text" value=' + dataR.NombreRol + ' name="editRol"/>');
    $("#txtEditRol").focus();
});

$("#tableRol").on("keypress", "#txtEditRol", function (e) {
    if (e.which == 13) {
        var trRol = $(this).parent().parent();
        var tdRol = $(this).parent();
        var dataR = trRol.data("rold");
        var data_rVal = $(this).val();
        var url = "RolesController/editarRol/";
        var posting = $.post(url, {CodigoRol: dataR.CodigoRol, NombreRol: data_rVal});

        posting.done(function (data) {
            if (data !== null) {
                var obj = jQuery.parseJSON(data);
                trRol.data("rold", obj);
                tdRol.empty();
                tdRol.append(obj.NombreRol);
            }
        });
        posting.fail(function (data) {
            alert("error");
        });

    }
});

$("#tableRol").on("blur", "#txtEditRol", function (e) {

    var trRol = $(this).parent().parent();
    var dataR = trRol.data("rold");
    var tdRol = trRol.find('.nombre_Rol');
    tdRol.empty();
    tdRol.append(dataR.NombreRol);

});

$("#tableRol").on("click", ".btn_eliminar_rol", function () {
    var trRol = $(this).parent().parent().parent();

    var dataR = trRol.data("rold");
    codigoR = dataR.CodigoRol;
    $("#rolElimina").modal('show');
});

$("#tableRol").on("click", ".btn_permisos_rol", function () {
    var trRol = $(this).parent().parent().parent();

    var dataR = trRol.data("rold");
    codigoR = dataR.CodigoRol;
    $("#rolesPermisos").modal('show');
});

$('#rolesPermisos').on('show.bs.modal', function (event) {
    var url = 'RolesController/rightByRol/';
    var posting = $.post(url, {cod_r: codigoR});

    posting.done(function (data) {
        if (data !== null) {
            $("#bodyTableRolRights").html(data);
        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});


$("#frmGuardarR").submit(function (event) {
    event.preventDefault();
    var $form = $(this), RolNombre = $form.find("input[name='RolName']").val(), url = $form.attr("action");
    var posting = $.post(url, {RolNombre: RolNombre});
    posting.done(function (data) {
        if (data !== null) {
            $("#tableRol > tbody > tr").remove();
            $('#tableRol > tbody').append(data);

        }
    });
    posting.fail(function (data) {
        var obj = jQuery.parseJSON(data);
        alert(obj.Error);
    });
});

$("#frmEliminarRol").submit(function (event) {
    event.preventDefault();
    var $form = $(this), CodigoRol = codigoR, url = $form.attr("action");
    var posting = $.post(url, {CodigoRol: CodigoRol});
    posting.done(function (data) {
        if (data) {
            var obj = jQuery.parseJSON(data);
            $("#rolElimina").modal('toggle');
            $('#tableRol').find('#tr' + obj.CodigoRol).fadeOut("slow");
            $('#tableRol').find('#tr' + obj.CodigoRol).remove();
        }
    });
    posting.fail(function () {
        alert("error");
    });
});

$("#frmRolRight").submit(function (event) {
    event.preventDefault();
    var url = 'RolesController/AplyRmvRights/';
    jsonRolsRights = [];

    $('#bodyTableRolRights tr').each(function () {
        var checkRr = $(this).find(".gestion_RbR").find(".checkRr");
        var r = checkRr.data("rrd");
        if (r != null) {
            rightObj = {};
            rightObj ["CodigoRol"] = codigoR;
            rightObj ["CodigoPermisos"] = r.CodigoPermisos;

            if (checkRr.is(":checked"))
            {
                rightObj ["Sta"] = "add";
            } else {
                rightObj ["Sta"] = "del";
            }

            jsonRolsRights.push(rightObj);
        }
    });
    jsonString = JSON.stringify(jsonRolsRights);

    var posting = $.post(url, {"rolesRightsSelect": jsonRolsRights});
    posting.done(function (data) {
        if (data !== null) {
            $("#rolesPermisos").modal('toggle');

//            $('#tableUsers').find('#tr' + codigoUsuario).fadeOut("slow");
//            $('#tableUsers').find('#tr' + codigoUsuario).remove();
        } else {

        }
    });
    posting.fail(function (xhr, textStatus, errorThrown) {
        alert("error" + xhr.responseText);
    });
});




