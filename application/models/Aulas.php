<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Aulas extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function listarAulas($limit=null, $offset=null) {
        try{
            $this->db->select('IdAula, NombreAula, Descripcion, TipoAula');
            $this->db->from('Aulas');
            $this->db->order_by("NombreAula", "desc");
            if($offset!=null && $limit!=null){
                $this->db->limit($limit, $offset);
            }else if($limit!=null && $offset==null){
                $this->db->limit($limit);
            }
            $consulta = $this->db->get();
            $resultado = $consulta->result();
            return $resultado;
        }catch(Exception $e){
            return $e;
        }
    }
    
    public function buscarAulas($nombre=null, $tipo=null){
        try{
            $this->db->select('IdAula, NombreAula, Descripcion, TipoAula');
            $this->db->from('Aulas');
            $this->db->order_by("NombreAula", "desc");
            if($nombre!=null){
                $this->db->like('LOWER("NombreAula")', strtolower($nombre));
            }
            if($tipo!=null){
                 $this->db->like('LOWER("TipoAula")', strtolower($tipo));
            }
            $consulta = $this->db->get();
            $resultado = $consulta->result();
            return $resultado;
        }catch(Exception $e){
            return $e;
        }
    }
    
    public function agregarAula($nombre=null, $descripcion=null, $tipo=null){
        if($nombre!=null && $descripcion!=null){
            try{
                $data = array(
                    'NombreAula' => $nombre,
                    'Descripcion' => $descripcion,
                    'TipoAula' => $tipo);
                $this->db->insert('Aulas', $data);
                $insert_id = $this->db->insert_id();
                $data['IdAula'] = $insert_id;
            } catch (Exception $ex) {
                $ex->getMessage();
            }
        }
        return $data;
    }
    
    public function modificarAula($nombre=null, $descripcion=null, $tipo=null, $id=null){
        if(($nombre!=null && $descripcion!=null) && $id!=null){
            try{
                if($tipo==null){ $tipo="";}
                $data = array(
                    'NombreAula' => $nombre,
                    'Descripcion' => $descripcion,
                    'TipoAula' => $tipo);
                $this->db->where('IdAula', $id);
                $this->db->update('Aulas', $data);
                $data['IdAula'] = $id;
            } catch (Exception $ex) {
                $ex->getMessage();
            }
        }
        return $data;
    }

    public function eliminarAula($id=null) {
        try{
            $this->db->where('IdAula', $id);
            $this->db->delete('Aulas');
            if ($this->db->affected_rows() == 1) {
                $eliminado = true;
            }
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        return $eliminado;
    }
    
}
?>