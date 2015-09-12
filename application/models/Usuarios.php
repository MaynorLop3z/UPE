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

    public function guardar($titulo, $descripcion, $prioridad, $id = null) {
        $data = array(
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'prioridad' => $prioridad
        );
        if ($id) {
            $this->db->where('id', $id);
            $this->db->update('informes', $data);
        } else {
            $this->db->insert('informes', $data);
        }
    }

    public function eliminar($id) {
        $this->db->where('id', $id);
        $this->db->delete('informes');
    }

    public function obtener_por_id($id) {
        $this->db->select('id, titulo, descripcion, prioridad');
        $this->db->from('informes');
        $this->db->where('id', $id);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

}
