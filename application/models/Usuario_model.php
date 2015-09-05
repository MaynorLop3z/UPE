<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//include './application/models/dto/UsuariosDTO.php';
class Usuario_model extends CI_Model {

    public function construct() {
        parent::__construct();
        $this->load->database(); //con esto hacemos que pueda cargar nuestra base de datos con el modelo
    }

    public function login($username, $password) {
        try {
            $this->load->model();
            $this->db->where('NombreUsuario', $username);
            $this->db->where('ContraseniaUsuario', $password);
            $q = $this->db->get('Usuarios');
            if ($q->num_rows() > 0) {
                return true;   
            } else {
                return false;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
