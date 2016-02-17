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
        $data['Modulos'] = $this->Modulos->listarModulos(null,null);
        $data['Diplomados'] = $this->Modulos->listarDiplomados(); //ESto lo acabo de escribir
        $data['Turno'] = $this->Modulos->listarTurnos(); // Seleccionar el Modulo
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
            $estado = $this->input->post('Estado');
            $turno = $this->input->post('Turno');
            $nombreDiplomado = $this->input->post('NombreDiplomado');
            $ComentarioModulo  = $this->input->post('ComentarioMod');
            $ip = $this->session->userdata('ipUserMo');// La ip del usuario que modifica 
            $userModi = $this->session->userdata('codigoUserMo'); //codigo del usuario qeumodifica 
           
            $this->load->model('Modulos');
            //,
            $arrayData = $this->Modulos->crearModulo(null, $NombreModulo,$OrdenModulo,$ip,$turno,$estado,$userModi,$nombreDiplomado,$ComentarioModulo);
        }   echo json_encode($arrayData);
        
    } catch (Exception $exc) {
        $data = array(
            'Error' => $exc->getMessage(),
        );
        echo json_encode($data);
    }
    
    
}
public function  editarModulo(){
    
}
public function  EliminarModulo(){
    
}
   
    
public function BuscarModulos(){
        
        
    }
           
 }