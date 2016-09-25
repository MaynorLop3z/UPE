<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class HorariosController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Horarios');
        $this->load->model('Periodos');
    }

    public function index() {
//        $data['Turnos'] = $this->Horarios->cargarTurnos();
//        $data['Grupos'] = $his->Periodos->listarGruposPeriodos();
        $this->load->view('Horarios', $data);
    }

}
