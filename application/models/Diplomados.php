<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Diplomados extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarDiplomados() {
        $this->db->select('CodigoDiplomado, '
                . 'NombreDiplomado, '
                . 'Descripcion, '
                . 'Estado, '
                . 'CodigoCategoriaDiplomado,'
                . 'Comentarios'
                
                
        );
        $this->db->from('Diplomados');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function listarDiplomadosCategoria() {
        $this->db->select('CodigoCategoriaDiplomado,'.'NombreCategoriaDiplomado');
        $this->db->from('CategoriaDiplomados');
        //$this->db->where('CodigoCategoriaDiplomado');
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
            $data['CodigoDiplomados'] = $insert_id;
        } catch (Exception $exe) {
            $exe->getMessage();
        }
        return $data;
    }

    public function EliminarDiplomado($CodigoDiplomado) {
        $this->db->delete('Diplomados', array('CodigoDiplomado' => $CodigoDiplomado));
    }

    public function ModificarDiplomado($CodigoDiplomado, $NombreDiplomado, $Descripcion, $Estado, $Comentarios) {
        $data = array(
            'NombreDiplomado' => $NombreDiplomado,
            'Descripcion' => $Descripcion,
            'Estado' => $Estado,
            'Comentarios' => $Comentarios
        );
        $this->db->where('CodigoDiplomado', $CodigoDiplomado);
        $this->db->update('Diplomados', $data);
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

}
