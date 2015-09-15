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
        
        if ($this->input->post('Aceptar')) {
           $data['creacion'] = agregar();
           if ($data['creacion']) {
               $data['Mensaje'] = 'Alumno Agregado Exitosamente';
           } else {
               $data['Mensaje'] = 'Error al Agregar al alumno';
           }
        }
        else {
            $data['creacion'] = false;
        }
          $data['Alumnos'] = $this->Participantes->listarParticipantes();
          //$this->load->model('CategoriasParticipante');
          $data['CategoriasP'] = $this->Participantes->listarCategoriasParticipante();
        $this->load->view('ParticipantesTab',$data);
    }
    
    public function agregar() {
        $creado = $this->Participantes->CrearParticipante($this->input->post('Nombre'), $this->input->post('CorreoElectronico'), $this->input->post('TelefonoFijo'), $this->input->post('TelefonoCelular'), $this->input->post('Direccion'), $this->input->post('FechaNacimiento'), $this->input->post('CodigoCategoriaParticipantes'), $this->input->post('NumeroDUI'),0, $this->input->post('Carrera'), $this->input->post('NivelAcademico'), $this->input->post('NombreEncargado'), $this->input->post('Descripcion'), $this->input->post('Comentarios'));
        return $creado;
    }

}