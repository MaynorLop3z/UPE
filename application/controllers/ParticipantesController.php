<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ParticipantesController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Participantes');
    }

    public function index() {

//        if ($this->input->post('Aceptar')) {
//            $data['creacion'] = agregar();
//            if ($data['creacion']) {
//                $data['Mensaje'] = 'Alumno Agregado Exitosamente';
//            } else {
//                $data['Mensaje'] = 'Error al Agregar al alumno';
//            }
//        } else {
//            $data['creacion'] = false;
//        }
        $data['Alumnos'] = $this->Participantes->listarParticipantesLimited(null, null);
        //$this->load->model('CategoriasParticipante');
        $data['CategoriasP'] = $this->Participantes->listarCategoriasParticipante();
        $data['DiplomadosP'] = $this->Participantes->listarDiplomados();
        $data['ToTalRegistrosParticipantes'] = count($this->Participantes->listarParticipantes());
        $data['PagInicialParticipantes'] = 1;
        $data['totalPaginasParticipantes'] = $this->getTotalPaginas();
        $this->load->view('Participantes', $data);
    }

    private function getTotalPaginas() {
        return $result = intval(ceil(count($this->Participantes->listarParticipantes()) / ROWS_PER_PAGE));
    }
    
    public function listarGruposPeriodos() {
        if ($this->input->post('idDiplomado')) {
            $idDiplomado = $this->input->post('idDiplomado');
            $idParticipante = $this->input->post('idParticipante');
            $Periodos = $this->Participantes->listarGruposPeriodos($idDiplomado, $idParticipante);
            foreach ($Periodos as $period) {
                ?>
                <tr id="GrupoPeriodo<?= $period->codigogrupoperiodo ?>">
                    <th class="nmgp"><?= $period->nombremodulo ?></th>
                    <th class="ffgp"><?= $period->fechafinperiodo ?></th>
                    <th class="figp"><?= $period->fechainicioperiodo ?></th>
                    <th class="hegp"><?= $period->horaentrada ?></th>
                    <th class="hsgp"><?= $period->horasalida ?></th>
                    <th class="agp"><?= $period->aula ?></th>
                    <th>
                        <?php
                        if ($period->inscrito == 1) {
                            ?>
                            <button id="GrupoPeriodoADD<?= $period->codigogrupoperiodo ?>" onclick="inscribirUsaurio(this)" title="Agregar alumno al periodo" class="btn_agregar_periodo btn btn-danger"><span class="glyphicon glyphicon-remove"></span> </button>    


                            <?php
                        } else {
                            ?> 
                            <button id="GrupoPeriodoADD<?= $period->codigogrupoperiodo ?>" onclick="inscribirUsaurio(this)" title="Agregar alumno al periodo" class="btn_agregar_periodo btn btn-success"><span class="glyphicon glyphicon-ok"></span> </button>
                            <?php
                        }
                        ?>
                    </th>
                </tr>
                <?php
            }
        }
    }

    public function inscribirAlumno() {
        try {
            if ($this->input->post()) {
                $idGrupoPeriodo = $this->input->post('idGrupoPeriodo');
                $idParticipante = $this->input->post('idParticipante');
                $idUsuario = $this->session->userdata('codigoUserLogin');
                $arrayData = $this->Participantes->inscribirParticipante($idGrupoPeriodo, $idParticipante, $idUsuario);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    public function agregar() {
        try {
            if ($this->input->post()) {
                $nombre = $this->input->post('AlumnoNombre');
                $mail = $this->input->post('AlumnoMail');
                $tfijo = $this->input->post('AlumnoFijo');
                $tcel = $this->input->post('AlumnoMovil');
                $direccion = $this->input->post('AlumnoDir');
                $DUI = $this->input->post('AlumnoDUI');
                $nacimiento = $this->input->post('AlumnoFNac');
                $carrera = $this->input->post('AlumnoCarrera');
                $nivelAcad = $this->input->post('AlumnoNivel');
                $encargado = $this->input->post('AlumnoNEncargado');
                $categoria = $this->input->post('AlumnoCategoria');
                $descripcion = $this->input->post('AlumnoDescripcion');
                $comentarios = $this->input->post('AlumnoComentario');
                $genero = $this->input->post('AlumnoGenero');
                $universidad = 0;
                $arrayData = $this->Participantes->CrearParticipante($nombre, $mail, $tfijo, $tcel, $direccion, $nacimiento, $categoria, $DUI, $universidad, $carrera, $nivelAcad, $encargado, $descripcion, $comentarios,$genero);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    public function modificar() {
        try {
            if ($this->input->post()) {
                $codigo = $this->input->post('AlumnoCodigo');
                $nombre = $this->input->post('AlumnoNombre');
                $mail = $this->input->post('AlumnoMail');
                $tfijo = $this->input->post('AlumnoFijo');
                $tcel = $this->input->post('AlumnoMovil');
                $direccion = $this->input->post('AlumnoDir');
                $DUI = $this->input->post('AlumnoDUI');
                $nacimiento = $this->input->post('AlumnoFNac');
                $carrera = $this->input->post('AlumnoCarrera');
                $nivelAcad = $this->input->post('AlumnoNivel');
                $encargado = $this->input->post('AlumnoNEncargado');
                $categoria = $this->input->post('AlumnoCategoria');
                $descripcion = $this->input->post('AlumnoDescripcion');
                $comentarios = $this->input->post('AlumnoComentario');
                $genero = $this->input->post('AlumnoGenero');
                $universidad = 0;
                $umodifica = 0;
                $ipModifica = '192.168.1.1';
                $fechaModifica = date('d/m/Y');
                $arrayData = $this->Participantes->ModificarParticipante($codigo, $nombre, $mail, $tfijo, $tcel, $direccion, $nacimiento, $categoria, $umodifica, $ipModifica, $fechaModifica, $universidad,$genero, $DUI, $carrera, $nivelAcad, $encargado, $descripcion, $comentarios);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    public function eliminar() {
        $eliminado = false;
        try {
            if ($this->input->post()) {
                $codigo = $this->input->post('AlumnoCodigo');
                $eliminado = $this->Participantes->EliminarParticipante($codigo);
                echo $eliminado;
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    public function buscar() {
        try {
            if ($this->input->post()) {
                $nombre = $this->input->post('NombreBuscado');
                $result = json_decode(json_encode($this->Participantes->listarParticipantesByName($nombre)), true);
                $registros = $this->EncabezadoTabla();
                foreach ($result as $req) {
                    $registros .= '<tr id="alum' . $req['CodigoParticipante'] . '">';
                    $registros .= '<td class="Mail_Alumno">'.$req['CorreoElectronico'].'</td>';
                    $registros .= '<td class="TelefonoFijo_Alumno" style="display: none">' . $req['TelefonoFijo'] . '</td>';
                    $registros .= '<td class="TelefonoMovil_Alumno" style="display: none">' . $req['TelefonoCelular'] . '</td>';
                    $registros .= '<td class="Direccion_Alumno" style="display: none">' . $req['Direccion'] . '</td>';
                    $registros .= '<td class="DUI_Alumno" style="display: none">' . $req['NumeroDUI'] . '</td>';
                    $registros .= '<td class="Genero_Alumno" style="display: none">'. $req['Genero'] . '</td>';
                    $registros .= '<td class="Nombre_Alumno">' . $req['Nombre'] . '</td>';
                    $registros .= '<td class="FechaNac_Alumno" style="display: none">' . $req['FechaNacimiento'] . '</td>';
                    $registros .= '<td class="CodU_Alumno" style="display: none">' . $req['CodigoUniversidadProcedencia'] . '</td>';
                    $registros .= '<td class="Carrera_Alumno" style="display: none">' . $req['Carrera'] . '</td>';
                    $registros .= '<td class="NivelAcad_Alumno" style="display: none">' . $req['NivelAcademico'] . '</td>';
                    $registros .= '<td class="NombreEncargado_Alumno" style="display: none">' . $req['NombreEncargado'] . '</td>';
                    $registros .= '<td class="CodCat_Alumno" style="display: none">' . $req['CodigoCategoriaParticipantes'] . '</td>';
                    $registros .= '<td class="NameCat_Alumno">' . $req['NombreCategoriaParticipante'] . '</td>';
                    $registros .= '<td class="Descripcion_Alumno">' . $req['Descripcion'] . '</td>';
                    $registros .= '<td class="Comentarios_Alumno" style="display: none">' . $req['Comentarios'] . '</td>';
                    $registros .= '<td class="gestion_Alumno">';
                    $registros .= '<button id="alumE' . $req['CodigoParticipante'] . '" onclick="mostrarEditAlumno(this)" title="Editar Alumno" class="btn_modificar_alum btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>';
                    $registros .= '<button id="alumDEL' . $req['CodigoParticipante'] . '" onclick="mostrarDelAlumno(this)" title="Eliminar Alumno" class="btn_eliminar_alum btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
                    $registros .= '<button id="alumVIEW' . $req['CodigoParticipante'] . '" onclick="mostrarInfoAlumno(this)" title="Ver Alumno" class="btn_ver_alum btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></button>';
                    $registros .= '<button id="alumGROUP' . $req['CodigoParticipante'] . '" onclick="mostrarGruposPeriodos(this)" title="Agregar a Grupo" class="btn_group_add btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span></button>';
                    $registros .= '</td></tr>';
                }
                $registros .='</tbody></table>';
                echo $registros;
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    /*********PAGINACION DE PARTICIPANTES EN DASHBOARD***/
    public function paginParticipantes($Parti= null) {
        try {
            $final = 0;
            $pagAct = 0;
            $cadena = '';
            $filas = '';
            $Alumnos = array();

            if ($this->input->post()) {
                if ($this->input->post('data_ini') != null) {
                    $pagAct = $this->input->post('data_ini');
                    $final = $this->input->post('data_ini');
                    
                    if ($pagAct <= 0) {
                        $pagAct = 1;
                        $final = 1;
                    }else if($pagAct > $this->getTotalPaginas()) {
                        $pagAct =$this->getTotalPaginas();
                        $final=$this->getTotalPaginas();
                    }
                    
                } else if ($this->input->post('data_inip') != null) {
                    $pagAct = $this->input->post('data_inip') - 1;
                    $final = $this->input->post('data_inip') - 1;
                    if ($pagAct <= 0) {
                        $pagAct = 1;
                        $final = 1;
                    }
                } else if ($this->input->post('data_inin') != null) {
                    $pagAct = $this->input->post('data_inin');
                    $pagAct+=1;
                    $final = $this->input->post('data_inin');
                    $final+=1;
                    if ($pagAct > $this->getTotalPaginas()) {
                        $pagAct =$this->getTotalPaginas();
                        $final=$this->getTotalPaginas();
                    }  else {
                        
                    }
                } else {
                    $pagAct = 1;
                    $final = 1;
                }
            }
            $inicio = ROWS_PER_PAGE;
            $final = ($final * ROWS_PER_PAGE) - ROWS_PER_PAGE;
            if ($Parti != null) {

                array_push($Alumnos, $Parti);
            } else {
                $Alumnos = $this->Participantes->listarParticipantesLimited($inicio, $final);
            }

//            $buttonsByUserRights = $this->analizarPermisosBotonesTablas("gestionUserBtn", $this->session->userdata('permisosUsuer'));

            $cadena .= $this->EncabezadoTabla();
            foreach ($Alumnos as $alum) {
                $filas.='<tr id="alum' . $alum->CodigoParticipante . '">';
                $filas.='<td class="Mail_Alumno">'.$alum->CorreoElectronico.'</td>';
                $filas.='<td class="TelefonoFijo_Alumno" style="display: none">'.$alum->TelefonoFijo.'</td>';
                $filas.='<td class="TelefonoMovil_Alumno" style="display: none">'. $alum->TelefonoCelular.'</td>';
                $filas.='<td class="Direccion_Alumno" style="display: none">'.$alum->Direccion.'</td>';
                $filas.='<td class="DUI_Alumno" style="display: none">'.$alum->NumeroDUI.'</td>';
                $filas.='<td class="Genero_Alumno" style="display: none">'.$alum->Genero.'</td>';
                $filas.='<td class="Nombre_Alumno">'.$alum->Nombre.'</td>';
                $filas.='<td class="FechaNac_Alumno" style="display: none">'.$alum->FechaNacimiento.'</td>';
                $filas.='<td class="CodU_Alumno" style="display: none">'.$alum->CodigoUniversidadProcedencia.'</td>';
                $filas.='<td class="Carrera_Alumno" style="display: none">'.$alum->Carrera.'</td>';
                $filas.='<td class="NivelAcad_Alumno" style="display: none">'.$alum->NivelAcademico.'</td>';
                $filas.='<td class="NombreEncargado_Alumno" style="display: none">'.$alum->NombreEncargado.'</td>';
                $filas.='<td class="CodCat_Alumno" style="display: none">'.$alum->CodigoCategoriaParticipantes.'</td>';
                $filas.='<td class="NameCat_Alumno">'.$alum->NombreCategoriaParticipante.'</td>';
                $filas.='<td class="Descripcion_Alumno">'.$alum->Descripcion.'</td>';
                $filas.='<td class="Comentarios_Alumno" style="display: none">'.$alum->Comentarios.'</td>';
                $filas.='<td class="gestion_Alumno">
                            <button id="alumE'.$alum->CodigoParticipante.'" onclick="mostrarEditAlumno(this)" title="Editar Alumno" class="btn_modificar_alum btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
                            <button id="alumDEL'.$alum->CodigoParticipante.'" onclick="mostrarDelAlumno(this)" title="Eliminar Alumno" class="btn_eliminar_alum btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                            <button id="alumVIEW'.$alum->CodigoParticipante.'" onclick="mostrarInfoAlumno(this)" title="Ver Alumno" class="btn_ver_alum btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></button>
                            <button id="alumGROUP'.$alum->CodigoParticipante.'" onclick="mostrarGruposPeriodos(this)" title="Agregar a Grupo" class="btn_group_add btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span></button>
                        </td></tr>';
//                $filas.=' <td style="text-align:center"  class="gestion_User">' . $buttonsByUserRights . '</td> </tr>';
            }
            $cadena.=$filas;
            $cadena.='</tbody></table>';
            $cadena.=' <div class="row">
            <ul class="pager" id="footpagerParticipantes">
               <li><button data-datainic="1" id="aFirstPagParticipantes" >&lt;&lt;</button></li>
                <li><button id="aPrevPagParticipantes" >&lt;</button></li>
                <li><input data-datainic="' . $pagAct . '" type="text" value="' . $pagAct . '" id="txtPagingSearchParticipantes" name="txtNumberPag" size="5">/' . $this->getTotalPaginas() . '</li>
                 <li><button id="aNextPagParticipantes">&gt;</button></li>
                <li><button id="aLastPagParticipantes" data-datainic="' . $this->getTotalPaginas() . '" >&gt;&gt;</button></li>
                <li>[' . ($final + 1) . ' - ' . ($final + count($Alumnos)) . ' / ' . count($this->Participantes->listarParticipantes()) . ']</li></ul></div>';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if ($this->input->post('data_ini') || $this->input->post('data_inin') || $this->input->post('data_inip')) {
            echo ($cadena);
        } else {
            return $cadena;
        }
    }
    
    ///ENCABEZADO DE LA TABLA ALUMNOS(para busqueda y paginado)
    private function EncabezadoTabla(){
        $encabezado='<table id="tableAlumnos" class="table table-bordered table-striped table-hover table-responsive">
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
                    <tbody>';
        return $encabezado;
    }
}
