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
    
    public function ListarGruposMaestro($codigo){ //LISTA LOS GRUPOS DEL MAESTRO POR SU $codigo
       $consulta= $this->db->query('SELECT DISTINCT
                    "GruposMaestros"."CodigoGruposPeriodoUsuario",
                        "GruposMaestros"."CodigoGrupoPeriodo",
                        "CategoriaDiplomados"."NombreCategoriaDiplomado",
                        "CategoriaDiplomados"."CodigoCategoriaDiplomado",
                        "GrupoPeriodos"."CodigoPeriodo",
                        "Periodos"."CodigoModulo",
                        "Periodos"."FechaInicioPeriodo",
                        "Modulos"."NombreModulo",
                        "Diplomados"."NombreDiplomado"

                FROM
                        public."GruposMaestros", public."CategoriaDiplomados", 
                        public."Publicaciones", public."GrupoPeriodos",
                        public."Periodos", public."Modulos",
                        public."Diplomados"
                WHERE
                        "GruposMaestros"."CodigoUsuario" = '.$codigo.'

                AND	
                        "GruposMaestros"."Estado" = 1

                AND	
                        "GrupoPeriodos"."Estado" = TRUE

                AND
                       public."GruposMaestros"."CodigoGrupoPeriodo" = public."GrupoPeriodos"."CodigoGrupoPeriodo"

                AND 
                       public."Periodos"."CodigoPeriodo" = public."GrupoPeriodos"."CodigoPeriodo"

                AND 
                       public."Modulos"."CodigoModulo" = public."Periodos"."CodigoModulo"

                AND
                       public."Diplomados"."CodigoDiplomado" = public."Modulos"."CodigoDiplomado"

                AND
                       "CategoriaDiplomados"."CodigoCategoriaDiplomado"  = public."Diplomados"."CodigoCategoriaDiplomado"

                ORDER BY

                       public."GruposMaestros"."CodigoGruposPeriodoUsuario" DESC;  
            ');
       $resultado = $consulta->result();
       return $resultado;
    }
    
    public function ListarAlumnosMaestro($codigo){ //LISTA LOS ARCHIVOS DEL MAESTRO
           $consulta= $this->db->query('SELECT DISTINCT "Participantes"."Nombre",
                "GruposParticipantes"."CalificacionModulo", "GrupoPeriodos"."CodigoGrupoPeriodo",
                "GruposParticipantes"."CodigoGruposParticipantes", "GruposParticipantes"."CalificacionModulo"   
                 FROM   
                         public."Participantes", 
                         public."GruposParticipantes",
                         public."GrupoPeriodos",
                         public."GruposMaestros"
                 WHERE  	
                         "GruposMaestros"."CodigoUsuario" = '.$codigo.'
                         
                 AND
                         "GruposMaestros"."Estado" = 1

                 AND
			 "GrupoPeriodos"."CodigoGrupoPeriodo" = "GruposMaestros"."CodigoGrupoPeriodo"
                 
                 AND
                         "GruposParticipantes"."CodigoGrupoPeriodo"  = "GrupoPeriodos"."CodigoGrupoPeriodo"
          
                 AND
                         "GruposParticipantes"."CodigoParticipante"  = "Participantes"."CodigoParticipante"
                         
                 AND
                         "GruposParticipantes"."Estado" = TRUE
                         
                 ORDER BY
                           "Participantes"."Nombre" ASC; 
; 
                            ');
           $resultado = $consulta->result();
           return $resultado;
       }
       
       public function guardarCalificacion($grupoP, $calificacion) {
           try{
               
               $estado=1;
               if($calificacion<6){
                   $estado=2;
               }
                $data = array(
                        'CalificacionModulo' => $calificacion,
                        'CodigoEstadosParticipacion' => $estado,
                        'CalificacionExiste' => TRUE
                );

                $this->db->where('CodigoGruposParticipantes', $grupoP);
                $this->db->update('GruposParticipantes', $data); // 
                
           } catch (Exception $ex) {

           }
       }
}
