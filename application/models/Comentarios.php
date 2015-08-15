<?php

class Comentarios extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarComentarios($CodigoPublicaciones) {
        $this->db->select('CodigoComentarios, '
                . 'FechaComentario, '
                . 'CorreoPublica, '
                . 'Cuerpo, '
                . 'NombrePublica, '
                . 'Estado');
        $this->db->from('Comentarios');
        $this->db->where('CodigoPublicaciones', $CodigoPublicaciones);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function CrearComentarios($CodigoPublicaciones, $FechaComentario, $CorreoPublica, $Cuerpo, $NombrePublica, $Estado) {
        $data = array(
            //            'CodigoComentarios' => null,
            'FechaComentario' => $FechaComentario,
            'CorreoPublica' => $CorreoPublica,
            'Cuerpo' => $Cuerpo,
            'NombrePublica' => $NombrePublica,
            'Estado' => $Estado,
            'CodigoPublicaciones' => $CodigoPublicaciones
        );
        $this->db->insert('Comentarios', $data);
    }

    public function EliminarComentario($CodigoComentarios) {
        $this->db->delete('Comentarios', array('CodigoComentarios' => $CodigoComentarios));
    }

    public function EliminarComentariosPublicacion($CodigoPublicaciones) {
        $this->db->delete('Comentarios', array('CodigoPublicaciones' => $CodigoPublicaciones));
    }

    public function ModificarComentarios($CodigoComentarios, $CodigoPublicaciones, $FechaComentario, $CorreoPublica, $Cuerpo, $NombrePublica, $Estado, $UsuarioModifica, $IPModifica, $FechaModifica) {
        $data = array(
            //            'CodigoComentarios' => null,
            'FechaComentario' => $FechaComentario,
            'CorreoPublica' => $CorreoPublica,
            'Cuerpo' => $Cuerpo,
            'NombrePublica' => $NombrePublica,
            'Estado' => $Estado,
            'CodigoPublicaciones' => $CodigoPublicaciones,
            'UsuarioModifica' => $UsuarioModifica,
            'IPModifica' => $IPModifica,
            'FechaModifica' => $FechaModifica
        );
        $this->db->where('CodigoComentarios', $CodigoComentarios);
        $this->db->update('Comentarios', $data);
    }

}
