<?php

/**
 * Description of Reports
 *
 * @author Maynor Lopez
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Reports extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getCategoriasQuantity() {
        try {
            $consulta = $this->db->query('SELECT '
                    . 'COUNT("T0"."CodigoParticipante") AS "CantidadParticipantes", '
                    . '"T1"."NombreCategoriaParticipante", '
                    . '"T1"."CodigoCategoriaParticipantes" '
                    . 'FROM  "Participantes" "T0","CategoriasParticipante" "T1" '
                    . 'WHERE "T1"."CodigoCategoriaParticipantes" = "T0"."CodigoCategoriaParticipantes" '
                    . 'GROUP BY "T1"."NombreCategoriaParticipante", "T1"."CodigoCategoriaParticipantes";');
            if ($consulta != null) {
                $resultado = $consulta->result();
            } else {
                
            }
            return $resultado;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
//        $this->db->select('CodigoDiplomado,'
//                . 'NombreDiplomado'
//                . 'Descripcion,'
//                . 'Estado,'
//                . 'CodigoCategoraDiplomado,'
//                . 'Comentarios');
//        $this->db->from('Diplomados');
//        $this->db->where('Estado', TRUE);
//        $consultaD = $this->db->get();
//        $resultadoD = $consultaD->result();
//        return $resultadoD;
    }

}
