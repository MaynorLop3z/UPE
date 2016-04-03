<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ModulosController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Modulos');
      //  $this->load->model('Diplomados'); esto lo quite a las 10: 11 el 29 de marzo
        //$this->load->model('Turnos');
        
    }

public function index() {

        $data['Modulos'] = $this->Modulos->listarModulos();
        $data['Diplomados'] = $this->Modulos->listarDiplomados(); //ESto lo acabo de escribir
        $data['Turno'] = $this->Modulos->listarTurnos(); // Seleccionar el Modulo
        $this->load->view('Modulos',$data);
    
}

public function guardarModulo()
{
        try {
        if($this->input->post()){
            $NombreModulo= $this->input->post('ModuloNombre');
            $OrdenModulo= $this->input->post('ModuloOrden');
            $Estado = $this->input->post('Estado');
            $CodigoTurno = $this->input->post('Turno');
            $CodigoDiplomado = $this->input->post('CodDiplomado');
            $Comentarios  = $this->input->post('ComentarioMod');
            $ip = $this->session->userdata('ipUserLogin');// La ip del usuario que modifica   $userModi
            $userModi = $this->session->userdata('codigoUserLogin'); //codigo del usuario qeumodifica  $ip,
        
       
//       $pathView = APPPATH . 'views/VistaAyudaView.php';                    //ESto
//                $html = file_get_html($pathView);                          //lo puse 
//                $elemsWithRights = $html->getElementById('gestion_Mod');//30 marzo 216
           
                
                
          $arrayData = $this->Modulos->crearModulo($NombreModulo, $OrdenModulo, $CodigoTurno, $Estado,$CodigoDiplomado, $Comentarios,$ip,$userModi);
        }   echo json_encode($arrayData);
        
    } catch (Exception $ex) {
         echo json_encode($ex);
    }
  
}
public function  editarModulo(){
    try {
       if($this->input->post('CodigoModulo')){
           $codigoMo = $this->input->post('CodigoModulo');
                $NombreModulo = $this->input->post('ModuloNombre');
                $OrdenModulo = $this->input->post('ModuloOrden');
                $Estado = $this->input->post('Estado');
                $CodigoTurno = $this->input->post('Turno');
                $CodigoDiplomado = $this->input->post('CodDiplomado');
                $Comentarios = $this->input->post('ComentarioMod');
                $ip = $this->session->userdata('ipUserLogin'); // La ip del usuario que modifica   $userModi
                $userModi = $this->session->userdata('codigoUserLogin'); //codigo del usuario qeumodifica  $ip,
                
               // $this->load->model('Modulos');
                
                $arrayData = $this->Modulos->ModificarModulo($codigoMo, $NombreModulo,$OrdenModulo,$Estado,$CodigoTurno,$CodigoDiplomado,$Comentarios,$ip,$userModi);
           echo json_encode($arrayData);
       
           
           
       } 
    } catch (Exception $ex) {
        echo json_encode($ex);
    }   
}
public function  EliminarModulo(){
    try {
        if($this->input->post()){
            $codigoModulo = $this->input->post('CodigoModulo');
            if($codigoModulo !=null){
                $ip = $this->session->userdata('ipUserLogin');
                $userModifica = $this->session->userdata('codigoModulo');
                $arrayData = $this->Modulos->inactivarModulo($codigoModulo,$ip,$userModifica);
                echo json_encode($arrayData);
                
                
                
            }
            
            
        }
        
    } catch (Exception $exc) {
        $data = array(
            
            'Error'=> $ex->getMessage()
        );
    echo json_encode($data);
}}









//    $eliminado = false;
//
//    try{
//        if($this->input->post()){
//         $codigo = $this->input->post('CodigoModulo');
//         $eliminado = $this->Modulos->EliminarModulos($codigo);
//         echo $eliminado;
            
    
    
    
    

   
    
public function BuscarModulos(){
        
        
    }
           
}