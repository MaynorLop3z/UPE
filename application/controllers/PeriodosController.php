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

    public function listarByModulo() {
        if ($this->input->post('idModulo')) {
            $idModulo = $this->input->post('idModulo');
            $Periodos = $this->Periodos->listarPeriodosByModulo($idModulo);
            foreach ($Periodos as $period) {
                ?>
                <tr id="Periodo<?= $period->CodigoPeriodo ?>">
                    <th class="fip"><?= $period->FechaInicioPeriodo ?></th>
                    <th class="ffp"><?= $period->FechaFinPeriodo ?></th>
                    <th class="ep"><?= $period->Estado ?></th>
                    <th class="cp"><?= $period->Comentario ?></th>
                    <th>
                        <button id="PeriodoE<?= $period->CodigoPeriodo ?>" onclick="mostrarEditPeriodo(this)" title="Editar Periodo" class="btn_modificar_periodo btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>
                        <button id="PeriodoDEL<?= $period->CodigoPeriodo ?>" onclick="DeletePeriodoShow(this)" title="Eliminar Periodo" class="btn_eliminar_periodo btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
                    </th>
                </tr>
                <?php
            }
        }
    }
//    public function eliminarPeriodo($PeriodoCodigo){
//        $eliminado = false;
//          try {
//           $this->db->delete('Periodos', array('CodigoPeriodo' => $PeriodoCodigo));
//          if ($this->db->affected_rows() == 1){
//            $eliminado = true;
//        }
//        } catch (Exception $ex) {
//            $ex->getMessage();
//        }
//       return $eliminado;
//    }
    public function deletePeriodo(){
        
        if ($this->input->post('PeriodoCodigo')) {
            $CodigoPeriodo = $this->input->post('PeriodoCodigo');
            $estado = $this->Periodos->EliminarPeriodo($CodigoPeriodo);
        }
        else {
            $estado = 0;
        }
        echo $estado;
    }

    

}
