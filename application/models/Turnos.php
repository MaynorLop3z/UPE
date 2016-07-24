<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//include('ModeloBase.php');
class Turnos extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarTurnos() {
        $this->db->select('CodigoTurno, '
                . 'NombreTurno, '
                . 'HoraInicio, '
                . 'HoraFin, '
                . 'Estado ,'
                . 'Comentarios'
        );
        $this->db->from('Turnos');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function CrearTurno($NombreTurno, $FechaTurno, $HoraInicio, $HoraFin, $Estado, $Comentarios=NULL) {
        $data = array(
            'NombreTurno' => $NombreTurno,
            'FechaTurno' => $FechaTurno,
            'HoraInicio' => $HoraInicio,
            'HoraFin' => $HoraFin,
            'Estado' => $Estado,
            'Comentarios' => $Comentarios
        );
        $this->db->insert('Turnos', $data);
    }

    public function EliminarPublicacion($CodigoTurno) {
        $this->db->delete('Turnos', array('CodigoTurno' => $CodigoTurno));
    }

    public function ModificarTurno($CodigoTurno, $NombreTurno, $FechaTurno, $HoraInicio, $HoraFin, $Estado, $Comentarios=null, $UsuarioModifica, $IPModifica, $FechaModifica) {
        $data = array(
            'NombreTurno' => $NombreTurno,
            'FechaTurno' => $FechaTurno,
            'HoraInicio' => $HoraInicio,
            'HoraFin' => $HoraFin,
            'Estado' => $Estado,
            'UsuarioModifica' => $UsuarioModifica,
            'IPModifica' => $IPModifica,
            'FechaModifica' => $FechaModifica,
            'Comentarios' => $Comentarios,
        );
        $this->db->where('CodigoTurno', $CodigoTurno);
        $this->db->update('Turno', $data);
    }

}
