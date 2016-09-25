<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Horarios extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function cargarTurnos() {
        try{
            $this->db->select('CodigoTurno, NombreTurno');
            $this->db->from('Turnos');
            $consulta = $this->db->get();
            $resultado = $consulta->result();
            return $resultado;
        }catch(Exception $e){
            return $e;
        }
    }
    
    
}
?>