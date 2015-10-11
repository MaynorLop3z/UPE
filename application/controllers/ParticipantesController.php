<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ParticipantesController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Participantes');
    }

    public function index() {

//        if ($this->input->post('Aceptar')) {
//            $data['creacion'] = agregar();
//            if ($data['creacion']) {
//                $data['Mensaje'] = 'Alumno Agregado Exitosamente';
//            } else {
//                $data['Mensaje'] = 'Error al Agregar al alumno';
//            }
//        } else {
//            $data['creacion'] = false;
//        }
        $data['Alumnos'] = $this->Participantes->listarParticipantes();
        //$this->load->model('CategoriasParticipante');
        $data['CategoriasP'] = $this->Participantes->listarCategoriasParticipante();
        $this->load->view('Participantes', $data);
    }

    public function agregar() {
        try {
            if ($this->input->post()) {
                $nombre = $this->input->post('AlumnoNombre');
                $mail = $this->input->post('AlumnoMail');
                $tfijo = $this->input->post('AlumnoFijo');
                $tcel = $this->input->post('AlumnoMovil');
                $direccion = $this->input->post('AlumnoDir');
                $DUI = $this->input->post('AlumnoDUI');
                $nacimiento = $this->input->post('AlumnoFNac');
                $carrera = $this->input->post('AlumnoCarrera');
                $nivelAcad = $this->input->post('AlumnoNivel');
                $encargado = $this->input->post('AlumnoNEncargado');
                $categoria = $this->input->post('AlumnoCategoria');
                $descripcion = $this->input->post('AlumnoDescripcion');
                $comentarios = $this->input->post('AlumnoComentario');
                $universidad = 0;
                $arrayData = $this->Participantes->CrearParticipante($nombre, $mail, $tfijo, $tcel, $direccion, $nacimiento, $categoria, $DUI, $universidad, $carrera, $nivelAcad, $encargado, $descripcion, $comentarios);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    
    public function modificar() {
        try {
            if ($this->input->post()) {
                $codigo = $this->input->post('AlumnoCodigo');
                $nombre = $this->input->post('AlumnoNombre');
                $mail = $this->input->post('AlumnoMail');
                $tfijo = $this->input->post('AlumnoFijo'); $tcel = $this->input->post('AlumnoMovil');
                $direccion = $this->input->post('AlumnoDir'); $DUI = $this->input->post('AlumnoDUI');
                $nacimiento = $this->input->post('AlumnoFNac'); $carrera = $this->input->post('AlumnoCarrera');
                $nivelAcad = $this->input->post('AlumnoNivel');
                $encargado = $this->input->post('AlumnoNEncargado');
                $categoria = $this->input->post('AlumnoCategoria');
                $descripcion = $this->input->post('AlumnoDescripcion');
                $comentarios = $this->input->post('AlumnoComentario');
                $universidad = 0; $umodifica = 0; $ipModifica = '192.168.1.1'; $fechaModifica = date('d/m/Y');
                $arrayData = $this->Participantes->ModificarParticipante($codigo, $nombre, $mail, $tfijo, $tcel, $direccion, $nacimiento, $categoria, $umodifica, $ipModifica, $fechaModifica, $universidad, $DUI, $carrera, $nivelAcad, $encargado, $descripcion, $comentarios);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }
}
