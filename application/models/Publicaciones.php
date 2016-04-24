<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//include('ModeloBase.php');
class Publicaciones extends CI_Model {

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
        $this->db->order_by("FechaPublicacion","desc");
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function listarPublicacionesUsuario($UsuarioPublica) {
        $this->db->select('CodigoPublicacion, '
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
        $this->db->where('UsuarioPublica', $UsuarioPublica);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function listarPublicacionesGrupoPeriodo($CodigoGrupoPeriodo) {
        $this->db->select('CodigoPublicacion, '
                . 'UsuarioPublica, '
                . 'FechaPublicacion, '
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
                . 'FechaPublicacion, '
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
                . 'FechaPublicacion, '
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

    public function CrearPublicacion($UsuarioPublica, $FechaPublicacion, $Titulo, $Contenido, $Estado, $CodigoGrupoPeriodo, $CodigoGrupoPeriodoUsuario, $CodigoGrupoParticipantes, $CodigoTipoPublicacion, $ParticipantePublica) {
        $data = array(
            'UsuarioPublica' => $UsuarioPublica,
            'FechaPublicacion' => $FechaPublicacion,
            'Titulo' => $Titulo,
            'Contenido' => $Contenido,
            'ParticipantePublica' => $ParticipantePublica,
            'Estado' => $Estado,
            'CodigoGrupoPeriodo' => $CodigoGrupoPeriodo,
            'CodigoGrupoPeriodoUsuario' => $CodigoGrupoPeriodoUsuario,
            'CodigoGrupoParticipantes' => $CodigoGrupoParticipantes,
            'CodigoTipoPublicacion' => $CodigoTipoPublicacion
        );
        $this->db->insert('Publicaciones', $data);
        $insert_id = $this->db->insert_id();
        $data['CodigoPublicacion'] = $insert_id;

        return $data;
    }

    public function EliminarPublicacion($CodigoPublicacion) {
        $this->db->delete('Publicaciones', array('CodigoPublicacion' => $CodigoPublicacion));
        //Hay que verificar si existen publicaciones de ser asi no eliminar o cambiar a una
        //por defecto
    }

    public function ModificarPublicacion($CodigoPublicacion, $UsuarioPublica, $FechaPublicacion, $Titulo, $Contenido, $Estado, $CodigoCodigoGrupoPeriodo, $CodigoGrupoPeriodoUsuario, $GrupoParticipantes, $CodigoTipoPublicacion, $ParticipantePublica = null) {
        $data = array(
            'UsuarioPublica' => $UsuarioPublica,
            'FechaPublicacion' => $FechaPublicacion,
            'Titulo' => $Titulo,
            'Contenido' => $Contenido,
            'ParticipantePublica' => $ParticipantePublica,
            'Estado' => $Estado,
            'CodigoGrupoPeriodo' => $CodigoCodigoGrupoPeriodo,
            'CodigoGrupoPeriodoUsuario' => $CodigoGrupoPeriodoUsuario,
            'GrupoParticipantes' => $GrupoParticipantes,
            'CodigoTipoPublicacion' => $CodigoTipoPublicacion
        );
        $this->db->where('CodigoPublicacion', $CodigoPublicacion);
        $this->db->update('Publicaciones', $data);
    }

    public function CrearArchivo($Ruta, $Nombre, $Extension, $Estado, $CodigoUsuarios, $CodigoPublicaciones, $UsuarioModifica, $IpModifica, $FechaModifica) {
        $data = array(
            //            'CodigoArchivos' => null,
            'Nombre' => $Nombre,
            'Ruta' => $Ruta,
            'Extension' => $Extension,
            'CodigoUsuarios' => $CodigoUsuarios,
            'CodigoPublicaciones' => $CodigoPublicaciones,
            'Estado' => $Estado,
            'UsuarioModifica' => $UsuarioModifica,
            'IpModifica' => $IpModifica,
            'FechaModifica' => $FechaModifica
        );
        $this->db->insert('Archivos', $data);
    }

    public function MostrarDatosPublicacion($id) {
        try {
            $stringQuery = 'SELECT "Publicaciones"."CodigoPublicacion","Publicaciones"."Titulo","Publicaciones"."Contenido","Publicaciones"."FechaPublicacion","Archivos"."Ruta" FROM public."Publicaciones",public."Archivos" WHERE "Publicaciones"."CodigoPublicacion" = "Archivos"."CodigoPublicaciones" AND "Publicaciones"."CodigoPublicacion" =';
            $stringQuery = $stringQuery . $id;
            $consulta = $this->db->query($stringQuery);
            if ($consulta != null) {
                $resultado = $consulta->result();
            } else {
                
            }
            return $resultado;
        } catch (Exception $e) {
            echo $e->getTraceAsString();
        }
    }

}

?>
