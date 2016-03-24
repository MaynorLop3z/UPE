<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//include('ModeloBase.php');
class Rol extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarRoles() {
        try {
            $this->db->select('CodigoRol, NombreRol, Estado, VersionRol');
            $this->db->from('Rol');
            $this->db->where('Estado', TRUE);
            $consulta = $this->db->get();
            $resultado = $consulta->result();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $resultado;
    }

    public function CrearRol($NombreRol, $ipModifica, $userModifica) {
        try {
            $data = array(
//            'CodigoRol' => null,
                'NombreRol' => $NombreRol,
                'Estado' => TRUE,
                'VersionRol' => 1,
                'UsuarioModifica' => $userModifica,
                'IPModifica' => $ipModifica,
                'FechaModifica' => date("Y/m/d")
            );
            $this->db->insert('Rol', $data);
            $insert_id = $this->db->insert_id();
            $data['CodigoRol'] = $insert_id;
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $insert_id;
    }

    //Debido a que las eliminaciones en cascada van por nosotros debemos hacer un DELETE al registro
    //que asocia los permisos asignados al rol.
    public function EliminarRol($CodigoRol, $CodigoRolesPermisos) {
        $this->db->delete('Rol', array('CodigoRol' => $CodigoRol));
        $this->db->delete('RolesPermisos', array('CodigoRolesPermisos' => CodigoRolesPermisos));
    }

    public function ModificarRol($CodigoRol, $NombreRol,  $IPModifica ,$UsuarioModifica) {
        $data = array(
            'NombreRol' => $NombreRol,
            'VersionRol' => 1,
            'UsuarioModifica' => $UsuarioModifica,
            'IPModifica' => $IPModifica,
            'FechaModifica' => date("Y/m/d")
        );

        $this->db->where('CodigoRol', $CodigoRol);
        $this->db->update('Rol', $data);
         $data['CodigoRol'] = $CodigoRol;
        return $data;
    }

}
