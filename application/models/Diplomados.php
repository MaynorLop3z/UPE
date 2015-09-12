<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//include('ModeloBase.php');
class Diplomados extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarDiplomados() {
        $this->db->select('CodigoDiplomado, '
                . 'NombreDiplomado, '
                . 'Descripcion, '
                . 'Estado, '
                . 'CodigoCategoriaDiplomado,'
                . 'Comentarios'
        );
        $this->db->from('Diplomados');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function listarDiplomadosCategoria($CodigoCategoriaDiplomado) {
        $this->db->select('CodigoDiplomado, '
                . 'NombreDiplomado, '
                . 'Descripcion, '
                . 'Estado, '
                . 'Comentarios'
        );
        $this->db->from('Diplomados');
        $this->db->where('CodigoCategoriaDiplomado', $CodigoCategoriaDiplomado);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }
    
    public function crearDiplomado($NombreDiplomado, $Descripcion, $Estado, $Comentarios=null) {
        $data = array(
            'NombreDiplomado' => $NombreDiplomado,
            'Descripcion' => $Descripcion,
            'Estado' => $Estado,
            'Comentarios' => $Comentarios
        );
        $this->db->insert('Modulos', $data);
    }

    public function EliminarDiplomado($CodigoDiplomado) {
        $this->db->delete('Diplomados', array('CodigoDiplomado' => $CodigoDiplomado));
    }

    public function ModificarDiplomado($CodigoDiplomado, $NombreDiplomado, $Descripcion, $Estado, $Comentarios) {
        $data = array(
            'NombreEstado' => $NombreDiplomado,
            'Descripcion' => $Descripcion,
            'Estado' => $Estado,
            'Comentarios' => $Comentarios
        );
        $this->db->where('CodigoDiplomado', $CodigoDiplomado);
        $this->db->update('Diplomados', $data);
    }

}
