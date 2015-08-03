<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Listado extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        //coment
        
        $this->load->model('alumnos');
        $datos['lista'] = $this->alumnos->listar();
        $this->load->view('listar_alumnos', $datos);
    }

}
