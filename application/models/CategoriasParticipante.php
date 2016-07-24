<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

//include('ModeloBase.php');
class CategoriasParticipante extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarCategoriasParticipante() {
        $this->db->select('CodigoCategoriaParticipantes, '
                . 'NombreCategoriaParticipante, '
                . 'CuotaCategoriaParticipante, '
                . 'Descripcion, '
                . 'Comentarios');
        $this->db->from('CategoriasParticipante');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function CrearCategoriasParticipante($NombreCategoriasParticipante, $CuotaCategoriasParticipante, $Descripcion = '', $Comentarios = null) {
        $data = array(
//            'CodigoPermisos' => null,
            'NombreCategoriaParticipante' => $NombreCategoriasParticipante,
            'CuotaCategoriaParticipante' => $CuotaCategoriasParticipante,
            'Descripcion' => $Descripcion,
            'Comentarios' => $Comentarios
        );
        $this->db->insert('CategoriasParticipante', $data);
    }

    public function EliminarCategoriasParticipante($CodigoCategoriasParticipantes) {
        $this->db->delete('CategoriasParticipante', array('CodigoCategoriaParticipantes' => $CodigoCategoriasParticipantes));
        //Habra que hacer un update a los participantes????
    }

    public function ModificarCategoriasParticipante($CodigoCategoriasParticipantes, $NombreCategoriasParticipante, $CoutaCategoriasParticipante, $Descripcion, $Comentarios=null) {
        $data = array(
            'NombreCategoriaParticipante' => $NombreCategoriasParticipante,
            'CuotaCategoriaParticipante' => $CoutaCategoriasParticipante,
            'Descripcion' => $Descripcion,
            'Comentarios' => $Comentarios
        );

        $this->db->where('CodigoCategoriaParticipantes', $CodigoCategoriasParticipantes);
        $this->db->update('CategoriasParticipante', $data);
    }

}
