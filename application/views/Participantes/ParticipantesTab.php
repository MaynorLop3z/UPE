<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Participantes</h3>
    </div>
    <div class="panel-body">
        <div class="btn btn-group">
            <button href="#AlumnoNuevo"  class="btn btn-default btn-default" data-toggle="modal">Alumno Nuevo</button>
            <button href="#AlumnoModifica" class="btn btn-default btn-default" data-toggle="modal">Modificar Alumno</button>
            <button href="#AlumnoElimina" class="btn btn-default btn-default" data-toggle="modal">Eliminar Alumno</button>
        </div>
        <?php
//        if ($creacion) {
            ?>
            <!--            <div class="row">
                        <div class="col-md-8 alert alert-success alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <strong>Exito!</strong><?= $mensaje ?>
                </div>
                            </div>-->
            <?php
//        } else {
            ?>
            <!--        <div class="row">
                        <div class="col-md-8 alert alert-danger alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <strong>Error!</strong><?= $mensaje ?>
                </div>
                            </div>-->
            <?php
//        }
        ?>
        <!-- DIv para la tabla  donde se muestran todos los usuario-->
        <!--            <div class="col-lg-9">-->
        <table class="table table-bordered table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>Mail</th>
                    <th># Fijo</th>
                    <th># Movil</th>
                    <th>Direccion</th>
                    <th>DUI</th>
                    <th>Nombre</th>
                    <th>Fecha Nac.</th>
                    <th>Universidad</th>
                    <th>Carrera</th>
                    <th>Nivel Acade.</th>
                    <th>Encargado</th>
                    <th>Descripcion</th>
                    <th>Categoria</th>
                    <th>Comentarios</th>
                </tr>
            </thead> 
            <tbody>
                <?php
                foreach ($Alumnos as $alum) {
                    ?>
                    <tr id="<?= $alum->CodigoParticipante ?>">
                        <td><?= $alum->CorreoElectronico ?></td>
                        <td><?= $alum->TelefonoFijo ?></td>
                        <td><?= $alum->TelefonoCelular ?></td>
                        <td><?= $alum->Direccion ?></td>
                        <td><?= $alum->NumeroDUI ?></td>
                        <td><?= $alum->Nombre ?></td>
                        <td><?= $alum->FechaNacimiento ?></td>
                        <td><?= $alum->CodigoUniversidadProcedencia ?></td>
                        <td><?= $alum->Carrera ?></td>
                        <td><?= $alum->NivelAcademico ?></td>
                        <td><?= $alum->NombreEncargado ?></td>
                        <td><?= $alum->Descripcion ?></td>
                        <td><?= $alum->CodigoCategoriaParticipantes ?></td>
                        <td><?= $alum->Comentarios ?></td>
                    </tr>
                    <?php
                }
                ?>

            </tbody>
        </table>  

        <!--</div>-->
    </div>
</div>