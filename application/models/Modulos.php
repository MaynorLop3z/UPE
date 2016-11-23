<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Modulos extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    
    public function listarModulosNombre($filtro=null, $turno=null, $diplomado=null){
        $this->db->select('CodigoModulo, '
                . 'NombreModulo, '
                . 'OrdenModulo, '
                . 'Estado, '
                . 'CodigoTurno, '
                . 'CodigoDiplomado, '       
                . 'Comentarios');
        $this->db->from('Modulos');
        if($filtro!=null){
            $this->db->like('LOWER("NombreModulo")', strtolower($filtro));
        }
        if($turno!=null){
            $this->db->like('LOWER("CodigoTurno")', strtolower($turno));
        }
        if($diplomado!=null){
            $this->db->like('LOWER("CodigoDiplomado")', strtolower($diplomado));
        }
//        $this->db->limit('10', 0);
        $consulta = $this->db->get();
//        $consulta = $this->db->query('SELECT "CodigoModulo", "NombreModulo", "OrdenModulo", "Estado", "CodigoTurno", "CodigoDiplomado", "Comentarios"'
//                . ' FROM "Modulos" WHERE LOWER("NombreModulo") LIKE \'%'. strtolower($filtro).'%\'');
        $resultado = $consulta->result();
        return $resultado;
        
    }
  public function listarModulos() { 
      
//      try {
//      $consulta = $this->db->query('SELCT "d"."CodigoModulo","d"."NombreModulo", "d"."OrdenModulo","d"."Estado"."d"."UsuarioModifica","d"."IpModifica","d"."FechaModifica","d"."CodigoTurno","d"."CodigoDiplomado","d"."Comentarios" FROM "Modulos" "d"  JOIN "CodigoModulo" "cd" ON "d"."CodigoDiplomado" = "cd"."CodigoDiplomado"');    
//      if ($consulta!=null){
//          $resultado = $consulta->result();
//          
//      }else{
//          
//      }
//      return $resultado;
//      }  catch (Exception $exc){
//          return $exc->getTraceAsString();
//          
//      }
//      
//      }
        $this->db->select('CodigoModulo, '
                . 'NombreModulo, '
                . 'OrdenModulo, '
                . 'Estado, '
                . 'CodigoTurno, '
                . 'CodigoDiplomado, '       
                . 'Comentarios'
        );
        $this->db->from('Modulos');
        $this->db->where('Estado',TRUE);
        $consultaM = $this->db->get();
        $resultadoM = $consultaM->result();
         return $resultadoM;
  }
  
    public function crearModulo($NombreModulo, $OrdenModulo,$CodigoTurno, $Estado ,$CodigoDiplomado, $Comentarios,$IpUserModifica,$UserModifica) {
       try{
        $data = array(
            'NombreModulo' => $NombreModulo,
            'OrdenModulo' => $OrdenModulo,
            'Estado' => $Estado,
            'UsuarioModifica'=>$UserModifica,
            'IpModifica'=>$IpUserModifica,
            'FechaModifica'=>date("Y/m/d"), 
            'CodigoTurno' => $CodigoTurno,
            'CodigoDiplomado' => $CodigoDiplomado,
            'Comentarios' => $Comentarios
        );
        $this->db->insert('Modulos', $data);
        $insert_id = $this->db->insert_id();
        $data['CodigoModulo'] = $insert_id;
    }  catch (Exception $ex){ 
        $ex->getMessage();
        
    }
    return $data;
    }
    
    public function EliminarModulo($CodigoModulo) {
        $eliminar = false;
        try{
        $this->db->delete('Modulos', array('CodigoModulo' => $CodigoModulo));
        if($this->db->affected_rows()==1){
            $eliminar = true;
        }
    }  catch(Exception $ex){
        $ex->getMessage();
    }
    return $eliminar;
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
    
    public function EliminarModulos($CodigoModulo){  //
        $this->db->delete('Modulos', array('CodigoModulo' => $CodigoModulo));
    }
    
    
    public function inactivarModulo($CodigoModulo, $ipModifica, $usuarioModifica){
        try{
            $data = array(
                'Estado'=>FALSE,
                'UsuarioModifica'=>$usuarioModifica,
                'IpModifica' =>$ipModifica,
                'FechaModifica' =>date("Y/m/d")
                );
                $this->db->where('CodigoModulo',$CodigoModulo);
                $this->db->update('Modulos',$data);
                $data['CodigoModulo'] = $CodigoModulo;
                return $data;
        }  catch (Exception $exc){
            $exc->getMessage();
        }        
    }
    
    public function ModificarModulo($CodigoModulo, $NombreModulo, $OrdenModulo, $Estado, $CodigoTurnos,  $CodigoDiplomados, $Comentarios,  $IPModifica, $UsuarioModifica) {
       try{
        $data = array(
            'NombreModulo'=>$NombreModulo,
            'OrdenModulo' => $OrdenModulo,
            'Estado' => $Estado,
            'UsuarioModifica' => $UsuarioModifica,
            'IpModifica' => $IPModifica,
            'FechaModifica'=>date("Y/m/d"), 
            'CodigoTurno' => $CodigoTurnos,
            'CodigoDiplomado' => $CodigoDiplomados,
            'Comentarios' => $Comentarios            
        );
        $this->db->where('CodigoModulo', $CodigoModulo);
        $this->db->update('Modulos', $data);
        $data['CodigoModulo']=$CodigoModulo;
       }  catch (Exception $ex){
           $ex->getMessage();
       }
       return $data;
    }
    
    public function listarDiplomados() {
            $this->db->select('CodigoDiplomado, '
                    . 'NombreDiplomado, '
                    . 'Estado, '
                    . 'Comentarios'
            );
            $this->db->from('Diplomados');
            $consulta = $this->db->get();
            $resultado = $consulta->result();
            return $resultado;
    }
    
    public function listaModulosDiplomados(){ //Select para Elegir los diplomados  $filtrar
        $this->db->select('CodigoDiplomado,'
                .'NombreDiplomado,'
                .'Descripcion,'
                .'Estado,'
                .'CodigoCategoriaDiplomado,'
                .'Comentarios');              
        $this->db->from('Diplomados');
        $this->db->like('CodigoDiplomado');// Modificado y cambio por NombreDiplomado
        $consulta = $this->db->get();
        $resultado= $consulta->result();
        return $resultado;
    }

    //////////PARA PAGINACION DE MODULOS/////////////
    public function listarModulosLimited($limit, $offset){
        if ($limit == null && $offset == null) {
                $limit = ROWS_PER_PAGE;
                $offset = 0;
            }
         $this->db->select('*');
        $this->db->from('Modulos m');
        $this->db->join('Diplomados d','d.CodigoDiplomado=m.CodigoDiplomado');
        $this->db->where('m.Estado',TRUE);
        $this->db->limit($limit, $offset);
        $consultaM = $this->db->get();
        $resultadoM = $consultaM->result();
         return $resultadoM;
    }
}