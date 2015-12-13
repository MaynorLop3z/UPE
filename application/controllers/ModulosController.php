<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ModulosController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Modulos');
}

public function index() {

        $data['Modulos'] = $this->Modulos->listarModulos();
        $data['ModulosDip'] = $this->Modulos->listarDiplomados(); //ESto lo acabo de escribir
        $this->load->view('Modulos', $data);
    }

}
