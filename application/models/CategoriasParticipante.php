<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CategoriasParticipante extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarCategoriasParticipante() {
        $this->db->select('CodigoCategoriasParticipantes, NombreCategoriasParticipante, CuotaCategoriasParticipante, Descripcion');
        $this->db->from('CategoriasParticipante');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function CrearCategoriasParticipante($NombreCategoriasParticipante, $CuotaCategoriasParticipante, $Descripcion = '') {
        $data = array(
//            'CodigoPermisos' => null,
            'NombreCategoriasParticipante' => $NombreCategoriasParticipante,
            'CuotaCategoriasParticipante' => $CuotaCategoriasParticipante,
            'Descripcion' => $Descripcion
        );
        $this->db->insert('CategoriasParticipante', $data);
    }

    public function EliminarCategoriasParticipante($CodigoCategoriasParticipantes) {
        $this->db->delete('CategoriasParticipante', array('CodigoCategoriasParticipantes' => $CodigoCategoriasParticipantes));
        //Habra que hacer un update a los participantes????
    }

    public function ModificarCategoriasParticipante($CodigoCategoriasParticipantes, $NombreCategoriasParticipante, $CoutaCategoriasParticipante, $Descripcion) {
        $data = array(
            'NombreCategoriasParticipante' => $NombreCategoriasParticipante,
            'CuotaCategoriasParticipante' => $CoutaCategoriasParticipante,
            'Descripcion' => $Descripcion
        );

        $this->db->where('CodigoCategoriasParticipantes', $CodigoCategoriasParticipantes);
        $this->db->update('CategoriasParticipante', $data);
    }

}
