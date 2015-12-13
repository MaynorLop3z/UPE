<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Diplomados extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

//    public function listarDiplomados() {
//      $query =  $this->db->query("SELECT d.CodigoDiplomado, d.NombreDiplomado, d.Descripcion, d.Estado, cd.NombreCategoriaDiplomado, d.Comentarios FROM Diplomados d JOIN CategoriaDiplomados cd ON d.CodigoCategoriaDiplomado = cd.CodigoCategoriaDiplomado") ;
//        $resultado =  $query->result();
//        echo "Talcosa";
//        return $resultado;
//        
//    }
//    public function listarDiplomados() {
//        $this->db->select('CodigoDiplomado, '
//                . 'NombreDiplomado, '
//                . 'Descripcion, '
//                . 'Estado, '
//                . 'CodigoCategoriaDiplomado,'
//                . 'Comentarios'
//                
//                
//        );
//        $this->db->from('Diplomados');
//        $consulta = $this->db->get();
//        $resultado = $consulta->result();
//        return $resultado;
//    }
    public function listarModulos($codigoDiplomado) {
        $this->db->select('CodigoModulo, '
                . 'NombreModulo, '
                . 'OrdenModulo, '
                . 'Estado, '
                . 'CodigoDiplomado, '
                . 'CodigoTurnos, '
                . 'Comentarios'
        );
        $this->db->from('Modulos');
        $this->db->where('CodigoDiplomado', $codigoDiplomado);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }
public function listarDiplomados() {
        try {
            $consulta = $this->db->query('SELECT "d"."CodigoDiplomado", "d"."NombreDiplomado", "d"."Descripcion", "d"."Estado", "cd"."NombreCategoriaDiplomado", "d"."Comentarios" FROM "Diplomados" "d" JOIN "CategoriaDiplomados" "cd" ON "d"."CodigoCategoriaDiplomado" = "cd"."CodigoCategoriaDiplomado"');
//            $consulta = $this->db->query('SELECT d.CodigoDiplomado FROM Diplomados d');
            if($consulta!=null){
            $resultado = $consulta->result();
            }else{
                
            }
           
            return $resultado;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }
    public function listarDiplomadosCategoria($idCategoria) {
        $this->db->select('CodigoDiplomado,'.'NombreDiplomado');
        $this->db->from('Diplomados');
        $this->db->where('CodigoCategoriaDiplomado',$idCategoria);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }
    
    public function crearDiplomado($NombreDiplomado, $Descripcion, $Estado,$CodigoCategoriaDiplomado,$Comentarios) {
        try {
            $data = array(
                'NombreDiplomado' => $NombreDiplomado,
                'Descripcion' => $Descripcion,
                'Estado' => $Estado,
                'CodigoCategoriaDiplomado' => $CodigoCategoriaDiplomado,
                'Comentarios' => $Comentarios,
                
            );
            //$this->db->insert('Modulos', $data
            $this->db->insert('Diplomados', $data);
            $insert_id = $this->db->insert_id();
            $data['CodigoDiplomado'] = $insert_id; //Acabo de quitarle una s 
        } catch (Exception $exe) {
            $exe->getMessage();
        }
        return $data;
    }

    public function EliminarDiplomado($CodigoDiplomado) {
        $eliminar = false;
        try{
        $this->db->delete('Diplomados', array('CodigoDiplomado' => $CodigoDiplomado));
        if($this->db->affected_rows()==1){
            $eliminar = true;
        }
    }  catch (Exception $ex){
        $ex->getMessage();
    }
    return $eliminar;
    }
    
    public function ModificarDiplomado($CodigoDiplomado, $NombreDiplomado, $Descripcion, $Estado,$CodigoCategoriaDiplomado,$Comentarios) {
        try{
        $data = array(
                'NombreDiplomado' => $NombreDiplomado,
                'Descripcion' => $Descripcion,
                'Estado' => $Estado,
                'CodigoCategoriaDiplomado' => $CodigoCategoriaDiplomado,
                'Comentarios' => $Comentarios,
        );
        $this->db->where('CodigoDiplomado', $CodigoDiplomado);
        $this->db->update('Diplomados', $data);
        $data['CodigoDiplomado']=$CodigoDiplomado;
    }  catch (Exception $ex){
        $ex->getMessage();
    }
       return $data; 
    }
    

//Funcion para encontrar los diplomados Arreglarlo 
  // public function buscarDiplomado($CodigoDiplomado){
    //   $this->db->select('CodigoDiplomado,NombreDiplomado,Descripcion,Estado,Comentarios');
      // $this->db->from('NombreDiplomado');
       //$this->db->where('NombreDiplomado',$id);
      // $consultaDiplomado = $this->db->get();
       //$resultadoDiplomado = $consultaDiplomado->row();
       //return $resultadoDiplomado;
              
       
  // }
    
    public function listarCategoriasDiplomados() {
        $this->db->select('CodigoCategoriaDiplomado, '
                . 'NombreCategoriaDiplomado, '
                . 'Estado, '
                . 'Comentarios'
        );
        $this->db->from('CategoriaDiplomados');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

}
