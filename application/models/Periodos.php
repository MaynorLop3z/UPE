<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//include('ModeloBase.php');
class Modulos extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function listarPeriodos() {
        $this->db->select('CodigoPeriodo, '
                . 'FechaInicioPeriodo, '
                . 'FechaFinPeriodo, '
                . 'Estado, '
                . 'Comentario, '
                . 'CodigoModulo'
        );
        $this->db->from('Periodos');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }
    
    public function crearPeriodo($FechaInicioPeriodo, $FechaFinPeriodo, $Estado, $Comentario, $CodigoModulo) {
        $data = array(
            'FechaInicioPeriodo' => $FechaInicioPeriodo,
            'FechaFinPeriodo' => $FechaFinPeriodo,
            'Estado' => $Estado,
            'Comentario' => $Comentario,
            'CodigoModulo' => $CodigoModulo
        );
        $this->db->insert('Periodos', $data);
    }

    public function EliminarPeriodoModulo($CodigoModulo) {
        $this->db->delete('Periodos', array('CodigoModulo' => $CodigoModulo));
    }
    public function EliminarPeriodo($CodigoPeriodo) {
        $this->db->delete('Periodos', array('CodigoPeriodo' => $CodigoPeriodo));
    }
    public function ModificarPeriodo($CodigoPeriodo, $FechaInicioPeriodo, $Estado, $CodigoModulo, $FechaFinPeriodo, $Comentario) {
        $data = array(
            'FechaInicioPeriodo' => $FechaInicioPeriodo,
            'Estado' => $Estado,
            'FechaFinPeriodo' => $FechaFinPeriodo,
            'Comentario' => $Comentario,
            'CodigoModulo' => $CodigoModulo
        );
        $this->db->where('CodigoPeriodo', $CodigoPeriodo);
        $this->db->update('Periodos', $data);
    }
}