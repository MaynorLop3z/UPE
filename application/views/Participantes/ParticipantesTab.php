<?php $this->load->helper('url'); ?>
<script src="../bootstrap/js/Participantes.js"></script>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Participantes</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <button  id="btnADDAlumno" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Alumno Nuevo</button>
            </div>
            <div class="col-md-6">
                <?php $this->load->helper('url'); ?>
                <form id="frmFINDAlumno" action="<?php echo base_url() ?>index.php/ParticipantesController/buscar/"  method="post" class="form-inline">
                    <span>Nombre a buscar:</span>
                    <input type="text" class="form-control" id="tbNameBuscarAlum" name="NombreBuscado" placeholder="Escriba texto de busqueda aqui" required>                
                    <button id="btnFindAlum" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar Alumno</button>
                </form>
            </div>
        </div>
        <br>
        <!-- DIv para la tabla  donde se muestran todos los usuario-->
        <div class="row">
            <div class="col-md-12">
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
                            <th>Categoria</th>
                            <th>Descripcion</th>
                            <th style="display: none">Comentarios</th>
                            <th>Gestion</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php
                        foreach ($Alumnos as $alum) {
                            ?>
                            <tr id="alum<?= $alum->CodigoParticipante ?>">
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
                                <td class="CodCat_Alumno"><?= $alum->CodigoCategoriaParticipantes ?></td>
                                <td class="Descripcion_Alumno"><?= $alum->Descripcion ?></td>
                                <td class="Comentarios_Alumno" style="display: none"><?= $alum->Comentarios ?></td>
                                <td class="gestion_Alumno">
                                    <button id="alumE<?php echo $alum->CodigoParticipante ?>" onclick="mostrarEditAlumno(this)" title="Editar Alumno" class="btn_modificar_alum btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
                                    <button id="alumDEL<?php echo $alum->CodigoParticipante ?>" onclick="mostrarDelAlumno(this)" title="Eliminar Alumno" class="btn_eliminar_alum btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                    <button id="alumVIEW<?php echo $alum->CodigoParticipante ?>" onclick="mostrarInfoAlumno(this)" title="Ver Alumno" class="btn_ver_alum btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>