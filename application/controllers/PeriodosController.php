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
        if ($this->input->post('idModulo')) {
            $idModulo = $this->input->post('idModulo');
            $Periodos = $this->Periodos->listarPeriodosByModulo($idModulo);
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
            echo $cadena;
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
                $arrayData = $this->Periodos->listarDocentesGrupos($Codigo);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

}
