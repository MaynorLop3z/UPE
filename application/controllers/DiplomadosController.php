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

        $data['Diplomados'] = $this->Diplomados->listarDiplomados();
        $data['CategoriasDi'] = $this->Diplomados->listarCategoriasDiplomados();
        $this->load->view('Diplomados', $data);
    }

    public function guardarDiplomado() {
        try {
            if ($this->input->post()) { //Estos son los nombres de los input del Form
                $nombreDiplomado = $this->input->post('DiplomadoNombre');
                $descripcionDiplomado = $this->input->post('DiplomadoDescripcion');
                $Estado = $this->input->post('Estado');
                $categoriaDi = $this->input->post('CatgoriaDiplomado');
                $comentarioDi = $this->input->post('ComentarioDiplomado');
                $this->load->model('Diplomados');

                $arrayData = $this->Diplomados->crearDiplomado($nombreDiplomado, $descripcionDiplomado, $Estado, $categoriaDi, $comentarioDi);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    public function editarDiplomado() {
        try {
            if ($this->input->post('CodigoDiplomado')) {
                $codigoDi = $this->input->post('CodigoDiplomado');
                $NombreDiplomado = $this->input->post('DiplomadoNombre');
                $Descripcion = $this->input->post('DiplomadoDescripcion');
                $Estado = $this->input->post('Estado');
                $NombreCategoriaDiplomad = $this->input->post('CatgoriaDiplomado');
                $Comentarios = $this->input->post('ComentarioDiplomado');
                $this->load->model('Diplomados');
                $arrayData = $this->Diplomados->ModificarDiplomado($codigoDi, $NombreDiplomado, $Descripcion, $Estado, $NombreCategoriaDiplomad, $Comentarios);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    public function eliminarDiplomado() {
        //$eliminar = false;

        try {
            if ($this->input->post()) {
                $codigoDiplomado = $this->input->post('CodigoDiplomado');
                if($codigoDiplomado !=null){
//                 $ip = $this->session->userdata('ipUserLogin');
//                $userModifica = $this->session->userdata('codigoDiplomado');
                $arrayData = $this->Diplomados->inactivarDiplomado($codigoDiplomado);
                       // $ip,$userModifica
                echo json_encode($arrayData);   
                    
                    
                }
//                $eliminar = $this->Diplomados->EliminarDiplomado($codigo);
//                echo $eliminar;
            }
        } catch (Exception $ex) {
            $data =  array(
         'Error'=> $ex->getMessage() 
                    );
            echo json_encode($data);
        }
    }

}
