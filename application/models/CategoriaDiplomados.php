<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

//include('ModeloBase.php');
class CategoriaDiplomados extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarCategoriasDiplomados() {
        $this->db->select('CodigoCategoriaDiplomado, '
                . 'NombreCategoriaDiplomado, '
                . 'Estado, '
                . 'Comentarios'
        );
        $this->db->from('CategoriaDiplomados');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function CrearCategoriaDiplomado($NombreCategoriaDiplomado, $Estado, $Comentarios = null) {
        $data = array(
            'NombreCategoriaDiplomado' => $NombreCategoriaDiplomado,
            'Estado' => $Estado,
            'Comentarios' => $Comentarios
        );
        $this->db->insert('CategoriaDiplomados', $data);
    }

    public function EliminarCategoriaDiplomado($CodigoCategoriaDiplomado) {
    $this->db->delete('CategoriaDiplomados', array('CodigoCategoriaDiplomado' => $CodigoCategoriaDiplomado));
    }

    public function ModificarCategoriaDiplomado($CodigoCategoriaDiplomado, $NombreCategoriaDiplomado, $Estado, $UsuarioModifica, $IPModifica, $FechaModifica, $Comentarios = null) {
        $data = array(
            'NombreEstado' => $NombreCategoriaDiplomado,
            'Estado' => $Estado,
            'UsuarioModifica' => $UsuarioModifica,
            'IPModifica' => $IPModifica,
            'FechaModifica' => $FechaModifica,
            'Comentarios' => $Comentarios
        );
        $this->db->where('CodigoCategoriaDiplomado', $CodigoCategoriaDiplomado);
        $this->db->update('CategoriaDiplomados', $data);
    }

}
