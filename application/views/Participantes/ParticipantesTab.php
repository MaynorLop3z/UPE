<?php $this->load->helper('url'); ?>
<script src="../bootstrap/js/Participantes.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Participantes</h3>
    </div>
    <div class="panel-body">
        <div class="btn btn-group">
            <button  id="btnADDAlumno" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Alumno Nuevo</button>
<!--            <button href="#AlumnoEditar" id="btnEDITAlumno" class="btn btn-default btn-default" data-toggle="modal">Modificar Alumno</button>
            <button href="#AlumnoElimina" id="btnDELAlumno" class="btn btn-default btn-default" data-toggle="modal">Eliminar Alumno</button>-->
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
        <table id="tableAlumnos" class="table table-bordered table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>Mail</th>
                    <th style="display: none"># Fijo</th>
                    <th style="display: none"># Movil</th>
                    <th style="display: none">Direccion</th>
                    <th style="display: none">DUI</th>
                    <th>Nombre</th>
                    <th style="display: none">Fecha Nac.</th>
                    <th style="display: none">Universidad</th>
                    <th style="display: none">Carrera</th>
                    <th style="display: none">Nivel Acade.</th>
                    <th style="display: none">Encargado</th>
                    <th style="display: none">Descripcion</th>
                    <th>Categoria</th>
                    <th>Comentarios</th>
                    <th>Gestion</th>
                    
                    
                </tr>
            </thead> 
            <tbody>
                <?php
                foreach ($Alumnos as $alum) {
                    ?>
                    <tr id=alum"<?= $alum->CodigoParticipante ?>">
    <!--                    <tr>-->
                        <td class="Mail_Alumno"><?= $alum->CorreoElectronico ?></td>
                        <td class="TelefonoFijo_Alumno" style="display: none"><?= $alum->TelefonoFijo ?></td>
                        <td class="TelefonoMovil_Alumno" style="display: none"><?= $alum->TelefonoCelular ?></td>
                        <td class="Direccion_Alumno" style="display: none"><?= $alum->Direccion ?></td>
                        <td class="DUI_Alumno" style="display: none"><?= $alum->NumeroDUI ?></td>
                        <td class="Nombre_Alumno"><?= $alum->Nombre ?></td>
                        <td class="FechaNac_Alumno" style="display: none"><?= $alum->FechaNacimiento ?></td>
                        <td class="CodU_Alumno" style="display: none"><?= $alum->CodigoUniversidadProcedencia ?></td>
                        <td class="Carrera_Alumno" style="display: none"><?= $alum->Carrera ?></td>
                        <td class="NivelAcad_Alumno" style="display: none"><?= $alum->NivelAcademico ?></td>
                        <td class="NombreEncargado_Alumno" style="display: none"><?= $alum->NombreEncargado ?></td>
                        <td class="CodPart_Alumno"><?= $alum->CodigoCategoriaParticipantes ?></td>
                        <td class="Descripcion_Alumno"><?= $alum->Descripcion ?></td>
                        <td class="gestion_Alumno">
                            <button id="<?php echo $alum->CodigoParticipante ?>"  title="Editar Alumno" class="btn_modificar_alum btn btn-success "  class=" btn btn-info btn-lg"><span class="glyphicon glyphicon-pencil"></span> </button>
                            <button data-toggle="modal" title="Eliminar Alumno" class="btn btn-danger" href="#usuarioElimina"><span class="glyphicon glyphicon-trash"></span></button></td>
                    </tr>
                            <td class="Comentarios_Alumno" style="display: none"><?= $alum->Comentarios ?></td>
                    </tr>
                    <?php
                }
                ?>

            </tbody>
        </table>  

        <!--</div>-->
    </div>
</div>