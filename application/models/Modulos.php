<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Modulos extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

  public function listarModulos() {
         
      try{
          $this->db->select('CodigoModulo, '
                . 'NombreModulo, '
                . 'OrdenModulo, '
                . 'Estado, '
                . 'CodigoTurno, '
                . 'CodigoDiplomado, '       
                . 'Comentarios'
        );
        $this->db->from('Modulos');  
        $consultaM = $this->db->get();
        $resultadoM = $consultaM->result();
  }  catch (Exception $ex){
      $ex->getMessage();
  }
        return $resultadoM;
    }

    public function crearModulo($CodigoModulo = null, $NombreModulo, $OrdenModulo, $Estado,$userModi,$ip,$fechaMo,$CodigoTurno, $CodigoDiplomado, $Comentarios) {
       try{
        $data = array(
            'NombreModulo' => $NombreModulo,
            'OrdenModulo' => $OrdenModulo,
            'Estado' => $Estado,
            'UsuarioModifica'=>$userModi,
            'IpModifica'=>$ip,
            'FechaModifica'=>$fechaMo,            
            'CodigoDiplomado' => $CodigoDiplomado,
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
    public function EliminarModulos($CodigoDiplomado){  //Preguntar para uqe sirve
        $this->db->delete('Modulos', array('CodigoDiplomado' => $CodigoDiplomado));
    }

    public function ModificarModulo($CodigoModulo, $OrdenModulo, $Estado, $CodigoDiplomados, $CodigoTurnos, $UsuarioModifica, $IPModifica, $FechaModifica, $Comentarios= null) {
       try{
        $data = array(
            'OrdenModulo' => $OrdenModulo,
            'Estado' => $Estado,
            'CodigoDiplomados' => $CodigoDiplomados,
            'CodigoTurnos' => $CodigoTurnos,
            'UsuarioModifica' => $UsuarioModifica,
            'IPModifica' => $IPModifica,
            'FechaModifica' => $FechaModifica,
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
    //$this->db->like('NombreDiplomado',$filtrar);
    $consulta = $this->db->get();
    $resultado= $consulta->result();
    return $resultado;
}


}