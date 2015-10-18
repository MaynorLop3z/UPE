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
    
      
        $data['DiplomadosN']= $this->Diplomados->listarDiplomados(); 
        $data['CategoriasDi']= $this->Diplomados->listarDiplomadosCategoria();
        $this->load->view('Diplomados',$data);
        
      
    }

    
    public function guardarDiplomado(){
        try {
            if($this->input->post()){ //Estos son los nombres de los input del Form
                $nombreDiplomado = $this->input->post('DiplomadoNombre');
                $descripcionDiplomado = $this->input->post('DiplomadoDescripcion');
                $optionsactivo= $this->input->post('optionsActivo')==='V';// Agregue la opcion activo  si es seleccionad
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
       }

