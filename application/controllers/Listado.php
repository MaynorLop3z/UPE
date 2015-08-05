<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Listado extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuarios');
    }

    public function index() {
        //coment


        $datos['lista'] = $this->usuarios->listarUsuarios();
        $this->load->view('listar_usuarios', $datos);
    }

}
