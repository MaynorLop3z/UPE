<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ModulosController extends CI_Controller {

    public function __construct() {
        try{
        parent::__construct();
        $this->load->database();
        $this->load->model('Modulos');
        
    }  catch (Exception $exc){
        echo $exc->getTraceAsString();
    }}

public function index() {
try{
        $data['Modulos'] = $this->Modulos->listarModulos();
        $data['ModulosDip'] = $this->Modulos->listarDiplomados(); //ESto lo acabo de escribir
        //$data['Turno'] = $this->Turnos->listarTurnos();
        $this->load->view('Modulos', $data);
    }  catch (Exception $exc){
        echo $exc->getTraceAsString();
    }
}

public function guardarModulo($CodigoModulo = null)
{
        try {
        if($this->input->post()){
            $NombreModulo= $this->input->post('ModuloNombre');
            $OrdenModulo= $this->input->post('ModuloOrden');
            $radio = $this->input->post('radio');
            $turno = $this->input->post("Turno");
            $nombreDiplomado = $this->input->post('$NombreDiplomado');
            $ComentarioModulo  = $this->input->post('ComentarioMod');
            $ip = $this->session->userdata('ipUserMo');// La ip del usuario que modifica 
            $userModi = $this->session->userdata('codigoUserMo'); //codigo del usuario qeumodifica 
            $fechaMo = $this->session->userdata('fechaMo');
            $this->load->model('Modulos');
            
            $arrayData = $this->Modulos->crearModulo(null, $NombreModulo,$OrdenModulo,$radio,$userModi,$ip,$fechaMo,$turno,$nombreDiplomado,$ComentarioModulo);
        }   echo json_encode($arrayData);
        
    } catch (Exception $exc) {
        $data = array(
            'Error' => $exc->getMessage(),
        );
        echo json_encode($data);
    }
    
    
}}
