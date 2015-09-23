<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//controlador de la pagina principal, permite logear a los usuarios
include './application/models/dto/UsuariosDTO.php';
include './application/controllers/Listar.php';

class Login extends CI_Controller {

    public $usuarioDTO;
    public $test;

    public function __construct() {
        parent::__construct();
        $this->usuarioDTO = new UsuariosDTO();
        $this->test = new Listar();
    }

    public function index() {
        $nombreUser = $this->usuarioDTO->getNombre();
        $test = $this->test->prueba();
        $this->load->model('publicaciones');
        $this->load->model('archivos');
        $user = $this->input->post('user');
        if ($user) {

            $this->load->model('usuario_model');
            $this->load->helper('url');

            if ($this->usuario_model->login($_POST['user'], $_POST['password'])) {

//            if (true)   {
//                
//                $this->load->view('usuario');
                redirect('pagPrincipal');
            } else {
                //$this->load->view('login_vista');
                echo 'jajajaj';
            }
        } else {
            //listar publicaciones con sus archivos
            $publicacion = array();
            $publicaciones = $this->publicaciones->listarPublicaciones();
            $archivosList = array();
            foreach ($publicaciones as $publicacion) {
                //$publicacion->
                $codigoPublicacion = $publicacion->CodigoPublicacion;
                $archivosList = $this->archivos->listarArchivosPublicacion($codigoPublicacion);
            }
            $datosPublicacion = array();
            $this->load->view('login_vista');
        }
    }

    private function colocarImg($ruta) {
        try {
            
        } catch (Exception $exc) {
            $exc->getTrace();
        }
    }

}
