<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Modulos extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarModulos() {
        $this->db->select('CodigoModulo, '
                . 'NombreModulo, '
                . 'OrdenModulo, '
                . 'Estado, '
                . 'CodigoDiplomados, '
                . 'CodigoTurnos, '
                . 'CodigoDiplomados'
        );
        $this->db->from('Modulos');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function crearModulo($NombreModulo, $OrdenModulo, $Estado, $CodigoDiplomados, $CodigoTurnos, $CodigoDiplomados) {
        $data = array(
            'NombreModulo' => $NombreModulo,
            'OrdenModulo' => $OrdenModulo,
            'Estado' => $Estado,
            'CodigoDiplomados' => $CodigoDiplomados,
            'CodigoTurnos' => $CodigoTurnos,
            'CodigoDiplomados' => $CodigoDiplomados
        );
        $this->db->insert('Modulos', $data);
    }

    public function EliminarModulo($CodigoModulo) {
        $this->db->delete('Modulos', array('CodigoModulo' => $CodigoModulo));
    }

    public function EliminarModulos($CodigoDiplomado) {
        $this->db->delete('Modulos', array('CodigoDiplomado' => $CodigoDiplomado));
    }

    public function ModificarModulo($CodigoModulo, $OrdenModulo, $Estado, $CodigoDiplomados, $CodigoTurnos, $UsuarioModifica, $IPModifica, $FechaModifica) {
        $data = array(
            'OrdenModulo' => $OrdenModulo,
            'Estado' => $Estado,
            'CodigoDiplomados' => $CodigoDiplomados,
            'CodigoTurnos' => $CodigoTurnos,
            'UsuarioModifica' => $UsuarioModifica,
            'IPModifica' => $IPModifica,
            'FechaModifica' => $FechaModifica
        );
        $this->db->where('CodigoModulo', $CodigoModulo);
        $this->db->update('Modulos', $data);
    }

}
