<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//include('ModeloBase.php');
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
                . 'NombrePublica, HoraComentario, ComentarioPadre');
        $this->db->from('Comentarios');
        $this->db->where('CodigoPublicaciones', $CodigoPublicaciones);
        $this->db->where('Estado', TRUE);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }
    
    public function listarComentariosLimited($CodigoPublicaciones,$limit, $offset) {
        if ($limit == null && $offset == null) {
                $limit = COMMENTS_PER_PUB;
                $offset = 0;
            }
        $this->db->select('CodigoComentarios, '
                . 'FechaComentario, '
                . 'CorreoPublica, '
                . 'Cuerpo, '
                . 'NombrePublica, HoraComentario, ComentarioPadre');
        $this->db->from('Comentarios');
        $this->db->where('CodigoPublicaciones', $CodigoPublicaciones);
        $this->db->where('Estado', TRUE);
        $this->db->limit($limit, $offset);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function CrearComentarios($CodigoPublicaciones, $FechaComentario, $CorreoPublica, 
            $Cuerpo, $NombrePublica, $Estado, $ip, $idusr, $nivel, $time) {
        $user='ParticipanteComenta';
        if($nivel==1){$user='UsuarioComenta';}
        try{$data = array(
            'FechaComentario' => $FechaComentario,
            'CorreoPublica' => $CorreoPublica,
            'Cuerpo' => $Cuerpo,
            'NombrePublica' => $NombrePublica,
            'Estado' => $Estado,
            'CodigoPublicaciones' => $CodigoPublicaciones,
            'IpModifica' => $ip,
            $user => $idusr,
            'HoraComentario' => $time
        );
        $this->db->insert('Comentarios', $data);}
        catch (Exception $e){
            echo "error en el insert";
        }
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
