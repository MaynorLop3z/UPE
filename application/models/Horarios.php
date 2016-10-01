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
    
    public function listarHorariosGruposxTurno(){
        try{
            $consulta='SELECT "Turnos"."NombreTurno", "Modulos"."NombreModulo", 
            "Periodos"."FechaInicioPeriodo", "Periodos"."FechaFinPeriodo",
            "GrupoPeriodos"."CodigoGrupoPeriodo", "GrupoPeriodos"."HoraEntrada",
            "GrupoPeriodos"."HoraSalida", "GrupoPeriodos"."Aula"

            FROM "Turnos", "Modulos", "Periodos", "GrupoPeriodos"

            WHERE "Turnos"."CodigoTurno" = "Modulos"."CodigoTurno"

            AND "Modulos"."CodigoModulo" = "Periodos"."CodigoModulo"

            AND "Periodos"."CodigoPeriodo" = "GrupoPeriodos"."CodigoPeriodo"';
//            $this->db->select('T.CodigoTurno, T.NombreTurno, M.NombreModulo,'
//                    . 'P.FechaInicioPeriodo, R.FechaFinPeriodo, G.CodigoGrupoPeriodo,'
//                    . 'G.HoraEntrada, G.HoraSalida, G.Aula');
            $rc = $this->db->query($consulta);
            $resultado = $rc->result();
            return $resultado;
        } catch (Exception $ex) {
            return $e;
        }
    }
    
}
?>