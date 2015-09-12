<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//include('ModeloBase.php');
class EstadosParticipantes extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarEstados() {
        $this->db->select('CodigoEstados, '
                . 'NombreEstado, '
                . 'Estado'
        );
        $this->db->from('EstadosParticipantes');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function CrearEstado($NombreEstado, $Estado) {
        $data = array(
            //            'CodigoEstados' => null,
            'NombreEstado' => $NombreEstado,
            'Estado' => $Estado
        );
        $this->db->insert('EstadosParticipantes', $data);
    }

    public function EliminarEstado($CodigoEstados) {
        $this->db->delete('EstadosParticipantes', array('CodigoEstados' => $CodigoEstados));
    }

    public function ModificarEstado($CodigoEstados, $NombreEstado, $Estado, $UsuarioModifica, $IPModifica, $FechaModifica) {
        $data = array(
            //            'CodigoEstados' => null,
            'NombreEstado' => $NombreEstado,
            'Estado' => $Estado,
            'UsuarioModifica' => $UsuarioModifica,
            'IPModifica' => $IPModifica,
            'FechaModifica' => $FechaModifica
        );
        $this->db->where('CodigoEstados', $CodigoEstados);
        $this->db->update('EstadosParticipantes', $data);
    }

}
