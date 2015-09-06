<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include('ModeloBase.php');
class Publicaciones extends ModeloBase {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarPublicaciones() {
        $this->db->select('CodigoPublicacion, '
                . 'UsuarioPublica, '
                . 'FechaPublicacion, '
                . 'Titulo, '
                . 'Contenido, '
                . 'ParticipantePublica, '
                . 'Estado, '
                . 'CodigoGrupoPeriodo, '
                . 'CodigoGrupoParticipantes, '
                . 'CodigoGrupoPeriodoUsuario, '
                . 'CodigoTipoPublicacion'
        );
        $this->db->from('Publicaciones');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function listarPublicacionesUsuario($UsuarioPublica) {
        $this->db->select('CodigoPublicacion, '
                . 'FechaPublica, '
                . 'Titulo, '
                . 'Contenido, '
                . 'ParticipantePublica, '
                . 'Estado, '
                . 'CodigoGrupoPeriodo, '
                . 'CodigoGrupoParticipantes, '
                . 'CodigoGrupoPeriodoUsuario, '
                . 'CodigoTipoPublicacion'
        );
        $this->db->from('Publicaciones');
        $this->db->where('UsuarioPublica', $UsuarioPublica);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function listarPublicacionesGrupoPeriodo($CodigoGrupoPeriodo) {
        $this->db->select('CodigoPublicacion, '
                . 'UsuarioPublica, '
                . 'FechaPublica, '
                . 'Titulo, '
                . 'Contenido, '
                . 'ParticipantePublica, '
                . 'Estado, '
                . 'CodigoGrupoParticipantes, '
                . 'CodigoGrupoPeriodoUsuario, '
                . 'CodigoTipoPublicacion'
        );
        $this->db->from('Publicaciones');
        $this->db->where('CodigoGrupoPeriodo', $CodigoGrupoPeriodo);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function listarPublicacionesGrupoParticipantes($GrupoParticipantes) {
        $this->db->select('CodigoPublicacion, '
                . 'UsuarioPublica, '
                . 'FechaPublica, '
                . 'Titulo, '
                . 'Contenido, '
                . 'ParticipantePublica, '
                . 'Estado, '
                . 'CodigoCodigoGrupoPeriodo, '
                . 'CodigoGrupoPeriodoUsuario, '
                . 'CodigoTipoPublicacion'
        );
        $this->db->from('Publicaciones');
        $this->db->where('CodigoGrupoParticipantes', $GrupoParticipantes);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function listarPublicacionesTipoPublicacion($CodigoTipoPublicacion) {
        $this->db->select('CodigoPublicacion, '
                . 'UsuarioPublica, '
                . 'FechaPublica, '
                . 'Titulo, '
                . 'Contenido, '
                . 'ParticipantePublica, '
                . 'Estado, '
                . 'CodigoCodigoGrupoPeriodo, '
                . 'CodigoGrupoPeriodoUsuario, '
                . 'GrupoParticipantes'
        );
        $this->db->from('Publicaciones');
        $this->db->where('CodigoTipoPublicacion', $CodigoTipoPublicacion);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function CrearPublicacion($UsuarioPublica, $FechaPublica, $Titulo, $Contenido, $Estado, $CodigoCodigoGrupoPeriodo, $CodigoGrupoPeriodoUsuario, $GrupoParticipantes, $CodigoTipoPublicacion, $ParticipantePublica = null) {
        $data = array(
            'UsuarioPublica' => $UsuarioPublica,
            'FechaPublica' => $FechaPublica,
            'Titulo' => $Titulo,
            'Contenido' => $Contenido,
            'ParticipantePublica' => $ParticipantePublica,
            'Estado' => $Estado,
            'CodigoCodigoGrupoPeriodo' => $CodigoCodigoGrupoPeriodo,
            'CodigoGrupoPeriodoUsuario' => $CodigoGrupoPeriodoUsuario,
            'GrupoParticipantes' => $GrupoParticipantes,
            'CodigoTipoPublicacion' => $CodigoTipoPublicacion
        );
        $this->db->insert('Publicaciones', $data);
    }


    public function EliminarPublicacion($CodigoPublicacion) {
        $this->db->delete('Publicaciones', array('CodigoPublicacion' => $CodigoPublicacion));
        //Hay que verificar si existen publicaciones de ser asi no eliminar o cambiar a una
        //por defecto
    }

    public function ModificarPublicacion($CodigoPublicacion, $UsuarioPublica, $FechaPublica, $Titulo, $Contenido, $Estado, $CodigoCodigoGrupoPeriodo, $CodigoGrupoPeriodoUsuario, $GrupoParticipantes, $CodigoTipoPublicacion, $ParticipantePublica = null) {
        $data = array(
            'UsuarioPublica' => $UsuarioPublica,
            'FechaPublica' => $FechaPublica,
            'Titulo' => $Titulo,
            'Contenido' => $Contenido,
            'ParticipantePublica' => $ParticipantePublica,
            'Estado' => $Estado,
            'CodigoCodigoGrupoPeriodo' => $CodigoCodigoGrupoPeriodo,
            'CodigoGrupoPeriodoUsuario' => $CodigoGrupoPeriodoUsuario,
            'GrupoParticipantes' => $GrupoParticipantes,
            'CodigoTipoPublicacion' => $CodigoTipoPublicacion
        );
        $this->db->where('CodigoPublicacion', $CodigoPublicacion);
        $this->db->update('Publicaciones', $data);
    }
}
