<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//Codigo de publicacion web =1 constante TIPO_PUBLICACION_WEB
//Codigo de publicacion grupo =2 constante TIPO_PUBLICACION_GRUPO
class Publicaciones extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarPublicaciones() {
        $consulta = $this->db->query('SELECT 
        "Publicaciones"."CodigoPublicacion", 
        "Publicaciones"."UsuarioPublica", 
        "Publicaciones"."FechaPublicacion", 
        "Publicaciones"."Titulo", 
        "Publicaciones"."Contenido", 
        "Publicaciones"."ParticipantePublica", 
        "Publicaciones"."Estado", 
        "Publicaciones"."CodigoGrupoPeriodo", 
        "Publicaciones"."CodigoGrupoParticipantes", 
        "Publicaciones"."CodigoGrupoPeriodoUsuario", 
        "Publicaciones"."CodigoTipoPublicacion", 
        "Publicaciones"."CodigoCategoriaDiplomado", 
        "CategoriaDiplomados"."NombreCategoriaDiplomado"
      FROM 
        public."CategoriaDiplomados", 
        public."Publicaciones"
      WHERE
      "CategoriaDiplomados"."CodigoCategoriaDiplomado"  = public."Publicaciones"."CodigoCategoriaDiplomado"   
      AND 
      "Publicaciones"."CodigoTipoPublicacion" =' . TIPO_PUBLICACION_WEB . '
      AND
      "Publicaciones"."Estado" = TRUE
      ORDER BY
      "Publicaciones"."FechaPublicacion" DESC; 
');
//        $this->db->from('Publicaciones');
//        $this->db->order_by("FechaPublicacion", "desc");

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
                . 'CodigoTipoPublicacion, '
                . 'CodigoCategoriaDiplomado'
        );
        $this->db->from('Publicaciones');
        $this->db->where('UsuarioPublica', $UsuarioPublica);
        $this->db->where('CodigoTipoPublicaciones', 1);
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
                . 'CodigoTipoPublicacion, '
                . 'CodigoCategoriaDiplomado'
        );
        $this->db->from('Publicaciones');
        $this->db->where('CodigoGrupoPeriodo', $CodigoGrupoPeriodo);
        $this->db->where('CodigoTipoPublicaciones', 1);
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
                . 'CodigoTipoPublicacion, '
                . 'CodigoCategoriaDiplomado'
        );
        $this->db->from('Publicaciones');
        $this->db->where('CodigoGrupoParticipantes', $GrupoParticipantes);
        $this->db->where('CodigoTipoPublicaciones', 1);
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
                . 'GrupoParticipantes, '
                . 'CodigoCategoriaDiplomado'
        );
        $this->db->from('Publicaciones');
        $this->db->where('CodigoTipoPublicacion', 1);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function CrearPublicacion($UsuarioPublica, $FechaPublicacion, $Titulo, $Contenido, $Estado, $CodigoGrupoPeriodo, $CodigoGrupoPeriodoUsuario, $CodigoGrupoParticipantes, $CodigoTipoPublicacion, $ParticipantePublica, $CodigoCategoriaDiplomado) {
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
            'CodigoTipoPublicacion' => $CodigoTipoPublicacion,
            'CodigoCategoriaDiplomado' => $CodigoCategoriaDiplomado
        );
        $this->db->insert('Publicaciones', $data);
        $insert_id = $this->db->insert_id();
        $data['CodigoPublicacion'] = $insert_id;

        return $data;
    }

    public function EliminarPublicacion($CodigoPublicacion) {//MODIFICA EL ESTADO DE LA PUBLICACION A FALSO
        //$this->db->delete('Publicaciones', array('CodigoPublicacion' => $CodigoPublicacion));
        try {
            $updateData = array("Estado" => "FALSE");
            $this->db->where("CodigoPublicacion", $CodigoPublicacion);
            $this->db->update("Publicaciones", $updateData);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function EliminarArchivosPublicacion($CodigoPublicaciones) {//ELIMINA EL ARCHIVO DE LA PUBLICACION ELIMINADA
        $this->db->delete('Archivos', array('CodigoPublicaciones' => $CodigoPublicaciones));
    }

    public function ObtenerRutaArchivo($CodigoPublicaciones) {//ruta de archivo por id
        $this->db->select('Ruta');
        $this->db->from('Archivos');
        $this->db->where('CodigoPublicaciones', $CodigoPublicaciones);
        $consulta = $this->db->get();
        $ret = $consulta->row();
        return $ret->Ruta;
    }

    public function obtenerDatosDePublicacionPorId($id) {//categoria, titulo y contenido por id
        $consulta = $this->db->query('SELECT "Ruta", "CodigoCategoriaDiplomado", "Titulo", "Contenido" 
                FROM "Publicaciones", "Archivos" WHERE 
                "CodigoPublicacion"="CodigoPublicaciones" AND "CodigoPublicaciones"=' . $id);
        $resultado = $consulta->row();
        return $resultado;
    }

    public function actualizaPublicacionWeb($id, $ruta, $titulo, $categoria, $contenido, $ext, $nom) {
        if ($nom != '' & $ext != '') {
            $consulta = $this->db->query('UPDATE "Archivos" SET "Ruta"=\'' . $ruta
                    . '\', "Nombre"=\'' . $nom . '\', "Extension"=\'' . $ext . '\' WHERE "CodigoPublicaciones"=' . $id);
        }
        $consulta = $this->db->query('UPDATE "Publicaciones" SET "Titulo"=\'' . $titulo
                . '\', "Contenido"=\'' . $contenido . '\', "CodigoCategoriaDiplomado"=' .
                $categoria . ' WHERE "CodigoPublicacion"=' . $id);
    }

    public function EliminarArchivo($CodigoArchivo) {
        $this->db->delete('Archivos', array('CodigoArchivos' => $CodigoArchivo));
    }

    public function ModificarPublicacion($CodigoPublicacion, $UsuarioPublica, $FechaPublicacion, $Titulo, $Contenido, $Estado, $CodigoCodigoGrupoPeriodo, $CodigoGrupoPeriodoUsuario, $GrupoParticipantes, $CodigoTipoPublicacion, $CodigoCategoriaDiplomado, $ParticipantePublica = null) {
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
            'CodigoTipoPublicacion' => $CodigoTipoPublicacion,
            'CodigoCategoriaDiplomado' => $CodigoCategoriaDiplomado
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

    public function listarArchivosPublicacion($CodigoPublicaciones) {
        $this->db->select('CodigoArchivos, '
                . 'Ruta, '
                . 'Nombre, '
                . 'Extension, '
                . 'Estado, '
                . 'CodigoUsuarios'
        );
        $this->db->from('Archivos');
        $this->db->where('CodigoPublicaciones', $CodigoPublicaciones);

        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function listarCategoriasDiplomados() {
        $this->db->select('CodigoCategoriaDiplomado, '
                . 'NombreCategoriaDiplomado, '
                . 'Estado, '
                . 'Comentarios'
        );
        $this->db->from('CategoriaDiplomados');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function MostrarDatosPublicacion($id) {
        try {
            $stringQuery = 'SELECT "Publicaciones"."CodigoPublicacion","Publicaciones"."Titulo","Publicaciones"."Contenido","Publicaciones"."FechaPublicacion", "Publicaciones"."CodigoCategoriaDiplomado","Archivos"."Ruta" FROM public."Publicaciones",public."Archivos" WHERE "Publicaciones"."CodigoPublicacion" = "Archivos"."CodigoPublicaciones" AND 
"Publicaciones"."CodigoTipoPublicacion" =' . TIPO_PUBLICACION_WEB . '';
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

    public function ListarPublicacionesPaginacion($offset) {
        try {
//            $this->db->select('CodigoPublicacion, UsuarioPublica, FechaPublicacion, Titulo, '
//                    . 'Contenido, ParticipantePublica, Estado,CodigoGrupoPeriodo, '
//                    . 'CodigoGrupoParticipantes, CodigoGrupoPeriodoUsuario, CodigoTipoPublicacion'
//            );
            if ($offset == null) {
                $limit = PUBLICACIONES_X_PAG;
                $offset = 0;
            }
            $limit = PUBLICACIONES_X_PAG;
            $varLimit = ' limit ' . $limit . ' offset ' . $offset;
            $stringQuery = 'SELECT "Publicaciones"."CodigoPublicacion",
                "Publicaciones"."Titulo","Publicaciones"."Contenido",
                "Publicaciones"."FechaPublicacion",
                "Publicaciones"."CodigoCategoriaDiplomado",
                "Archivos"."Ruta" FROM public."Publicaciones",
                public."Archivos" 
                WHERE "Publicaciones"."CodigoPublicacion" = "Archivos"."CodigoPublicaciones" 
                AND "Publicaciones"."Estado" = TRUE 
                AND "Publicaciones"."CodigoTipoPublicacion" =' . TIPO_PUBLICACION_WEB . ' ORDER BY "FechaPublicacion" desc';
            $stringQuery = $stringQuery . $varLimit;
            $consulta = $this->db->query($stringQuery);
            if ($consulta != null) {
                $resultado = $consulta->result();
            } else {
                
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $resultado;
    }

    public function listarPubliWebDashboard($limit, $offset) {
        try {

            if ($limit == null && $offset == null) {
                $limit = ROWS_PER_PAGE;
                $offset = 0;
            }
            $consulta = $this->db->query('SELECT 
                    "Publicaciones"."CodigoPublicacion", 
                    "Publicaciones"."UsuarioPublica", 
                    "Publicaciones"."FechaPublicacion", 
                    "Publicaciones"."Titulo", 
                    "Publicaciones"."Contenido", 
                    "Publicaciones"."ParticipantePublica", 
                    "Publicaciones"."Estado", 
                    "Publicaciones"."CodigoGrupoPeriodo", 
                    "Publicaciones"."CodigoGrupoParticipantes", 
                    "Publicaciones"."CodigoGrupoPeriodoUsuario", 
                    "Publicaciones"."CodigoTipoPublicacion", 
                    "Publicaciones"."CodigoCategoriaDiplomado", 
                    "CategoriaDiplomados"."NombreCategoriaDiplomado"
                  FROM 
                    public."CategoriaDiplomados", 
                    public."Publicaciones"
                  WHERE
                  "CategoriaDiplomados"."CodigoCategoriaDiplomado"  = public."Publicaciones"."CodigoCategoriaDiplomado"   
                  AND 
                  "Publicaciones"."CodigoTipoPublicacion" =' . TIPO_PUBLICACION_WEB . '
                  AND
                  "Publicaciones"."Estado" = TRUE
                  ORDER BY
                  "Publicaciones"."FechaPublicacion" DESC 
                   LIMIT ' . $limit . ' OFFSET ' . $offset . ';
            ');

            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $resultado;
    }

    public function ListarPublicacionesPaginacionCategoria($limit, $offset, $CodigoCategoriaDiplomado) {

        try {

            if ($limit == null && $offset == null) {
                $limit = PUBLICACIONES_X_PAG;
                $offset = 0;
            }
            $consulta = $this->db->query(' SELECT 
                "Publicaciones"."CodigoPublicacion", 
                "Publicaciones"."Titulo", 
                "Publicaciones"."Contenido", 
                "Publicaciones"."CodigoTipoPublicacion", 
                "Publicaciones"."CodigoCategoriaDiplomado", 
                "Publicaciones"."Estado", 
                "Archivos"."CodigoArchivos", 
                "Archivos"."Ruta", 
                "Archivos"."Nombre", 
                "Archivos"."Extension", 
                "Archivos"."Estado", 
                "Archivos"."CodigoPublicaciones"
              FROM 
                public."Publicaciones", 
                public."Archivos"
              WHERE 
                "Publicaciones"."CodigoTipoPublicacion" = ' . TIPO_PUBLICACION_WEB . ' AND 
                "Publicaciones"."CodigoCategoriaDiplomado" = ' . $CodigoCategoriaDiplomado . 'AND 
                "Publicaciones"."CodigoPublicacion" = "Archivos"."CodigoPublicaciones" AND 
                "Publicaciones"."Estado" = True
              ORDER BY
                "Publicaciones"."FechaPublicacion" ASC');
            $resultado = $consulta->result();
            return $resultado;
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $resultado;
    }

    ///PARA BUSQUEDA DE PUBLICACIONES EN DASHBOARD
    public function listarPublicacionesNombre($filtro1 = null, $filtro2 = null) {
        $query = 'SELECT 
                    "Publicaciones"."CodigoPublicacion", 
                    "Publicaciones"."UsuarioPublica", 
                    "Publicaciones"."FechaPublicacion", 
                    "Publicaciones"."Titulo", 
                    "Publicaciones"."Contenido", 
                    "Publicaciones"."ParticipantePublica", 
                    "Publicaciones"."Estado", 
                    "Publicaciones"."CodigoGrupoPeriodo", 
                    "Publicaciones"."CodigoGrupoParticipantes", 
                    "Publicaciones"."CodigoGrupoPeriodoUsuario", 
                    "Publicaciones"."CodigoTipoPublicacion", 
                    "Publicaciones"."CodigoCategoriaDiplomado", 
                    "CategoriaDiplomados"."NombreCategoriaDiplomado"
                  FROM 
                    public."CategoriaDiplomados", 
                    public."Publicaciones"
                  WHERE ';
        if ($filtro1 != null && $filtro2 != null) {
            $query.='LOWER("Titulo") LIKE \'%' . strtolower($filtro1) . '%\' ';
            $query.='AND LOWER("NombreCategoriaDiplomado") LIKE \'%' . strtolower($filtro2) . '%\' ';
        } else if ($filtro2 != null && $filtro1 == null) {
            $query.='LOWER("NombreCategoriaDiplomado") LIKE \'%' . strtolower($filtro2) . '%\' ';
        } else if ($filtro1 != null && $filtro2 == null) {
            $query.='LOWER("Titulo") LIKE \'%' . strtolower($filtro1) . '%\' ';
        }

        $query.=' AND
                  "CategoriaDiplomados"."CodigoCategoriaDiplomado"  = public."Publicaciones"."CodigoCategoriaDiplomado"   
                  AND 
                  "Publicaciones"."CodigoTipoPublicacion" =' . TIPO_PUBLICACION_WEB . '
                  AND
                  "Publicaciones"."Estado" = TRUE
                  ORDER BY
                  "Publicaciones"."FechaPublicacion" DESC
            ';
        $consulta = $this->db->query($query);

        $resultado = $consulta->result();
        return $resultado;
    }

    //listar pu por categoria 
    public function listarPublicacionesCategoria($categoria) {
        $consulta = $this->db->query('
            SELECT 
      "Publicaciones"."CodigoPublicacion", 
    "Publicaciones"."Titulo", 
    "Publicaciones"."ParticipantePublica", 
       "Publicaciones"."Contenido", 
    "Publicaciones"."CodigoTipoPublicacion", 
    "Publicaciones"."CodigoCategoriaDiplomado", 
    "Archivos"."Ruta", 
    "Archivos"."Nombre", 
    "Archivos"."Extension", 
    "Archivos"."CodigoPublicaciones", 
    "Archivos"."CodigoArchivos"
FROM 
    public."Archivos", 
    public."Publicaciones"
WHERE 
    "Publicaciones"."CodigoPublicacion" = "Archivos"."CodigoPublicaciones" AND 
    "Publicaciones"."Estado" = TRUE AND 
    "Publicaciones"."CodigoTipoPublicacion" =' . TIPO_PUBLICACION_WEB . ' AND 
  "Publicaciones"."CodigoCategoriaDiplomado" =' . $categoria . ';
            ');

        $resultado = $consulta->result();
        return $resultado;
    }

    //listar por fecha
    public function listarPublicacionesFecha($limit, $offset, $start, $end) {
        try {
            
        


        if ($limit == null && $offset == null) {
                $limit = PUBLICACIONES_X_PAG;
                $offset = 0;
            }
        $consulta = $this->db->query('
            SELECT 
  "Publicaciones"."CodigoPublicacion", 
  "Publicaciones"."FechaPublicacion", 
  "Publicaciones"."Titulo", 
  "Publicaciones"."Contenido", 
  "Publicaciones"."Estado", 
  "Publicaciones"."CodigoTipoPublicacion", 
  "Publicaciones"."CodigoCategoriaDiplomado", 
  "Archivos"."Ruta", 
  "Archivos"."Nombre", 
  "Archivos"."Extension", 
  "Archivos"."CodigoPublicaciones"
FROM 
  public."Publicaciones", 
  public."Archivos"
  WHERE 
  "Publicaciones"."CodigoPublicacion" = "Archivos"."CodigoPublicaciones" AND 
  "Publicaciones"."CodigoTipoPublicacion" ='. TIPO_PUBLICACION_WEB . ' AND 
  "Publicaciones"."Estado" = True AND 
  "Publicaciones"."FechaPublicacion"  BETWEEN '. $start .' AND '. $end.' ORDER BY 
                "Publicaciones"."FechaPublicacion" ASC
            ');

        $resultado = $consulta->result();
        return $resultado;
    
    } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }

}

  public function listarPublicacionesNames($nombre) {
        $consulta = $this->db->query('
            SELECT 
  "Archivos"."Nombre", 
  "Archivos"."Ruta", 
  "Archivos"."CodigoPublicaciones", 
  "Publicaciones"."CodigoPublicacion", 
  "Publicaciones"."Titulo", 
  "Publicaciones"."Contenido", 
  "Publicaciones"."Estado", 
  "Publicaciones"."CodigoTipoPublicacion"
FROM 
  public."Archivos",
  public."Publicaciones"
WHERE 
    "Publicaciones"."CodigoPublicacion" = "Archivos"."CodigoPublicaciones" AND 
    "Publicaciones"."Estado" = TRUE AND 
    "Publicaciones"."CodigoTipoPublicacion" =' . TIPO_PUBLICACION_WEB . ' AND 
        UPPER("Publicaciones"."Titulo") LIKE UPPER(\'%' . $nombre . '%\' '.')'

            );

        $resultado = $consulta->result();
        return $resultado;
    }


    }

?>
