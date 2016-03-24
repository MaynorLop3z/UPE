<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class DiplomadosController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Diplomados');
    }
    public function index() {
    
        try {
             $data['DiplomadosN']= $this->Diplomados->listarDiplomados(); 
        $data['CategoriasDi']= $this->Diplomados->listarCategoriasDiplomados();
        $this->load->view('Diplomados',$data);
        
        } catch (Exception $ex) {
           echo $ex->getTraceAsString(); 
        }
       
      
    }
    
    public function guardarDiplomado(){
        try {
            if($this->input->post()){ //Estos son los nombres de los input del Form
                $nombreDiplomado = $this->input->post('DiplomadoNombre');
                $descripcionDiplomado = $this->input->post('DiplomadoDescripcion');
                $optionsactivo= $this->input->post('optionsActivo');// Agregue la opcion activo  si es seleccionad
                $categoriaDi = $this->input->post('CatgoriaDiplomado');
                $comentarioDi = $this->input->post('ComentarioDiplomado');
                $this->load->model('Diplomados');
                
                $arrayData = $this->Diplomados->crearDiplomado($nombreDiplomado,$descripcionDiplomado,$optionsactivo,$categoriaDi,$comentarioDi);
                echo json_encode($arrayData);
                
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }
    
    public  function editarDiplomado(){
        try {
            if($this->input->post('CodigoDiplomado')){
                $codigoDi = $this->input->post('CodigoDiplomado');
                $nombreDiplomado = $this->input->post('DiplomadoNombre');
                $descripcionDiplomado = $this->input->post('DiplomadoDescripcion');
                $optionsactivo = $this->input->post('radio')===true;// Agregue la opcion activo  si es seleccionad     
                $categoriaDi = $this->input->post('CatgoriaDiplomado');
                $comentarioDi = $this->input->post('ComentarioDiplomado');
                $this->load->model('Diplomados');
                $arrayData=  $this->Diplomados->ModificarDiplomado($codigoDi,$nombreDiplomado,$descripcionDiplomado,$optionsactivo,$categoriaDi,$comentarioDi);
                echo json_encode($arrayData);
                        
                 }         
        } catch (Exception $ex) {
            echo json_encode($ex);
            
        }
        
        
    }
            public function eliminarDiplomado (){
                $eliminar = false;
                
                try {
                if($this->input->post()){    
                $codigo = $this->input->post('CodigoDiplomado');
                $eliminar = $this->Diplomados->EliminarDiplomado($codigo);
                echo $eliminar;                   
                }
                } catch (Exception $ex) {
                    echo json_encode($ex);
                }
                
                
            }
       }
