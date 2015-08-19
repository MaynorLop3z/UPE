<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class GruposParticipantes extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function ListarGruposParticipantes() {
        $this->db->select('CodigoGruposParticipantes, '
                . 'CalificacionModulo, '
                . 'CodigoParticipante, '
                . 'CodigoEstadosParticipacion, '
                . 'CodigoUsuario, '
                . 'CodigoGrupoPeriodo'
        );
        $this->db->from('GruposParticipantes');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function CrearGrupoParticipante($CalificacionModulo, $CodigoParticipante, $CodigoEstadosParticipacion, $CodigoUsuario, $CodigoGrupoPeriodo) {

        $data = array(
            'CalificacionModulo' => $CalificacionModulo,
            'CodigoParticipante' => $CodigoParticipante,
            'CodigoEstadosParticipacion' => $CodigoEstadosParticipacion,
            'CodigoUsuario' => $CodigoUsuario,
            'CodigoGrupoPeriodo' => $CodigoGrupoPeriodo
        );
        $this->db->insert('GruposParticipantes', $data);
    }

}
