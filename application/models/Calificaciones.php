<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Calificaciones extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function obtenerCalificacionAlumno($codigoGrupoPeriodo) {
        try{
            $consulta=$this->db->query(' SELECT "GruposParticipantes"."CalificacionModulo", 
                "GruposParticipantes"."CalificacionExiste" 
                FROM "GruposParticipantes", "PagosParticipantes" 
                WHERE "PagosParticipantes"."CodigoGruposParticipantes"="GruposParticipantes"."CodigoGruposParticipantes"');
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }
    
     public function ListarGruposAlumno($codigo){//LISTA LOS GRUPOS DEL ALUMNO POR SU $codigo
        $consulta= $this->db->query('SELECT DISTINCT
                        "GruposParticipantes"."CodigoGrupoPeriodo",
                        "GrupoPeriodos"."CodigoPeriodo",
                        "Periodos"."CodigoModulo",
                        "Periodos"."FechaInicioPeriodo",
                        "Periodos"."FechaFinPeriodo",
                        "Modulos"."NombreModulo",
                        "Diplomados"."NombreDiplomado",
                        "GruposParticipantes"."CalificacionExiste",
                        "GruposParticipantes"."CalificacionModulo",
                        "PagosParticipantes"."CodigoGruposParticipantes"

                FROM "GruposParticipantes"
                        
                LEFT OUTER JOIN  "PagosParticipantes"
                
                ON "PagosParticipantes"."CodigoGruposParticipantes" = "GruposParticipantes"."CodigoGruposParticipantes"

                JOIN "GrupoPeriodos"

		ON "GrupoPeriodos"."CodigoGrupoPeriodo" = "GruposParticipantes"."CodigoGrupoPeriodo"

		JOIN "Periodos"

                ON "GrupoPeriodos"."CodigoPeriodo" = "Periodos"."CodigoPeriodo"

                JOIN "Modulos"

                ON "Modulos"."CodigoModulo" = "Periodos"."CodigoModulo"

		JOIN "Diplomados"

		ON "Diplomados"."CodigoDiplomado" = "Modulos"."CodigoDiplomado"


                WHERE
                        "GruposParticipantes"."CodigoParticipante" = '.$codigo.'

                AND	
                        "GruposParticipantes"."CodigoEstadosParticipacion" = 1

                AND	
                        "GrupoPeriodos"."Estado" = TRUE

                ORDER BY

                       "Periodos"."FechaInicioPeriodo" DESC;
            ');
        $resultado = $consulta->result();
        return $resultado;

    }
}
