<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rol extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarRoles() {
        $this->db->select('CodigoRol, NombreRol, Estado, VersionRol, CodigoRolesPermisos');
        $this->db->from('Rol');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    //Las cosas de modificacion es decir el User IP Fecha de no se si perdirlas como
    //parametro

    public function CrearRol($NombreRol, $Estado, $VersionRol, $CodigoRolesPermisos) {
        $data = array(
//            'CodigoRol' => null,
            'NombreRol' => $NombreRol,
            'Estado' => $Estado,
            'VersionRol' => $VersionRol,
            'CodigoRolesPermisos' => $CodigoRolesPermisos
//            'UsuarioModifica' => null,
//            'IPModifica' => null,
//            'FechaModifica' => null
        );
        $this->db->insert('Rol', $data);
    }

    //Debido a que las eliminaciones en cascada van por nosotros debemos hacer un DELETE al registro
    //que asocia los permisos asignados al rol.
    public function EliminarRol($CodigoRol, $CodigoRolesPermisos) {
        $this->db->delete('Rol', array('CodigoRol' => $CodigoRol));
        $this->db->delete('RolesPermisos', array('CodigoRolesPermisos' => CodigoRolesPermisos));
    }

    public function ModificarRol($CodigoRol, $NombreRol, $Estado, $VersionRol, $UsuarioModifica, $IPModifica, $FechaModifica) {
        $data = array(
            'NombreRol' => $NombreRol,
            'Estado' => $Estado,
            'VersionRol' => $VersionRol,
            'UsuarioModifica' => $UsuarioModifica,
            'IPModifica' => $IPModifica,
            'FechaModifica' => $FechaModifica
        );

        $this->db->where('CodigoRol', $CodigoRol);
        $this->db->update('Rol', $data);
    }

}
