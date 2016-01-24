<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//include('ModeloBase.php');

class Usuarios extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarUsuarios($limit, $offset) {
        try {
            $this->db->select('CodigoUsuario, Nombre, CorreoUsuario, NombreUsuario, ContraseniaUsuario, Comentarios ');
            if ($limit == null && $offset == null) {
                $limit = ROWS_PER_PAGE;
                $offset = 0;
            }
            $limit = ROWS_PER_PAGE;
//            $this->db->order_by("FechaModifica", "desc");
            $this->db->from('Usuarios');
            $this->db->limit($limit, $offset);
            $consulta = $this->db->get();
            $resultado = $consulta->result();
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $resultado;
    }

    public function guardarUsuario($codigoUsuario = null, $nombreUsuario, $contraseniaUsuario, $nombrePersonaUsuario, $correo, $userModifica, $ipModifica, $comentarios) {
        try {
            $data = array(
                'NombreUsuario' => $nombreUsuario,
                'ContraseniaUsuario' => $contraseniaUsuario,
                'Nombre' => $nombrePersonaUsuario,
                'CorreoUsuario' => $correo,
                'FechaModifica' => date("Y/m/d"),
                'UsuarioModifica' => $userModifica,
                'IPModifica' => $ipModifica,
                'Comentarios' => $comentarios
            );
            $this->db->insert('Usuarios', $data);
            $insert_id = $this->db->insert_id();
            $data['CodigoUsuario'] = $insert_id;
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $data;
    }

    public function editarUsuario($codigoUsuario, $nombreUsuario, $contraseniaUsuario, $nombrePersonaUsuario, $correo, $userModifica, $ipModifica, $comentarios) {
        try {
            try {
                $data = array(
                    'NombreUsuario' => $nombreUsuario,
                    'ContraseniaUsuario' => $contraseniaUsuario,
                    'Nombre' => $nombrePersonaUsuario,
                    'CorreoUsuario' => $correo,
                    'FechaModifica' => date("Y/m/d"),
                    'UsuarioModifica' => $userModifica,
                    'IPModifica' => $ipModifica,
                    'Comentarios' => $comentarios
                );
                $this->db->where('CodigoUsuario', $codigoUsuario);
                $this->db->update('Usuarios', $data);
                $data['CodigoUsuario'] = $codigoUsuario;
            } catch (Exception $ex) {
                $ex->getMessage();
            }
            return $data;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    public function eliminarUsuario($codigoUsuario) {
        $eliminado = false;
        try {
            $this->db->where('CodigoUsuario', $codigoUsuario);
            $this->db->delete('Usuarios');
            if ($this->db->affected_rows() == 1) {
                $eliminado = true;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $eliminado;
    }

    public function findUsuario($codigoUsuario) {
        $this->db->select('CodigoUsuario, Nombre, CorreoUsuario, NombreUsuario');
        $this->db->from('Usuarios');
        $this->db->where('CodigoUsuario', $id);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }
    
    public function listRoleByUser($codigoUsuario){
       try
       {
           $stringQuery='SELECT "Permisos"."CodigoPermisos", "Permisos"."NombrePermiso", "Permisos"."EstadoPermisos", "Permisos"."UsuarioModifica", "Permisos"."IpModifica", "Permisos"."FechaModifica", "Permisos"."idContainer", "Permisos"."classContainer", "Permisos"."controllerContainer", "Permisos"."systemPart" FROM public."Permisos", public."UsuarioRoles", public."RolesPermisos" WHERE "Permisos"."CodigoPermisos" = "RolesPermisos"."CodigoPermisos" AND"UsuarioRoles"."CodigoRol" = "RolesPermisos"."CodigoRol" AND "UsuarioRoles"."CodigoUsuario" =';
           $stringQuery=$stringQuery.$codigoUsuario;
        $consulta=  $this->db->query($stringQuery);
        if($consulta!=null){
            $resultado = $consulta->result();
            }else{
                
            }
            return $resultado;
       }catch(Exception $e){
            return $e->getTraceAsString();
       }
    }
    

    public function countAllUsers() {
        $num_rows = $this->db->count_all_results('Usuarios');
        return $num_rows;
    }

}
