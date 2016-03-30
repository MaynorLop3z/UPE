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

    public function ModificarRol($CodigoRol, $NombreRol, $IPModifica, $UsuarioModifica) {
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

    public function inactivarRol($CodigoRol, $ipModifica, $usuarioModifica) {
        try {
            $data = array(
                'Estado' => FALSE,
                'UsuarioModifica' => $usuarioModifica,
                'IPModifica' => $ipModifica,
                'FechaModifica' => date("Y/m/d")
            );

            $this->db->where('CodigoRol', $CodigoRol);
            $this->db->update('Rol', $data);
            $data['CodigoRol'] = $CodigoRol;
            return $data;
        } catch (Exception $exc) {
            $exc->getMessage();
        }
    }

    public function listarPermisos() {
        try {
            $this->db->select('CodigoPermisos, NombrePermiso, EstadoPermisos, controllerContainer');
            $this->db->from('Permisos');
            $this->db->where('EstadoPermisos', TRUE);
            $consulta = $this->db->get();
            $resultado = $consulta->result();
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $resultado;
    }

    public function getRightsByRol($codigoRol) {
        try {
            $stringQuery = 'SELECT "Permisos"."NombrePermiso","RolesPermisos"."CodigoPermisos" FROM "RolesPermisos" INNER JOIN  "Permisos" ON "RolesPermisos"."CodigoPermisos"= "Permisos"."CodigoPermisos" WHERE "EstadoPermisos"=TRUE AND "RolesPermisos"."CodigoRol"=';
            $stringQuery = $stringQuery . $codigoRol;
            $stringQuery = $stringQuery . 'ORDER by "Permisos"."NombrePermiso" ASC';
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

    public function insertDeleteRightsByRol($RightsRolesa) {
        try {
            $codRol;
            $rolesRightsDB;
            $rightEncontrado = FALSE;
            $rolesRights = $object = json_decode(json_encode(($RightsRolesa)), FALSE);
            if ($rolesRights != null && count($rolesRights) > 0) {
                foreach ($rolesRights as $rolRight) {
                    $codRol = $rolRight->CodigoRol;
                }


                $rolesRightsDB = $this->getRightsByRol($codRol);
            }

            foreach ($rolesRights as $rolRight) {

                if ($rolRight->Sta == AGREGA_REG) {
                    //Comprobar que el rol no tenga ese permiso  
                    if ($rolesRightsDB != null && count($rolesRightsDB) > 0) {
                        foreach ($rolesRightsDB as $rolRightDB) {
                            if ($rolRightDB->CodigoPermisos == $rolRight->CodigoPermisos) {
                                $rightEncontrado = TRUE;
                                break;
                            } else {
                                $rightEncontrado = FALSE;
                            }
                        }
                    } else {
                        
                    }
                    if ($rightEncontrado) {
                        
                    } else {
                        $data = array(
                            'CodigoPermisos' => $rolRight->CodigoPermisos,
                            'CodigoRol' => $rolRight->CodigoRol,
                        );
                        $this->db->insert('RolesPermisos', $data);
                    }
                } else if ($rolRight->Sta == ELIMINA_REG) {
                    $data = array(
                        'CodigoPermisos' => $rolRight->CodigoPermisos,
                        'CodigoRol' => $rolRight->CodigoRol,
                    );
                    $this->db->delete('RolesPermisos', $data);
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
            return $codRol;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

}
