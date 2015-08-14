<?php

class Permisos extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarPermisos() {
        $this->db->select('CodigoPermisos, NombrePermiso, EstadoPermisos');
        $this->db->from('Permisos');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function CrearPermisos($NombrePermiso, $EstadoPermisos) {
        $data = array(
//            'CodigoPermisos' => null,
            'NombrePermiso' => $NombrePermiso,
            'EstadoPermisos' => $EstadoPermisos
//            'UsuarioModifica' => null,
//            'IPModifica' => null,
//            'FechaModifica' => null
        );
        $this->db->insert('Permisos', $data);
    }

    public function EliminarPermisos($CodigoPermisos) {
        $this->db->delete('Permisos', array('CodigoPermisos' => $CodigoPermisos));
        $this->db->delete('RolesPermisos', array('CodigoPermisos' => $CodigoPermisos));
    }

    public function ModificarPermisos($CodigoPermisos, $NombrePermiso, $EstadoPermiso, $UsuarioModifica, $IPModifica, $FechaModifica) {
        $data = array(
            'NombrePermiso' => $NombrePermiso,
            'EstadoPermiso' => $EstadoPermiso,
            'UsuarioModifica' => $UsuarioModifica,
            'IPModifica' => $IPModifica,
            'FechaModifica' => $FechaModifica
        );

        $this->db->where('CodigoPermisos', $CodigoPermisos);
        $this->db->update('Permisos', $data);
    }

}
