<?php
//vista de los usuarios logeados


if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {
        try {
            $this->load->view('Dashboard'); 
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }
    public function logout(){
//        if($this->input->post()){
            $this->session->sess_destroy();
//            $data['Permisos'] = null;
//                    $usuario_data = array(
//                        'codigoUserLogin' => null,
//                        'nombreUserLogin' => null,
//                        'correoUserLogin' => null,
//                        'nombreRealUserLogin' =>null,
//                        'ipUserLogin' => null,
//                        'permisosUsuer' => null,
//                        'logueado' => FALSE);
//        $this->session->unset_userdata('permisosUser');
//        $this->session->unset_userdata('codigoUserLogin');
//        $this->session->unset_userdata('correoUserLogin');
//        $this->session->unset_userdata('nombreUserLogin');
//        $this->session->unset_userdata('logeado');
            //redirect('wsite'); 
//        }
    }
    
}