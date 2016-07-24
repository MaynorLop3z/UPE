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

            $this->db->from('Usuarios');
            $this->db->order_by("FechaModifica", "desc");
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
                'NombreUsuario' => trim($nombreUsuario),
                'ContraseniaUsuario' => $contraseniaUsuario,
                'Nombre' => trim($nombrePersonaUsuario),
                'CorreoUsuario' => $correo,
                'FechaModifica' => date("Y-m-d H:i:s"),
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
                    'FechaModifica' => date("Y-m-d H:i:s"),
                    'UsuarioModifica' => $userModifica,
                    'IPModifica' => $ipModifica,
                    'Comentarios' => $comentarios
                );
                $this->db->where('CodigoUsuario', $codigoUsuario);
                $this->db->update('Usuarios', $data);
//                $data['CodigoUsuario'] = $codigoUsuario;
              return  $this->findUsuario($codigoUsuario);
            } catch (Exception $ex) {
                $ex->getMessage();
            }
            
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
        $this->db->select('CodigoUsuario, Nombre, CorreoUsuario, NombreUsuario, ContraseniaUsuario, Comentarios');
        $this->db->from('Usuarios');
        $this->db->where('CodigoUsuario', $codigoUsuario);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

    public function listPermisosByUser($codigoUsuario) {
        try {
            $stringQuery = 'SELECT distinct "Permisos"."CodigoPermisos", "Permisos"."NombrePermiso", "Permisos"."EstadoPermisos", "Permisos"."UsuarioModifica", "Permisos"."IpModifica", "Permisos"."FechaModifica", "Permisos"."idContainer", "Permisos"."classContainer", "Permisos"."controllerContainer", "Permisos"."systemPart" FROM public."Permisos", public."UsuarioRoles", public."RolesPermisos" WHERE "Permisos"."CodigoPermisos" = "RolesPermisos"."CodigoPermisos" AND"UsuarioRoles"."CodigoRol" = "RolesPermisos"."CodigoRol" AND "UsuarioRoles"."CodigoUsuario" =';
            $stringQuery = $stringQuery . $codigoUsuario;
            $consulta = $this->db->query($stringQuery);
            if ($consulta != null) {
                $resultado = $consulta->result();
            } else {
                
            }
            return $resultado;
        } catch (Exception $e) {
            return $e->getTraceAsString();
        }
    }

    public function getUsersByLike($codigoUsuario) {
        try {
            $stringQuery = 'SELECT "Rol"."NombreRol", "UsuarioRoles"."CodigoRol" FROM public."Rol", public."UsuarioRoles" WHERE "UsuarioRoles"."CodigoUsuario" =';
            $stringQuery = $stringQuery . $codigoUsuario;
            $stringQuery = $stringQuery . 'ORDER BY "Rol"."NombreRol" ASC';
            $consulta = $this->db->query($stringQuery);
            if ($consulta != null) {
                $resultado = $consulta->result();
            } else {
                
            }
            return $resultado;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }

    public function countAllUsers() {
        $num_rows = $this->db->count_all_results('Usuarios');
        return $num_rows;
    }

    public function getRoles() {
        $this->db->select('CodigoRol' . 'NombreRol' . 'Estado');
        $this->db->from('Roles');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function insertDeleteRolesUser($rolesUsera) {
        try {
            $codUser;
            $rolesUserDB;
            $rolEncontrado = FALSE;
            $rolesUser=  $object = json_decode(json_encode(($rolesUsera)), FALSE);
            if ($rolesUser != null && count($rolesUser) > 0) {
                foreach ($rolesUser as $rolUsr) {
                    $codUser=$rolUsr->CodigoUsuario;
                }
                
                
                $rolesUserDB = $this->getRolesByUsr($codUser);
            }

            foreach ($rolesUser as $rolUsr) {
                
                if ($rolUsr->Sta == AGREGA_REG) {
                    //Comprobar que el usuario no tenga ese rol  
                    if ($rolesUserDB != null && count($rolesUserDB) > 0) {
                        foreach ($rolesUserDB as $rolUsrDB) {
                            if ($rolUsrDB->CodigoRol == $rolUsr->CodigoRol) {
                                $rolEncontrado = TRUE;
                                break;
                            } else {
                                $rolEncontrado = FALSE;
                            }
                        }
                    }else{
                       
                    }
                    if ($rolEncontrado) {
                        
                    } else {
                        $data = array(
                            'CodigoRol' => $rolUsr->CodigoRol,
                            'CodigoUsuario' => $rolUsr->CodigoUsuario,
                        );
                        $this->db->insert('UsuarioRoles', $data);
                    }
                } else if ($rolUsr->Sta == ELIMINA_REG) {
                    $data = array(
                        'CodigoRol' => $rolUsr->CodigoRol,
                        'CodigoUsuario' => $rolUsr->CodigoUsuario,
                    );
                    $this->db->delete('UsuarioRoles', $data);
                    if ($this->db->affected_rows() == 1) {
                        $eliminado = true;
                    }
                }
            }
            //Rutina para insertar
            //$this->db->insert('UsuarioRoles', $data);
            // $insert_id = $this->db->insert_id();
            // $data['CodigoUsuario'] = $insert_id;
            //Rutina para eliminar
            return $codUser;
        } catch (Exception $e) {
           return $e->getMessage();
        }
       
    }

}
