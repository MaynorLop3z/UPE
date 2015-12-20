<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

//include('ModeloBase.php');
class Periodos extends CI_Model {

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
    
    public function listarPeriodosByModulo($idModulo) {
        $this->db->select('CodigoPeriodo, '
                . 'FechaInicioPeriodo, '
                . 'FechaFinPeriodo, '
                . 'Estado, '
                . 'Comentario, '
                . 'CodigoModulo'
        );
        $this->db->from('Periodos');
        $this->db->where('CodigoModulo', $idModulo);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }
    
    public function crearPeriodo($FechaInicioPeriodo, $FechaFinPeriodo, $Estado, $Comentario, $CodigoModulo) {
        try {
        $data = array(
            'FechaInicioPeriodo' => $FechaInicioPeriodo,
            'FechaFinPeriodo' => $FechaFinPeriodo,
            'Estado' => $Estado,
            'Comentario' => $Comentario,
            'CodigoModulo' => $CodigoModulo
        );
        $this->db->insert('Periodos', $data);
        $insert_id = $this->db->insert_id();
        $data['CodigoPeriodo'] = $insert_id;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        return $data;
    }

    public function EliminarPeriodoModulo($CodigoModulo) {
        $this->db->delete('Periodos', array('CodigoModulo' => $CodigoModulo));
    }
    public function EliminarPeriodo($CodigoPeriodo) {
//        $eliminado = 0;
          try {
           $this->db->delete('Periodos', array('CodigoPeriodo' => $CodigoPeriodo));
//          if ($this->db->affected_rows() == 1){
//            $eliminado = true;
//        }
           $eliminado = $this->db->affected_rows();
        } catch (Exception $ex) {
            $ex->getMessage();
            $eliminado = 0;
        }
       return $eliminado;
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