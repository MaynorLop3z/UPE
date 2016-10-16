<?php $this->load->helper('url'); ?>
<script src="../bootstrap/js/Participantes.js"></script>
<!--<script src="../bootstrap/js/jquery.mask.js"></script>-->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Gestion de Participantes</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <button  id="btnADDAlumno" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Alumno Nuevo</button>
            </div>
             <button id="btnCleanSearchAlumno" class="btn btn-default" style="float:right;margin-right: 20px;"><span class="glyphicon glyphicon-refresh"></span>Limpiar Búsqueda</button> 
<!--            <div class="col-md-6" style="float:right;">
                <?php $this->load->helper('url'); ?>
                <form id="frmFINDAlumno" action="<?php echo base_url() ?>index.php/ParticipantesController/buscar/"  method="post" class="form-inline" style="float:right;">
                    <span>Nombre a buscar:</span>
                    <input type="text" class="form-control" id="tbNameBuscarAlum" name="NombreBuscado" placeholder="Escriba texto de busqueda aqui" required>                
                    <button id="btnFindAlum" type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar Alumno</button>
                </form>
            </div>-->
        </div>
        <br>
        <div class="panel panel-default">
            <form id="frmfindAlumno"  action="" class="form-horizontal" method="post" >
                <fieldset>
                    <legend class="modal-header">Buscar Alumno:</legend> 
                    <div class="form-group">
                        <div class="col-lg-4">
                            <input class="form-control form-inline FindAlumnoClass" placeholder="Correo" id="FindAlumnoCorreo" type="text" maxlength="150" >
                        </div>
                        <div class="col-lg-4">
                            <input class="form-control form-inline FindAlumnoClass" placeholder="Nombre" name="FindAlumno" id="FindAlumnoNombre" type="text" maxlength="150" >
                        </div>
                        <div class="col-lg-4">
                            <input class="form-control form-inline FindAlumnoClass" placeholder="Categoria" id="FindAlumnoCategoria" type="text" maxlength="150" >
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <!-- DIv para la tabla  donde se muestran todos los usuario-->
        <div class="row">
            <div class="col-md-12">
                <div id="tablaAlumnosContent">
                <table id="tableAlumnos" class="table table-bordered table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>Mail</th>
                            <th style="display: none"># Fijo</th>
                            <th style="display: none"># Movil</th>
                            <th style="display: none">Direccion</th>
                            <th style="display: none">DUI</th>
                            <th style="display: none">Genero</th>
                            <th>Nombre</th>
                            <th style="display: none">Fecha Nac.</th>
                            <th style="display: none">Universidad</th>
                            <th style="display: none">Carrera</th>
                            <th style="display: none">Nivel Acade.</th>
                            <th style="display: none">Encargado</th>
                            <th style="display: none">CodsCategoria</th>
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
                                <td class="Genero_Alumno" style="display: none"><?= $alum->Genero ?></td>
                                <td class="Nombre_Alumno"><?= $alum->Nombre ?></td>
                                <td class="FechaNac_Alumno" style="display: none"><?= $alum->FechaNacimiento ?></td>
                                <td class="CodU_Alumno" style="display: none"><?= $alum->CodigoUniversidadProcedencia ?></td>
                                <td class="Carrera_Alumno" style="display: none"><?= $alum->Carrera ?></td>
                                <td class="NivelAcad_Alumno" style="display: none"><?= $alum->NivelAcademico ?></td>
                                <td class="NombreEncargado_Alumno" style="display: none"><?= $alum->NombreEncargado ?></td>
                                <td class="CodCat_Alumno" style="display: none"><?= $alum->CodigoCategoriaParticipantes ?></td>
                                <td class="NameCat_Alumno"><?= $alum->NombreCategoriaParticipante ?></td>
                                <td class="Descripcion_Alumno"><?= $alum->Descripcion ?></td>
                                <td class="Comentarios_Alumno" style="display: none"><?= $alum->Comentarios ?></td>
                                <td class="gestion_Alumno"><div class="btn-group" role="group">
                                    <button id="alumE<?php echo $alum->CodigoParticipante ?>" onclick="mostrarEditAlumno(this)" title="Editar Alumno" class="btn_modificar_alum btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
                                    <button id="alumDEL<?php echo $alum->CodigoParticipante ?>" onclick="mostrarDelAlumno(this)" title="Eliminar Alumno" class="btn_eliminar_alum btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                                    <button id="alumVIEW<?php echo $alum->CodigoParticipante ?>" onclick="mostrarInfoAlumno(this)" title="Ver Alumno" class="btn_ver_alum btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></button>
                                    <button id="alumGROUP<?php echo $alum->CodigoParticipante ?>" onclick="mostrarGruposPeriodos(this)" title="Agregar a Grupo" class="btn_group_add btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span></button>
                                </div></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                    <?php if($ToTalRegistrosParticipantes>ROWS_PER_PAGE){ ?>
                     <!--Paginacion-->
             <div class="row">
                <hr>
                <ul class="pager" id="footpagerParticipantes">
                    <li><button data-datainic="1" id="aFirstPagParticipantes" >&lt;&lt;</button></li>
                    <li><button id="aPrevPagParticipantes" >&lt;</button></li>
                    <li>
                        <input data-datainic="1" type="text" value="1" id="txtPagingSearchParticipantes" name="txtNumberPag" data-mask="000000000" size="5">/<?php echo $totalPaginasParticipantes?>
                    </li>
                    <li><button id="aNextPagParticipantes">&gt;</button></li>
                    <li><button id="aLastPagParticipantes" data-datainic="<?php echo $totalPaginasParticipantes ?>" >&gt;&gt;</button></li>
                    <li id="pagerParticipantes">[<?php echo $PagInicialParticipantes . "-" . count($Alumnos) . "/" . $ToTalRegistrosParticipantes ?>]</li>
                </ul>
            </div>
            <!--Fin Paginacion-->
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>