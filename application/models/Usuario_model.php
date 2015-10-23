<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//include './application/models/dto/UsuariosDTO.php';
//include('ModeloBase.php');
class Usuario_model extends CI_Model {
    public $salaries, $salaries2;
    public function construct() {
        parent::__construct();
        $this->load->database(); //con esto hacemos que pueda cargar nuestra base de datos con el modelo
        $salaries = model_load_model('dto/UsuariosDTO');
        $salaries2 = model_load_model('dto/UsuariosDTO');
    }

    public function login($username, $password) {
        try {
            //$this->load->model();
            $this->db->where('NombreUsuario', $username);
            $this->db->where('ContraseniaUsuario', $password);
            $q = $this->db->get('Usuarios');
            
            if ($q->num_rows() > 0) {
             $userLogin=$q->row();
                return $userLogin;   
                
            } else {
                return null;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
