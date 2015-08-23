<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//controlador de la pagina principal, permite logear a los usuarios

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->load->model('publicaciones');
        $this->load->model('archivos');
        if (isset($_POST['user'])) {

            $this->load->model('usuario_model');
            $this->load->helper('url');

            if ($this->usuario_model->login($_POST['user'], $_POST['password'])) {

//            if (true)   {
                redirect('pagPrincipal');
            } else {
                $this->load->view('login_vista');
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
