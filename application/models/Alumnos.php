<?php

class Alumnos extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listar() {
        $this->db->select('Carnet, Nombres, Apellidos, Nacimiento');
        $this->db->from('Alumno');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

}
