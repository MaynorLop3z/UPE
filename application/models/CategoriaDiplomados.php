<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class CategoriaDiplomados extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarCategoriasDiplomados() {
        $this->db->select('CodigoCategoriaDiplomado, '
                . 'NombreCategoriaDiplomado, '
                . 'Estado'
        );
        $this->db->from('CategoriaDiplomados');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function CrearCategoriaDiplomado($NombreCategoriaDiplomado, $Estado) {
        $data = array(
            'NombreCategoriaDiplomado' => $NombreCategoriaDiplomado,
            'Estado' => $Estado
        );
        $this->db->insert('CategoriaDiplomados', $data);
    }

    public function EliminarCategoriaDiplomado($CodigoCategoriaDiplomado) {
    $this->db->delete('CategoriaDiplomados', array('CodigoCategoriaDiplomado' => $CodigoCategoriaDiplomado));
    }

    public function ModificarCategoriaDiplomado($CodigoCategoriaDiplomado, $NombreCategoriaDiplomado, $Estado, $UsuarioModifica, $IPModifica, $FechaModifica) {
        $data = array(
            'NombreEstado' => $NombreCategoriaDiplomado,
            'Estado' => $Estado,
            'UsuarioModifica' => $UsuarioModifica,
            'IPModifica' => $IPModifica,
            'FechaModifica' => $FechaModifica
        );
        $this->db->where('CodigoCategoriaDiplomado', $CodigoCategoriaDiplomado);
        $this->db->update('CategoriaDiplomados', $data);
    }

}
