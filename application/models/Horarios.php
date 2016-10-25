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
    
    public function listarHorarios(){
        try{
            $consulta='SELECT * FROM "Horarios"';
            $rc = $this->db->query($consulta);
            $resultado = $rc->result();
            return $resultado;
        } catch (Exception $ex) {
            return $e;
        }
    }
    
    public function listarHorariosGruposxTurno($turno=null){
        try{
            $consulta='SELECT "Turnos"."NombreTurno", "Modulos"."NombreModulo", 
            "Periodos"."FechaInicioPeriodo", "Periodos"."FechaFinPeriodo",
            "GrupoPeriodos"."CodigoGrupoPeriodo", "GrupoPeriodos"."HoraEntrada",
            "GrupoPeriodos"."HoraSalida", "GrupoPeriodos"."Aula", "Horarios"."IdHorario"

            FROM "Turnos", "Modulos", "Periodos", "GrupoPeriodos"

            WHERE "Turnos"."CodigoTurno" = "Modulos"."CodigoTurno"

            AND "Modulos"."CodigoModulo" = "Periodos"."CodigoModulo"

            AND "Periodos"."CodigoPeriodo" = "GrupoPeriodos"."CodigoPeriodo" ';
            if($turno!=null){
                $consulta.='AND "Turnos"."CodigoTurno"='.$turno;
            }
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
    
       public function listarHorariosxTurno($turno=null, $grupo=null){
        try{
            $consulta='SELECT "Turnos"."NombreTurno", "Horarios"."HoraEntrada", 
            "Horarios"."HoraSalida","Horarios"."Dia","Aulas"."NombreAula", 
            "Periodos"."FechaInicioPeriodo", "Periodos"."FechaFinPeriodo",
            "GrupoPeriodos"."CodigoGrupoPeriodo", "Horarios"."IdHorario"

            FROM "Turnos", "Aulas", "Periodos", "GrupoPeriodos", "Horarios"

            WHERE "Turnos"."CodigoTurno" = "Horarios"."TipoJornada"

            AND "Horarios"."CodigoGrupoPeriodo" = "GrupoPeriodos"."CodigoGrupoPeriodo"

            AND "Periodos"."CodigoPeriodo" = "GrupoPeriodos"."CodigoPeriodo"
            
            AND "Periodos"."Estado" = TRUE

            AND "Aulas"."IdAula" = "Horarios"."CodigoAula" ';
            if($turno!=null){
                $consulta.='AND "Turnos"."CodigoTurno"='.$turno;
            }
            if($grupo!=null){
                $consulta.=' AND "Horarios"."CodigoGrupoPeriodo"='.$grupo;
            }
            $rc = $this->db->query($consulta);
            $resultado = $rc->result();
            return $resultado;
        } catch (Exception $ex) {
            return $e;
        }
    }
    
    public function verificarHorario($dia, $entrada, $salida, $aula, $Gperiodo,$turno){
        try{
            $consulta='SELECT "Turnos"."NombreTurno", "Horarios"."HoraEntrada", 
            "Horarios"."HoraSalida","Horarios"."Dia","Aulas"."NombreAula", 
            "Periodos"."FechaInicioPeriodo", "Periodos"."FechaFinPeriodo",
            "GrupoPeriodos"."CodigoGrupoPeriodo", "Horarios"."IdHorario"

            FROM "Turnos", "Aulas", "Periodos", "GrupoPeriodos", "Horarios"
            
            WHERE "Turnos"."CodigoTurno" = "Horarios"."TipoJornada"

            AND "Horarios"."CodigoGrupoPeriodo" = "GrupoPeriodos"."CodigoGrupoPeriodo" 
            
            AND "Periodos"."CodigoPeriodo" = "GrupoPeriodos"."CodigoPeriodo"
            
            AND "Horarios"."CodigoAula" = "Aulas"."IdAula" 

            AND "Periodos"."Estado" = TRUE 
            AND "Dia"= '.$dia.'
            AND "Horarios"."CodigoAula" = '.$aula.'  
            AND "Horarios"."CodigoGrupoPeriodo" = '.$Gperiodo.' 
            AND (( "Horarios"."HoraEntrada"<=\''.$entrada.'\' AND "Horarios"."HoraSalida">=\''.$salida.'\' ) 
                OR ( "Horarios"."HoraEntrada" BETWEEN \''.$entrada.'\' AND \''.$salida.'\' ) 
                OR ( "Horarios"."HoraSalida" BETWEEN \''.$entrada.'\' AND \''.$salida.'\' )) 
            ';
            if($turno!=null){
                $consulta.='AND "Turnos"."CodigoTurno"='.$turno;
            }
            $rc = $this->db->query($consulta);
            $resultado = $rc->result();
            return $resultado;
        } catch (Exception $ex) {
            return $ex;
        }
    }
    
    public function agregarHorario($hEntrada, $hSalida, $aula, $jornada,$grupo, $dia){
        try{
            $data=array('HoraEntrada'=>$hEntrada, 'HoraSalida'=>$hSalida, 
                'CodigoAula'=>$aula, 'CodigoGrupoPeriodo'=>$grupo,'TipoJornada'=>$jornada,
                'Dia'=>$dia);
            $this->db->insert('Horarios', $data);
            $id = $this->db->insert_id();
            $data['IdHorario'] = $id;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        return $data;
    }
    
    public function eliminarHorario($id) {
        $eliminado = false;
        try {
            $this->db->where('IdHorario', $id);
            $this->db->delete('Horarios');
            if ($this->db->affected_rows() == 1) {
                $eliminado = true;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $eliminado;
    }
    
    public function cargarGruposPeriodos() {
        try{
            $this->db->select('CodigoGrupoPeriodo');
            $this->db->from('GrupoPeriodos');
            $consulta = $this->db->get();
            $resultado = $consulta->result();
            return $resultado;
        }catch(Exception $e){
            return $e;
        }
    }
    
    public function cargar1GrupoPeriodo() {
        try{
            $this->db->select('CodigoGrupoPeriodo');
            $this->db->from('GrupoPeriodos');
            $this->db->limit(1, 0);
            $query = $this->db->get();
            $ret = $query->row();
            return $ret->CodigoGrupoPeriodo;
        }catch(Exception $e){
            return $e;
        }
    }
    
  }
?>