<?php
/**
 * Description of GestionGrupos
 *
 * @author maynorlop3z
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class GestionGruposController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Diplomados');
//        $this->load->model('usuarios');
    }

    public function index() {
        $datos['Categorias'] = $this->Diplomados->listarCategoriasDiplomados();
        $cats = (array) $datos['Categorias'][0];
        $idCategoria = $cats['CodigoCategoriaDiplomado'];
        $datos['Diplomados'] = $this->Diplomados->listarDiplomadosCategoria($idCategoria);
        $dips = (array) $datos['Diplomados'][0];
        $idDiplomado = $dips['CodigoDiplomado'];
        $datos['Modulos'] = $this->Diplomados->listarModulos($idDiplomado);
        $mods = (array) $datos['Modulos'][0];
        $idModulo = $mods['CodigoModulo'];
        $datos['Periodos'] = $this->Diplomados->listarPeriodosByModulo($idModulo);
        $this->load->view('Periodos', $datos);
    }

    public function getDiplomados() {
        $codigoCat = $this->input->post('idCategoria');
        $diplomados =''; $modulos =''; $periodos ='';
        $Ldiplomados = $this->Diplomados->listarDiplomadosCategoria($codigoCat);
        foreach ($Ldiplomados as $dip){
            $diplomados .= '<option value="' . $dip->CodigoDiplomado . '">' . $dip->NombreDiplomado . '</option>';
        }
        if (count($Ldiplomados) > 0) {
            $temp = (array)$Ldiplomados[0];
            $LModulos = $this->Diplomados->listarModulos($temp["CodigoDiplomado"]);
            foreach ($LModulos as $mod){
                $modulos .= '<option value="' . $mod->CodigoModulo . '">' . $mod->NombreModulo . '</option>';
            }
            if (count($LModulos) > 0) {
                $temp = (array)$LModulos[0];
                $LPeriodos = $this->Diplomados->listarPeriodosByModulo($temp["CodigoModulo"]);
                foreach ($LPeriodos as $per) {
                    $periodos .= '<tr id="Periodo' . $per->CodigoPeriodo . '">';
                                   $periodos .= '<th class="fip">' . $per->FechaInicioPeriodo . '</th>';
                                    $periodos .= '<th class="ffp">' . $per->FechaFinPeriodo . '</th>';
                                    if ($per->Estado === 't') {
                                        $periodos .= '<th class="ep">Activo</th>';

                                    } else {
                                        $periodos .= '<th class="ep">Inactivo</th>';
                                    }
                                    $periodos .= '<th class="cp">' . $per->Comentario . '</th>';
                                    $periodos .= '<th>';
                                    $periodos .= '<button id="PeriodoE' . $per->CodigoPeriodo . '" onclick="EditPeriodoShow(this)" title="Editar Periodo" class="btn_modificar_periodo btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>';
                                    $periodos .= '<button id="PeriodoDEL' . $per->CodigoPeriodo . '" onclick="DeletePeriodoShow(this)" title="Eliminar Periodo" class="btn_eliminar_periodo btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
                                    $periodos .= '<button id="PeriodoGES' . $per->CodigoPeriodo . '" onclick="GestionPeriodoShow(this)" title="Gestionar Periodo" class="btn_gestionar_periodo btn btn-info"><span class="glyphicon glyphicon-cog"></span></button>';
                                    $periodos .= '</th></tr>';
                }
            }
        }
        $data = array(
            "diplomados" => $diplomados,
            "modulos" => $modulos,
            "periodos" => $periodos
        );
        echo json_encode($data);
    }
public function getPeriodos($id){
    
}

public function getModulos() {
        if ($this->input->post('idDiplomado')) {
            $codigoDiplomado = $this->input->post('idDiplomado');
            $modulos = $this->Diplomados->listarModulos($codigoDiplomado);
            $Lmodulos = '';
            $periodos = '';
            foreach ($modulos as $modul) {
                
                $Lmodulos .= '<option value="'. $modul->CodigoModulo .'">'. $modul->NombreModulo .'</option>';   
            }
            if (count($modulos) > 0) {
                $temp = (array)$modulos[0];
                $LPeriodos = $this->Diplomados->listarPeriodosByModulo($temp["CodigoModulo"]);
                foreach ($LPeriodos as $per) {
                    $periodos .= '<tr id="Periodo' . $per->CodigoPeriodo . '">';
                                   $periodos .= '<th class="fip">' . $per->FechaInicioPeriodo . '</th>';
                                    $periodos .= '<th class="ffp">' . $per->FechaFinPeriodo . '</th>';
                                    if ($per->Estado === 't') {
                                        $periodos .= '<th class="ep">Activo</th>';

                                    } else {
                                        $periodos .= '<th class="ep">Inactivo</th>';
                                    }
                                    $periodos .= '<th class="cp">' . $per->Comentario . '</th>';
                                    $periodos .= '<th>';
                                    $periodos .= '<button id="PeriodoE' . $per->CodigoPeriodo . '" onclick="EditPeriodoShow(this)" title="Editar Periodo" class="btn_modificar_periodo btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>';
                                    $periodos .= '<button id="PeriodoDEL' . $per->CodigoPeriodo . '" onclick="DeletePeriodoShow(this)" title="Eliminar Periodo" class="btn_eliminar_periodo btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
                                    $periodos .= '<button id="PeriodoGES' . $per->CodigoPeriodo . '" onclick="GestionPeriodoShow(this)" title="Gestionar Periodo" class="btn_gestionar_periodo btn btn-info"><span class="glyphicon glyphicon-cog"></span></button>';
                                    $periodos .= '</th></tr>';
                }
            }
            $data = array(
            "modulos" => $Lmodulos,
            "periodos" => $periodos
        );
        echo json_encode($data);
        }
    }

    public function insertPeriodo() {
        try {
            if ($this->input->post('idModulo')) {
                //$this->load->model('Periodos');
                $FechaInico = $this->input->post('FechaInicio');
                $FechaFin = $this->input->post('FechaFin');
                $Estado = $this->input->post('estadoPeriodo');
                $Modulo = $this->input->post('idModulo');
                $Comentarios = $this->input->post('ComentariosPeriodo');
                $data = $this->Diplomados->crearPeriodo($FechaInico, $FechaFin, $Estado, $Comentarios, $Modulo);
                echo json_decode($data);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

}
