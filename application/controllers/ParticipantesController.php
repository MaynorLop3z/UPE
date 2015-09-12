<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ParticipantesController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Participantes');
    }

    public function index() {
 
          $data['Alumnos'] = $this->Participantes->listarParticipantes();
        $this->load->view('Participantes',$data);
    }

}