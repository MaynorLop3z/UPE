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
        $this->load->model('Diplomados'); // Esto agregue 21 /02/2016  2:16 PM;
        
    }  catch (Exception $exc){
        echo $exc->getTraceAsString();
    }}

public function index() {
try{
        $data['Modulos'] = $this->Modulos->listarModulos();
        $data['Diplomados'] = $this->Modulos->listarDiplomados(); //ESto lo acabo de escribir
        $data['Turno'] = $this->Modulos->listarTurnos(); // Seleccionar el Modulo
        $this->load->view('Modulos', $data);
    }  catch (Exception $exc){
        echo $exc->getTraceAsString();
    }
}

public function guardarModulo()
{
        try {
        if($this->input->post()){
            $NombreModulo= $this->input->post('ModuloNombre');
            $OrdenModulo= $this->input->post('ModuloOrden');
            $Estado = $this->input->post('Estado');
            $CodigoTurno = $this->input->post('Turno');
            $CodigoDiplomado = $this->input->post('DiplomadoName');
            $Comentarios  = $this->input->post('ComentarioMod');
          
       $ip = $this->session->userdata('ipUserMo');// La ip del usuario que modifica   $userModi
       $userModi = $this->session->userdata('codigoUserMo'); //codigo del usuario qeumodifica  $ip,
            $arrayData = $this->Modulos->crearModulo($NombreModulo, $OrdenModulo, $CodigoTurno, $Estado,$CodigoDiplomado, $Comentarios);
        }   echo json_encode($arrayData);
        
    } catch (Exception $ex) {
         echo json_encode($ex);
    }
  
}
public function  editarModulo(){
    
}
public function  EliminarModulo(){
    
}
   
    
public function BuscarModulos(){
        
        
    }
           
}