<?php
/**
 * Description of GestionPeriodos
 *
 * @author maynorlop3z
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class GestionGruposController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Periodos');
    }
    
    public function  insertPeriodo(){
        try {
        if($this->input->post('idModulo')){
        $FechaInico = $this->input->post('FechaInicio');
        $FechaFin = $this->input->post('FechaFin');
        $Estado = $this->input->post('estadoPeriodo');
        $Modulo = $this->input->post('idModulo');
        $Comentarios = $this->input->post('ComentariosPeriodo');
        $data = $this->Periodos->crearPeriodo($FechaInico,$FechaFin,$Estado,$Comentarios,$Modulo);
        echo json_decode($data);
        }
        }
        catch (Exception $ex) {
            echo json_encode($ex);
        }
    }
}
