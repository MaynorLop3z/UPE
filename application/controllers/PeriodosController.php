<?php

/**
 * Description of GestionPeriodos
 *
 * @author maynorlop3z
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class PeriodosController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Periodos');
    }

    public function insertPeriodo() {
        try {
            if ($this->input->post('idModulo')) {
                $FechaInico = $this->input->post('FechaInicio');
                $FechaFin = $this->input->post('FechaFin');
                $Estado = $this->input->post('estadoPeriodo');
                $Modulo = $this->input->post('idModulo');
                $Comentarios = $this->input->post('ComentariosPeriodo');
                $data = $this->Periodos->crearPeriodo($FechaInico, $FechaFin, $Estado, $Comentarios, $Modulo);
                echo json_decode($data);
            } else {
                echo 'nada';
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    public function insertGrupo() {
        try {
            if ($this->input->post('idPeriodo')) {
                $HoraEntrada = $this->input->post('HoraEntrada');
                $HoraSalida = $this->input->post('HoraSalida');
                $idPeriodo = $this->input->post('idPeriodo');
                $Aula = $this->input->post('Aula');
                $data = $this->Periodos->crearGrupo($idPeriodo, $HoraEntrada, $HoraSalida, $Aula);
                echo json_encode($data);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    public function listarByModulo() {
        $totalPaginasPeriodos = 0;
        $ToTalRegistrosPeriodos=0;
        $periodosMostrados=0;
        if ($this->input->post('idModulo')) {
            $idModulo = $this->input->post('idModulo');
            $Periodos = $this->Periodos->listarPeriodosByModuloLimited($idModulo, null);

            $totalPaginasPeriodos = intval(ceil($this->Periodos->countAllPeriodos($idModulo) / ROWS_PER_PAGE));
            $ToTalRegistrosPeriodos = $this->Periodos->countAllPeriodos($idModulo);
            $periodosMostrados = count($Periodos);
            $cadena = '';
            foreach ($Periodos as $period) {
                $cadena .='<tr id="Periodo' . $period->CodigoPeriodo . '">';
                $cadena .= '<th class="fip">' . $period->FechaInicioPeriodo . '</th>';
                $cadena .= '<th class="ffp">' . $period->FechaFinPeriodo . '</th>';
                if ($period->Estado == 't') {
                    $cadena .= '<th class="ep">Activo</th>';
                } else {
                    $cadena .= '<th class="ep">Inactivo</th>';
                }
                $cadena .= '<th class="cp">' . $period->Comentario . '</th>';
                $cadena .= '<th><button id="PeriodoE' . $period->CodigoPeriodo . '" onclick="EditPeriodoShow(this)" title="Editar Periodo" class="btn_modificar_periodo btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>';
                $cadena .= '<button id="PeriodoDEL' . $period->CodigoPeriodo . '" onclick="DeletePeriodoShow(this)" title="Eliminar Periodo" class="btn_eliminar_periodo btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
                $cadena .= '<button id="PeriodoGES' . $period->CodigoPeriodo . '" onclick="GestionPeriodoShow(this)" title="Gestionar Periodo" class="btn_gestionar_periodo btn btn-info"><span class="glyphicon glyphicon-cog"></span></button></th></tr>';
            }
//            echo $cadena;
            $data = array(
            "cadena" => $cadena,
            "totalPagPer"=> $totalPaginasPeriodos,
            "totalRegPer"=> $ToTalRegistrosPeriodos,
            "periodosMos" => $periodosMostrados
        );
        echo json_encode($data);
        }
    }

    public function deletePeriodo() {

        if ($this->input->post('PeriodoCodigo')) {
            $CodigoPeriodo = $this->input->post('PeriodoCodigo');
            $estado = $this->Periodos->EliminarPeriodo($CodigoPeriodo);
        } else {
            $estado = 0;
        }
        echo $estado;
    }

    public function editPeriodo() {
        try {
            if ($this->input->post()) {
                $Codigo = $this->input->post('idPeriodo');
                $FechaInicio = $this->input->post('FechaInicio');
                $FechaFinal = $this->input->post('FechaFinal');
                $Comentarios = $this->input->post('Comentarios');
                $Estado = $this->input->post('Estado');
                $arrayData = $this->Periodos->ModificarPeriodo($Codigo, $FechaInicio, $Estado, $FechaFinal, $Comentarios);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    public function listarGrupos() {
        try {
            if ($this->input->post()) {
                $Codigo = $this->input->post('idPeriodo');
                $arrayData = $this->Periodos->listarGrupos($Codigo);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }
    
        public function listarGruposHorarios() {
        try {
            if ($this->input->post()) {
                $Codigo = $this->input->post('idPeriodo');
                $arrayData = $this->Periodos->listarGruposHorarios($Codigo);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    public function listarGruposPeriodos() {
        try {
            if ($this->input->post()) {
                $Codigo = $this->input->post('idPeriodo');
                $arrayData = $this->Periodos->Periodos();
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    public function listarDocentes() {
        try {
            if ($this->input->post()) {
                $Codigo = $this->input->post('idPeriodoGrupo');
                $docentes = $this->Periodos->getMasters($Codigo);
                $result = '';
                foreach ($docentes as $docente) {
                    $result .= '<tr id="GrupoUser' . $docente->CodigoUsuario . '">\n';
                    $result .= '<td class="DocenteUsuario">' . $docente->Nombre . '</td>\n';
                    $result .= '<td class="DocenteInscrito">';
                    if ($docente->Inscrito > 0) {
                        $result .= '<button id="GrupoDocenteADD' . $docente->CodigoUsuario . '" onclick="asignarDocente(this)" title="Desasignar docente al periodo" class="btn_agregar_docente btn btn-danger"><span class="glyphicon glyphicon-remove"></span> </button>';
                    } else {
                        $result .= '<button id="GrupoDocenteADD' . $docente->CodigoUsuario . '" onclick="asignarDocente(this)" title="Asignar docente al periodo" class="btn_agregar_docente btn btn-success"><span class="glyphicon glyphicon-ok"></span> </button>';
                    }
                    $result .= '</td>\n</tr>\n';
                }
                echo $result;
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    public function inscribirDocente() {
        try {
            if ($this->input->post()) {
                $idGrupoPeriodo = $this->input->post('idGrupoPeriodo');
                $idUsuario = $this->input->post('idUsuario');
                $arrayData = $this->Periodos->inscribirDocente($idGrupoPeriodo, $idUsuario);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }
    
    public function listarEstudiantes() {
        try {
            if ($this->input->post()) {
                $Codigo = $this->input->post('idPeriodoGrupo');
                $estudiantes = $this->Periodos->getStudents($Codigo, ROWS_PER_PAGE);
                $Nestudiantes = count($this->Periodos->getStudents($Codigo));
                $result = '';
                foreach ($estudiantes as $estudiante) {
                    $result .= '<tr id="GrupoEstudiante' . $estudiante->CodigoParticipante . '">\n';
                    $result .= '<td class="NombreEstudiante">' . $estudiante->Nombre . '</td>\n';
                    $result .= '<td class="DUIEstudiante">' . $estudiante->NumeroDUI . '</td>\n';
                    $result .= '<td class="CategoriaEstudiante">' . $estudiante->NombreCategoriaParticipante . '</td>\n';
                    $result .= '<td class="ComentariosEstudiante">' . $estudiante->Comentarios . '</td>\n';
                    $result .= '<td class="EstudianteInscrito">';
                    if ($estudiante->Inscrito > 0) {
                        $result .= '<button id="GrupoAlumnoADD' . $estudiante->CodigoParticipante . '" onclick="inscribirAlumnoGrupo(this)" title="Quitar alumno del periodo" class="btn_agregar_alumno btn btn-danger"><span class="glyphicon glyphicon-remove"></span> </button>';
                    } else {
                        $result .= '<button id="GrupoAlumnoADD' . $estudiante->CodigoParticipante . '" onclick="inscribirAlumnoGrupo(this)" title="Agregar alumno al periodo" class="btn_agregar_alumno btn btn-success"><span class="glyphicon glyphicon-ok"></span> </button>';
                    }
                    $result .= '</td>\n</tr>\n';
                }
                if($Nestudiantes>ROWS_PER_PAGE){
                $result.='<tr>
                        <td colspan=6 ><div class="row">
                            <hr>
                            <ul class="pager" id="footpagerParticipantesInscribir">
                                <li><button data-datainic="1" id="aFirstPagParticipantesInscribir" >&lt;&lt;</button></li>
                                <li><button id="aPrevPagParticipantesInscribir" >&lt;</button></li>
                                <li>
                                    <input data-datainic="1" type="text" value="1" id="txtPagingSearchParticipantesInscribir" name="txtNumberPag" size="5">/'.intval(ceil($Nestudiantes/ ROWS_PER_PAGE)).'
                                </li>
                                <li><button id="aNextPagParticipantesInscribir">&gt;</button></li>
                                <li><button id="aLastPagParticipantesInscribir" data-datainic="'.intval(ceil($Nestudiantes/ ROWS_PER_PAGE)).'" >&gt;&gt;</button></li>
                                <li id="pagerParticipantesInscribir">[ 1 - '.ROWS_PER_PAGE . "/" . $Nestudiantes. ']</li>
                            </ul>
                        </div></td>
                        </tr>';
                }
                echo $result;
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }
    
    public function paginEstudiantes($Estudian = null) {
        try {
            $final = 0;
            $pagAct = 0;
            $grupo = 0;
            $cadena = '';
            $filas = '';
            $result = '';
            $estudiantes = array();
            if ($this->input->post()) {
                $grupo=$this->input->post('idPeriodoGrupo');
                $totalPaginas=intval(ceil(count($this->Periodos->getStudents($grupo))/ ROWS_PER_PAGE));
                if ($this->input->post('data_ini') != null) {
                    $pagAct = $this->input->post('data_ini');
                    $final = $this->input->post('data_ini');
                    
                    if ($pagAct <= 0) {
                        $pagAct = 1;
                        $final = 1;
                    }else if($pagAct > $totalPaginas) {
                        $pagAct =$totalPaginas;
                        $final=$this->$totalPaginas;
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
                    if ($pagAct > $totalPaginas) {
                        $pagAct =$totalPaginas;
                        $final=$totalPaginas;
                    }  else {
                        
                    }
                } else {
                    $pagAct = 1;
                    $final = 1;
                }
            }
            $inicio = ROWS_PER_PAGE;
            $final = ($final * ROWS_PER_PAGE) - ROWS_PER_PAGE;
            if ($Estudian != null) {

                array_push($estudiantes, $Estudian );
            } else {
                $estudiantes = $this->Periodos->getStudents($grupo, $inicio, $final);
            }

            foreach ($estudiantes as $estudiante) {
                    $result .= '<tr id="GrupoEstudiante' . $estudiante->CodigoParticipante . '">\n';
                    $result .= '<td class="NombreEstudiante">' . $estudiante->Nombre . '</td>\n';
                    $result .= '<td class="DUIEstudiante">' . $estudiante->NumeroDUI . '</td>\n';
                    $result .= '<td class="CategoriaEstudiante">' . $estudiante->NombreCategoriaParticipante . '</td>\n';
                    $result .= '<td class="ComentariosEstudiante">' . $estudiante->Comentarios . '</td>\n';
                    $result .= '<td class="EstudianteInscrito">';
                    if ($estudiante->Inscrito > 0) {
                        $result .= '<button id="GrupoAlumnoADD' . $estudiante->CodigoParticipante . '" onclick="inscribirAlumnoGrupo(this)" title="Quitar alumno del periodo" class="btn_agregar_alumno btn btn-danger"><span class="glyphicon glyphicon-remove"></span> </button>';
                    } else {
                        $result .= '<button id="GrupoAlumnoADD' . $estudiante->CodigoParticipante . '" onclick="inscribirAlumnoGrupo(this)" title="Agregar alumno al periodo" class="btn_agregar_alumno btn btn-success"><span class="glyphicon glyphicon-ok"></span> </button>';
                    }
                    $result .= '</td>\n</tr>\n';
                }
                $result.='<tr>
                        <td colspan=6 ><div class="row">
                            <hr>
                            <ul class="pager" id="footpagerParticipantesInscribir">
                                <li><button data-datainic="1" id="aFirstPagParticipantesInscribir" >&lt;&lt;</button></li>
                                <li><button id="aPrevPagParticipantesInscribir" >&lt;</button></li>
                                <li>
                                    <input data-datainic="' . $pagAct .'" type="text" value="' . $pagAct .'" id="txtPagingSearchParticipantesInscribir" name="txtNumberPag" data-mask = "000000000" size="5">/'.$totalPaginas.'
                                </li>
                                <li><button id="aNextPagParticipantesInscribir">&gt;</button></li>
                                <li><button id="aLastPagParticipantesInscribir" data-datainic="'.$totalPaginas.'" >&gt;&gt;</button></li>
                                <li id="pagerParticipantesInscribir">[ '. ($final + 1) . ' - '.($final + count($estudiantes)). "/" . count($this->Periodos->getStudents($grupo)). ']</li>
                            </ul>
                        </div></td>
                        </tr>';
            $cadena.=$result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if ($this->input->post('data_ini') || $this->input->post('data_inin') || $this->input->post('data_inip')) {
            echo ($cadena);
        } else {
            return $cadena;
        }
    }

    //PAGINAR
    function getTotalPaginas($id) {
        return $result = intval(ceil($this->Periodos->countAllPeriodos($id) / ROWS_PER_PAGE));
    }
    
    public function paginPeriodos($Periodo = null) {
        try {
            $final = 0;
            $pagAct = 0;
            $cadena = '';
            $filas = '';
            $Periodos = array();
            $idMo=$this->input->post('modulo');
            if ($this->input->post()) {
                if ($this->input->post('data_ini') != null) {
                    $pagAct = $this->input->post('data_ini');
                    $final = $this->input->post('data_ini');
                    
                    if ($pagAct <= 0) {
                        $pagAct = 1;
                        $final = 1;
                    }else if($pagAct > $this->getTotalPaginas($idMo)) {
                        $pagAct =$this->getTotalPaginas($idMo);
                        $final=$this->getTotalPaginas($idMo);
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
                    if ($pagAct > $this->getTotalPaginas($idMo)) {
                        $pagAct =$this->getTotalPaginas($idMo);
                        $final=$this->getTotalPaginas($idMo);
                    }  else {
                        
                    }
                } else {
                    $pagAct = 1;
                    $final = 1;
                }
            }
            $inicio = ROWS_PER_PAGE;
            $final = ($final * ROWS_PER_PAGE) - ROWS_PER_PAGE;
            if ($Periodo != null) {

                array_push($Periodos, $Periodo);
            } else {
                $Periodos = $this->Periodos->listarPeriodosL($idMo, $inicio, $final);
            }

//            $buttonsByUserRights = $this->analizarPermisosBotonesTablas("gestionUserBtn", $this->session->userdata('permisosUsuer'));

            $cadena .= '<table border="1" class="table table-bordered table-hover">';
            $cadena.='<thead>
                    <tr>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Estado</th>
                        <th>Comentarios</th>
                        <th>Gestion</th>
                    </tr>
                </thead>
            <tbody id="bodytablaPeriodos">';
            foreach ($Periodos as $per) {
                $filas.='<tr id="Periodo' . ($per->CodigoPeriodo) . '">';
                $filas.='<th class="fip">'.$per->FechaInicioPeriodo.'</th>';
                $filas.='<th class="ffp">'.$per->FechaFinPeriodo.'</th>';
                $filas.='<th class="ep">'.(($per->Estado === 't') ? 'Activo' : 'Inactivo').'</th>';
                $filas.='<th class="cp">'.$per->Comentario.'</th>';
                $filas.='<th>
                            <button id="PeriodoE'.$per->CodigoPeriodo.'" onclick="EditPeriodoShow(this)" title="Editar Periodo" class="btn_modificar_periodo btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
                            <button id="PeriodoDEL'.$per->CodigoPeriodo.'" onclick="DeletePeriodoShow(this)" title="Eliminar Periodo" class="btn_eliminar_periodo btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                            <button id="PeriodoGES'.$per->CodigoPeriodo.'" onclick="GestionPeriodoShow(this)" title="Gestionar Periodo" class="btn_gestionar_periodo btn btn-info"><span class="glyphicon glyphicon-cog"></span></button>
                        </th>
                    </tr>';
            }
            $cadena.=$filas;
            $cadena.='</tbody></table>';
            $cadena.=' <div class="row"><hr>
            <ul class="pager" id="footpagerPeriodos">
               <li><button data-datainic="1" id="aFirstPagPeriodos" >&lt;&lt;</button></li>
                <li><button id="aPrevPagPeriodos" >&lt;</button></li>
                <li><input data-datainic="' . $pagAct . '" type="text" value="' . $pagAct . '" id="txtPagingSearchUsrPeriodos" data-mask = "000000000" name="txtNumberPag" size="5">'
                    . '<span id="pagerBetweenPer" style="background: none;margin:0;padding:0;">/' . $this->getTotalPaginas($idMo) . '</span></li>
                 <li><button id="aNextPagPeriodos">&gt;</button></li>
                <li><button id="aLastPagPeriodos" data-datainic="' . $this->getTotalPaginas($idMo) . '" >&gt;&gt;</button></li>
                <li id="pagerPeriodos">[' . ($final + 1) . ' - ' . ($final + count($Periodos)) . ' / ' . $this->Periodos->countAllPeriodos($idMo) . ']</li></ul></div>';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if ($this->input->post('data_ini') || $this->input->post('data_inin') || $this->input->post('data_inip')) {
            echo ($cadena);
        } else {
            return $cadena;
        }
    }

}
