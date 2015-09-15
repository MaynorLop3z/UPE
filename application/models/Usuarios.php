<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//include('ModeloBase.php');

class Usuarios extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarUsuarios() {
        $this->db->select('CodigoUsuario, Nombre, CorreoUsuario, NombreUsuario');
        $this->db->from('Usuarios');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function guardarUsuario($codigoUsuario=null, $nombreUsuario, $contraseniaUsuario,$nombrePersonaUsuario,$correo) {
        $data = array(
            
            
            'NombreUsuario' => $nombreUsuario,
            'ContraseniaUsuario' => $contraseniaUsuario,
            'Nombre'=>$nombrePersonaUsuario,
            'CorreoUsuario'=>$correo
        );
        if ($codigoUsuario) {
            $this->db->where('CodigoUsuario', $codigoUsuario);
            $this->db->update('Usuarios', $data);
        } else {
            $this->db->insert('Usuarios', $data);
        }
    }

    public function eliminarUsuario($codigoUsuario) {
        $this->db->where('CodigoUsuario', $codigoUsuario);
        $this->db->delete('Usuarios');
    }

    public function findUsuario($codigoUsuario) {
        $this->db->select('CodigoUsuario, Nombre, CorreoUsuario, NombreUsuario');
        $this->db->from('Usuarios');
        $this->db->where('CodigoUsuario', $id);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

}
