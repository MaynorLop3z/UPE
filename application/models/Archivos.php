<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//include('ModeloBase.php');
class Archivos extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarArchivosPublicacion($CodigoPublicaciones) {
        $this->db->select('CodigoArchivos, '
                . 'Ruta, '
                . 'Nombre, '
                . 'Extension, '
                . 'Estado, '
                . 'CodigoUsuarios'
        );
        $this->db->from('Archivos');
        $this->db->where('CodigoPublicaciones', $CodigoPublicaciones);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function listarArchivosUsuario($CodigoUsuarios) {
        $this->db->select('CodigoArchivos, '
                . 'Ruta, '
                . 'Nombre, '
                . 'Extension, '
                . 'Estado, '
                . 'CodigoPublicaciones'
        );
        $this->db->from('Archivos');
        $this->db->where('CodigoUsuarios', $CodigoUsuarios);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function CrearArchivo($Ruta, $Nombre, $Extension, $Estado, $CodigoUsuarios, $CodigoPublicaiones) {
        $data = array(
            //            'CodigoArchivos' => null,
            'Nombre' => $Nombre,
            'Ruta' => $Ruta,
            'Extension' => $Extension,
            'CodigoUsuarios' => $CodigoUsuarios,
            'CodigoPublicaiones' => $CodigoPublicaiones
        );
        $this->db->insert('Archivos', $data);
    }

    public function EliminarArchivo($CodigoArchivos) {
        $this->db->delete('Archivos', array('CodigoArchivos' => $CodigoArchivos));
    }

    public function EliminarArchivosPublicacion($CodigoPublicaciones) {
        $this->db->delete('Archivos', array('CodigoPublicaciones' => $CodigoPublicaciones));
    }

    public function EliminarArchivosUsuario($CodigoUsuarios) {
        $this->db->delete('Archivos', array('CodigoUsuarios' => $CodigoUsuarios));
    }

    public function ModificarArchivo($CodigoArchivos, $Ruta, $Nombre, $Extension, $Estado, $UsuarioModifica, $IPModifica, $FechaModifica) {
        $data = array(
            'Ruta' => $Ruta,
            'Nombre' => $Nombre,
            'Extension' => $Extension,
            'Estado' => $Estado,
            'UsuarioModifica' => $UsuarioModifica,
            'IPModifica' => $IPModifica,
            'FechaModifica' => $FechaModifica
        );
        $this->db->where('CodigoArchivos', $CodigoArchivos);
        $this->db->update('Archivos', $data);
    }

}
