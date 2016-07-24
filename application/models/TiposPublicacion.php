<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//include('ModeloBase.php');
class EstadosParticipantes extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarTiposPublicaciones() {
        $this->db->select('CodigoTiposPublicacion, '
                . 'NombrePublicacion'
        );
        $this->db->from('TiposPublicacion');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function CrearTiposPublicacion($NombrePublicacion) {
        $data = array(
            'NombrePublicacion' => $NombrePublicacion
        );
        $this->db->insert('TiposPublicacion', $data);
    }

    public function EliminarTiposPublicacion($CodigoTiposPublicacion) {
        $this->db->delete('TiposPublicacion', array('CodigoEstados' => $CodigoTiposPublicacion));
        //Hay que verificar si existen publicaciones de ser asi no eliminar o cambiar a una
        //por defecto
    }

    public function ModificarTiposPublicacion($CodigoTiposPublicacion, $NombrePublicacion) {
        $data = array(
            'NombrePublicacion' => $NombrePublicacion,
        );
        $this->db->where('CodigoTiposPublicacion', $CodigoTiposPublicacion);
        $this->db->update('EstadosParticipantes', $data);
    }

}
