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
            }
            return $resultado;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }
        public function countGeneralGender() {
        try {
            $consulta = $this->db->query('SELECT 
  \'Hombres\' AS "Genero",
  COUNT("T0"."Genero") AS "Cantidad"
FROM 
  "Participantes" "T0"
WHERE 
  "T0"."Estado" = 1 AND "T0"."Genero" = \'M\'
 UNION 
 SELECT 
  \'Mujeres\' AS "Genero",
  COUNT("T0"."Genero") AS "Cantidad"
FROM 
  "Participantes" "T0"
WHERE 
  "T0"."Estado" = 1 AND "T0"."Genero" = \'F\';');
            if ($consulta != null) {
                $resultado = $consulta->result();
            }
            return $resultado;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }
    public function countGenderCat() {
        try {
            $consulta = $this->db->query('SELECT 
	"TX"."NombreDiplomado",
	"TX"."CodigoDiplomado",
	(SELECT COUNT("T0"."Genero") FROM "Participantes" "T0" 
		INNER JOIN  "GruposParticipantes" "T1" ON "T1"."CodigoParticipante" = "T0"."CodigoParticipante"
		INNER JOIN "GrupoPeriodos" "T2" ON "T1"."CodigoGrupoPeriodo" = "T2"."CodigoGrupoPeriodo"
		INNER JOIN "Periodos" "T3" ON "T3"."CodigoPeriodo" = "T2"."CodigoPeriodo"
		INNER JOIN "Modulos" "T4" ON "T4"."CodigoModulo" = "T3"."CodigoModulo"
	WHERE "T3"."Estado" = TRUE  AND "T4"."CodigoDiplomado" = "TX"."CodigoDiplomado" AND "T0"."Genero" = \'M\') AS "Hombres",
	(SELECT COUNT("T0"."Genero") FROM "Participantes" "T0" 
		INNER JOIN  "GruposParticipantes" "T1" ON "T1"."CodigoParticipante" = "T0"."CodigoParticipante"
		INNER JOIN "GrupoPeriodos" "T2" ON "T1"."CodigoGrupoPeriodo" = "T2"."CodigoGrupoPeriodo"
		INNER JOIN "Periodos" "T3" ON "T3"."CodigoPeriodo" = "T2"."CodigoPeriodo"
		INNER JOIN "Modulos" "T4" ON "T4"."CodigoModulo" = "T3"."CodigoModulo"
	WHERE "T3"."Estado" = TRUE  AND "T4"."CodigoDiplomado" = "TX"."CodigoDiplomado" AND "T0"."Genero" = \'F\') AS "Mujeres"
FROM
	"Diplomados" "TX";');
            if ($consulta != null) {
                $resultado = $consulta->result();
            }
            return $resultado;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }
    public function getFavorities() {
        try {
            $consulta = $this->db->query('SELECT
  "Diplomados"."NombreDiplomado", 
  COUNT("Participantes"."Genero") AS "Cantidad",
  "Diplomados"."CodigoDiplomado"
FROM 
  public."GruposParticipantes", 
  public."Participantes", 
  public."GrupoPeriodos", 
  public."Modulos", 
  public."Diplomados", 
  public."Periodos"
WHERE 
  "GruposParticipantes"."CodigoGrupoPeriodo" = "GrupoPeriodos"."CodigoGrupoPeriodo" AND
  "GruposParticipantes"."CodigoParticipante" = "Participantes"."CodigoParticipante" AND
  "Modulos"."CodigoModulo" = "Periodos"."CodigoModulo" AND
  "Diplomados"."CodigoDiplomado" = "Modulos"."CodigoDiplomado" AND
  "Periodos"."CodigoPeriodo" = "GrupoPeriodos"."CodigoPeriodo" 
  AND "Periodos"."Estado" = TRUE  AND "Diplomados"."Estado" = TRUE
GROUP BY "Diplomados"."NombreDiplomado", "Diplomados"."CodigoDiplomado"
ORDER BY "Cantidad" DESC
LIMIT 5;');
            if ($consulta != null) {
                $resultado = $consulta->result();
            }
            return $resultado;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }

}
