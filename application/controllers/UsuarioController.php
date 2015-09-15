<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuariocontroller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Usuarios');
    }

    public function index() {
        try {

            $data['Usuarios'] = $this->Usuarios->listarUsuarios();
            $this->load->view('UsuariosTab', $data);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function guardar($id = null) {
        $data = array();
        $this->load->model('informe_model');
        if ($id) {
            $informe = $this->informe_model->obtener_por_id($id);
            $data['id'] = $informe->id;
            $data['titulo'] = $informe->titulo;
            $data['descripcion'] = $informe->descripcion;
            $data['prioridad'] = $informe->prioridad;
        } else {
            $data['id'] = null;
            $data['titulo'] = null;
            $data['descripcion'] = null;
            $data['prioridad'] = null;
        }
        $this->load->view('informes/header');
        $this->load->view('informes/guardar', $data);
        $this->load->view('informes/footer');
    }

    public function guardarUsuario($codigoUsuario = null) {
        if ($this->input->post()) {
            $nombrePersonaUsuario = $this->input->post('UsuarioNombre');
            $contraseniaUsuario = $this->input->post('UsuarioPassword');
            $correo = $this->input->post('UsuarioEmail');
            $nombreUsuario=$nombrePersonaUsuario.'123';
            $this->load->model('Usuarios');
            
            $this->Usuarios->guardarUsuario(null, $nombreUsuario, $contraseniaUsuario, $nombrePersonaUsuario, $correo);
           
        } else {
            $this->guardar();
        }
    }

}
