<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Verificar_model extends CI_Model {

    public function construct() {
        parent::__construct();
        $this->load->database(); //con esto hacemos que pueda cargar nuestra base de datos con el modelo
    }

    function verificar($nom, $pass) {
        $this->db->where('NombreUsuario', $nom);
        $this->db->where('ContraseniaUsuario', $pass);
        $query = $this->db->get('Usuarios');

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
             header('Location: /application/controllers/verificar.php');
        }
    }

}
