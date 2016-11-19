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

    public function listarDocentesGrupos($idGrupoPeriodo) {
        try {
            $comando = 'SELECT * FROM getdocentesgrupo (' . $idGrupoPeriodo . ')';
            $consulta = $this->db->query($comando);
            if ($consulta != null) {
                $resultado = $consulta->result();
            } else {
                
            }

            return $resultado;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }

    public function listarGruposPeriodos() {
        try {
            $comando = 'SELECT * FROM getGruposActuales ()';
            $consulta = $this->db->query($comando);
            if ($consulta != null) {
                $resultado = $consulta->result();
            } else {
                
            }

            return $resultado;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
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
     public function listarPeriodosL($mod, $limite=null, $offset=null) {
         if ($offset == null) {
               $offset = 0;
            }
         if($limite==null){
             $limite=0;
         }
        $this->db->select('CodigoPeriodo, '
                . 'FechaInicioPeriodo, '
                . 'FechaFinPeriodo, '
                . 'Estado, '
                . 'Comentario, '
                . 'CodigoModulo'
        );
        $this->db->from('Periodos');
        $this->db->where('CodigoModulo', $mod);
        $this->db->limit($limite, $offset);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function listarGrupos($idPeriodo) {
        $this->db->select('*'
//                . 'CodigoGrupoPeriodo, '
//                . 'CodigoPeriodo, '
//                . 'Estado, '
//                . 'HoraEntrada, '
//                . 'HoraSalida, '
//                . 'Aula'
        );
        $this->db->from('GrupoPeriodos');
        $this->db->where('CodigoPeriodo', $idPeriodo);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }
    
      public function listarGruposHorarios($idPeriodo) {
        $comando = 'SELECT "GrupoPeriodos"."CodigoGrupoPeriodo", "GrupoPeriodos"."Estado", "Horarios"."HoraEntrada",
	"Horarios"."HoraSalida", "Horarios"."Dia", "Aulas"."NombreAula"
        FROM "GrupoPeriodos"
        FULL OUTER JOIN "Horarios"
        ON "Horarios"."CodigoGrupoPeriodo"="GrupoPeriodos"."CodigoGrupoPeriodo"
        LEFT OUTER JOIN "Aulas"
        ON "Horarios"."CodigoAula"="Aulas"."IdAula"

        WHERE "GrupoPeriodos"."CodigoPeriodo" = '.$idPeriodo.' 
        ORDER BY "GrupoPeriodos"."CodigoGrupoPeriodo", "Horarios"."Dia", "Horarios"."HoraEntrada" ASC';
        $consulta = $this->db->query($comando);
        $resultado = $consulta->result();
        return $resultado;
    }
//    public function listarGruposHorarios($idGrupo) {
//        $comando = 'SELECT "GrupoPeriodos"."CodigoGrupoPeriodo", "GrupoPeriodos"."Estado",
//            "Aulas"."NombreAula", "Horarios"."HoraEntrada",  "Horarios"."HoraSalida", 
//            "Horarios"."Dia"
//            FROM "GrupoPeriodos", "Aulas", "Horarios"
//
//           WHERE "GrupoPeriodos"."Estado"=TRUE
//
//           AND "Aulas"."IdAula"= "Horarios"."CodigoAula"
//
//           AND "Horarios"."CodigoGrupoPeriodo"="GrupoPeriodos"."CodigoGrupoPeriodo"
//
//           AND "GrupoPeriodos"."CodigoGrupoPeriodo" = '.$idGrupo.'';
//        $consulta = $this->db->query($comando);
//        $resultado = $consulta->result();
//        return $resultado;
//    }

    public function crearGrupo($idPeriodo, $HoraEntrada, $HoraSalida, $Aula) {
        try {
            $data = array(
                'HoraEntrada' => $HoraEntrada,
                'HoraSalida' => $HoraSalida,
                'Estado' => 't',
                'Aula' => $Aula,
                'CodigoPeriodo' => $idPeriodo
            );
            $this->db->insert('GrupoPeriodos', $data);
            $insert_id = $this->db->insert_id();
            $data['CodigoGrupoPeriodo'] = $insert_id;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        return $data;
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
    
    public function listarPeriodosByModuloLimited($idModulo, $offset){
         if ($offset == null) {
               $offset = 0;
            }
        $limit = ROWS_PER_PAGE;
        $this->db->select('CodigoPeriodo, '
                . 'FechaInicioPeriodo, '
                . 'FechaFinPeriodo, '
                . 'Estado, '
                . 'Comentario, '
                . 'CodigoModulo'
        );
        $this->db->from('Periodos');
        $this->db->where('CodigoModulo', $idModulo);
        $this->db->limit($limit, $offset);
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

    public function ModificarPeriodo($CodigoPeriodo, $FechaInicioPeriodo, $Estado, $FechaFinPeriodo, $Comentario) {
        try {
            $data = array(
                'FechaInicioPeriodo' => $FechaInicioPeriodo,
                'Estado' => $Estado,
                'FechaFinPeriodo' => $FechaFinPeriodo,
                'Comentario' => $Comentario
//            'CodigoModulo' => $CodigoModulo
            );
            $this->db->where('CodigoPeriodo', $CodigoPeriodo);
            $this->db->update('Periodos', $data);
            $data['CodigoPeriodo'] = $CodigoPeriodo;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        return $data;
    }

    public function getMasters($idPeriodo) {
        try {
            $consulta = $this->db->query('SELECT 
  "T4"."CodigoUsuario",
  "T4"."Nombre",
  (SELECT COUNT("T7"."CodigoGruposPeriodoUsuario") FROM "GruposMaestros" "T7" WHERE "T4"."CodigoUsuario" = "T7"."CodigoUsuario" AND "T7"."CodigoGrupoPeriodo" = ' . $idPeriodo . ') AS "Inscrito"
FROM 
  "Usuarios" "T4", 
  "Rol" "T6", 
  "UsuarioRoles" "T5"
WHERE 
  "T4"."CodigoUsuario" = "T5"."CodigoUsuario" AND
  "T6"."CodigoRol" = "T5"."CodigoRol" AND
  "T6"."CodigoRol" = 4;');
            if ($consulta != null) {
                $resultado = $consulta->result();
            }
            return $resultado;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }

    public function getStudents($idPeriodo, $limit=0, $offset=0) {
        try {
            $query='SELECT 
  "T0"."CodigoParticipante",               
  "T0"."Nombre", 
  "T0"."NumeroDUI", 
  "T1"."NombreCategoriaParticipante", 
  "T0"."Comentarios",
  (SELECT COUNT("T2"."CodigoGruposParticipantes") FROM "GruposParticipantes" "T2" WHERE "T2"."CodigoGrupoPeriodo" = '.$idPeriodo.' AND "T2"."CodigoParticipante" = "T0"."CodigoParticipante") AS "Inscrito"
FROM 
  "Participantes" "T0", 
  "CategoriasParticipante" "T1"
WHERE 
  "T0"."CodigoCategoriaParticipantes" = "T1"."CodigoCategoriaParticipantes" ';
            
            if($limit>0){
                $query.='LIMIT '.$limit.' OFFSET '.$offset.' ;';
            }
            $consulta = $this->db->query($query);
            if ($consulta != null) {
                $resultado = $consulta->result();
            }
            return $resultado;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }
    
    public function inscribirDocente( $grupoperiodo, $usuario) {
        try {
            $consulta = $this->db->query('SELECT agregardocentegrupo('.$grupoperiodo.','.$usuario.') AS "Inscripcion"');
            if ($consulta != null) {
                $resultado = $consulta->result();
            } else {
                
            }

            return $resultado;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }
    
    public function countAllPeriodos($di) {
        $num_rows = count($this->listarPeriodosByModulo($di));
        return $num_rows;
    }
}