<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuariocontroller extends CI_Controller {

    public function __construct() {
        try {
            parent::__construct();
            $this->load->database();
            $this->load->model('Usuarios');
            $this->load->library('utilidadesWeb');
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function index() {
        try {
            $data['Usuarios'] = $this->Usuarios->listarUsuarios();
//            $datau = 
            $this->load->view('Usuario', $data);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function guardarUsuario($codigoUsuario = null) {
        try {
            if ($this->input->post()) {
                $ip = $this->input->ip_address();

//                $ipUsuarioModifica = $this->utilidadesWeb->getIpUsuarioModifica();
                $nombrePersonaUsuario = $this->input->post('UsuarioNombre');
                $contraseniaUsuario = $this->input->post('UsuarioPassword');
                $correo = $this->input->post('UsuarioEmail');
                $nombreUsuario = $nombrePersonaUsuario . '123';
                $this->load->model('Usuarios');
                $userModifica = $this->session->userdata('codigoUserLogin');
                $arrayData = $this->Usuarios->guardarUsuario(null, $nombreUsuario, $contraseniaUsuario, $nombrePersonaUsuario, $correo, $userModifica,$ip);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            $data = array(
                'Error' => $ex->getMessage(),
            );
            echo json_encode($data);
        }
    }

    public function editarUsuario() {
        if ($this->input->post()) {
            if ($this->input->post('')) {
                
            }
        }
    }

}
