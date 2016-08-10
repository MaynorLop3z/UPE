<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//include('ModeloBase.php');

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

    public function CrearPublicacion($UsuarioPublica, $FechaPublicacion, $Titulo, $Contenido, $Estado,
                                    $CodigoGrupoPeriodo, $CodigoGrupoPeriodoUsuario, $CodigoGrupoParticipantes,
                                    $CodigoTipoPublicacion, $ParticipantePublica, $CodigoCategoriaDiplomado) {
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

    public function EliminarPublicacion($CodigoPublicacion) {
        //$this->db->delete('Publicaciones', array('CodigoPublicacion' => $CodigoPublicacion));
        try{
            $updateData=array("Estado"=>"FALSE");
            $this->db->where("CodigoPublicacion",$CodigoPublicacion);
            $this->db->update("Publicaciones",$updateData);
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function EliminarArchivosPublicacion($CodigoPublicaciones) {
        $this->db->delete('Archivos', array('CodigoPublicaciones' => $CodigoPublicaciones));
    }
    
    public function ObtenerRutaArchivo($CodigoPublicaciones) {
        $this->db->select('Ruta');
        $this->db->from('Archivos');
        $this->db->where('CodigoPublicaciones', $CodigoPublicaciones);
        $consulta = $this->db->get();
        $ret = $consulta->row();
        return $ret->Ruta;
    }

    public function EliminarArchivo($CodigoArchivo) {
        $this->db->delete('Archivos', array('CodigoArchivos' => $CodigoArchivo));
    }

    public function ModificarPublicacion($CodigoPublicacion, $UsuarioPublica, $FechaPublicacion, $Titulo, 
                                        $Contenido, $Estado, $CodigoCodigoGrupoPeriodo, $CodigoGrupoPeriodoUsuario, 
                                        $GrupoParticipantes, $CodigoTipoPublicacion, $CodigoCategoriaDiplomado, 
                                        $ParticipantePublica = null) {
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
            $stringQuery = 'SELECT "Publicaciones"."CodigoPublicacion","Publicaciones"."Titulo","Publicaciones"."Contenido","Publicaciones"."FechaPublicacion","Publicaciones"."CodigoCategoriaDiplomado","Archivos"."Ruta" FROM public."Publicaciones",public."Archivos" WHERE "Publicaciones"."CodigoPublicacion" = "Archivos"."CodigoPublicaciones"  AND "Publicaciones"."CodigoTipoPublicacion" ='.TIPO_PUBLICACION_WEB.' ORDER BY "FechaPublicacion" desc';
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

    
    

/****************************************************************************
 *                                                                          *
 *                        PARA LA TAB ARCHIVOS                              *
 *                      (Publicaciones de grupo)                            *
 *                                                                          *       
 *                                                                          *
 * *************************************************************************/

    public function listarPublicacionesParaArchivo() { //LISTA TODAS LAS PUBLICACIOONES DE GRUPO
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
            "CategoriaDiplomados"."NombreCategoriaDiplomado",
            "Archivos"."Extension"
          FROM 
            public."CategoriaDiplomados", 
            public."Publicaciones",
            public."Archivos"
          WHERE
          "CategoriaDiplomados"."CodigoCategoriaDiplomado"  = public."Publicaciones"."CodigoCategoriaDiplomado"
          AND
          "Archivos"."CodigoPublicaciones" = public."Publicaciones"."CodigoPublicacion"
          AND 
          "Publicaciones"."CodigoTipoPublicacion" ='.TIPO_PUBLICACION_GRUPO.' 
          ORDER BY
          "Publicaciones"."FechaPublicacion" DESC; 
          ');

           $resultado = $consulta->result();
           return $resultado;
       }

       public function GruposPorMaestro($codigo){ //LISTA LOS GRUPOS DEL MAESTRO POR SU $codigo
           $consulta= $this->db->query('SELECT DISTINCT
			"GruposMaestros"."CodigoGruposPeriodoUsuario",
                            "GruposMaestros"."CodigoGrupoPeriodo",
                            "CategoriaDiplomados"."NombreCategoriaDiplomado",
                            "CategoriaDiplomados"."CodigoCategoriaDiplomado",
                            "GrupoPeriodos"."CodigoPeriodo",
                            "Periodos"."CodigoModulo",
                            "Periodos"."FechaInicioPeriodo",
                            "Modulos"."NombreModulo",
                            "Diplomados"."NombreDiplomado"
                            
                    FROM
                            public."GruposMaestros", public."CategoriaDiplomados", 
                            public."Publicaciones", public."GrupoPeriodos",
                            public."Periodos", public."Modulos",
                            public."Diplomados"
                    WHERE
                            "GruposMaestros"."CodigoUsuario" = '.$codigo.'
                                
                    AND	
                            "GruposMaestros"."Estado" = 1

                    AND	
                            "GrupoPeriodos"."Estado" = TRUE

                    AND
			   public."GruposMaestros"."CodigoGrupoPeriodo" = public."GrupoPeriodos"."CodigoGrupoPeriodo"

		    AND 
			   public."Periodos"."CodigoPeriodo" = public."GrupoPeriodos"."CodigoPeriodo"

		    AND 
			   public."Modulos"."CodigoModulo" = public."Periodos"."CodigoModulo"

		    AND
			   public."Diplomados"."CodigoDiplomado" = public."Modulos"."CodigoDiplomado"
			                            
                    AND
			   "CategoriaDiplomados"."CodigoCategoriaDiplomado"  = public."Diplomados"."CodigoCategoriaDiplomado"
                           
                    ORDER BY
                           
                           public."GruposMaestros"."CodigoGruposPeriodoUsuario" DESC;  
                ');
           $resultado = $consulta->result();
           return $resultado;
       }
       
       public function ListarArchivosDelMaestro($codigo){ //LISTA LOS ARCHIVOS DEL MAESTRO
           $consulta= $this->db->query('SELECT DISTINCT "Publicaciones"."CodigoPublicacion",
                        "Publicaciones"."UsuarioPublica", 
                        "Publicaciones"."FechaPublicacion", 
                        "Publicaciones"."Titulo",
                        "Publicaciones"."Contenido",
                        "Publicaciones"."ParticipantePublica",
                        "Publicaciones"."Estado",
                        "Publicaciones"."CodigoGrupoPeriodo",
                        "Publicaciones"."CodigoGrupoPeriodoUsuario",
                        "Publicaciones"."CodigoTipoPublicacion",
                        "Publicaciones"."CodigoCategoriaDiplomado",
                        "CategoriaDiplomados"."NombreCategoriaDiplomado",
                        "Archivos"."Extension",
                        "Archivos"."Ruta",
                        "Archivos"."Nombre",
                        "GruposMaestros"."CodigoUsuario"
                        
                 FROM   
                         public."CategoriaDiplomados", 
                         public."Publicaciones",
                         public."Archivos",
                         public."GruposMaestros"
                 WHERE  	
                         "Publicaciones"."CodigoGrupoPeriodoUsuario" = public."GruposMaestros"."CodigoGruposPeriodoUsuario"

                 AND
                         "GruposMaestros"."CodigoUsuario" = '.$codigo.'
                 
                 AND
                         "Publicaciones"."Estado" = TRUE

                 AND    
                         "Publicaciones"."CodigoTipoPublicacion" = '.TIPO_PUBLICACION_GRUPO.'
                 
                 AND
                        "CategoriaDiplomados"."CodigoCategoriaDiplomado"  = public."Publicaciones"."CodigoCategoriaDiplomado"
          
                 AND
                        "Archivos"."CodigoPublicaciones" = public."Publicaciones"."CodigoPublicacion"

                 ORDER BY
                           "Publicaciones"."CodigoPublicacion" DESC; 
                            ');
           $resultado = $consulta->result();
           return $resultado;
       }
       
       public function ListarGruposAlumno($codigo){//LISTA LOS GRUPOS DEL ALUMNO POR SU $codigo
           $consulta= $this->db->query('SELECT DISTINCT
                            "GruposParticipantes"."CodigoGrupoPeriodo",
                            "GrupoPeriodos"."CodigoPeriodo",
                            "Periodos"."CodigoModulo",
                            "Periodos"."FechaInicioPeriodo",
                            "Modulos"."NombreModulo",
                            "Diplomados"."NombreDiplomado"
                            
                    FROM
                            public."GruposParticipantes", public."GrupoPeriodos",
                            public."Periodos", public."Modulos", public."Diplomados", public."CategoriaDiplomados"
                            
                    WHERE
                            "GruposParticipantes"."CodigoParticipante" = '.$codigo.'
                             
                    AND	
                            "GruposParticipantes"."CodigoEstadosParticipacion" = 1
                    
                    AND	
                            "GrupoPeriodos"."Estado" = TRUE

                    AND     
                            public."GrupoPeriodos"."CodigoGrupoPeriodo" = public."GruposParticipantes"."CodigoGrupoPeriodo"

                    AND 
			   public."Periodos"."CodigoPeriodo" = public."GrupoPeriodos"."CodigoPeriodo"

		    AND 
			   public."Modulos"."CodigoModulo" = public."Periodos"."CodigoModulo"

		    AND
			   public."Diplomados"."CodigoDiplomado" = public."Modulos"."CodigoDiplomado"
			                            
                    AND
			   "CategoriaDiplomados"."CodigoCategoriaDiplomado"  = public."Diplomados"."CodigoCategoriaDiplomado"
                           
                    ORDER BY
                           
                           "GruposParticipantes"."CodigoGrupoPeriodo" DESC;  
                ');
           $resultado = $consulta->result();
           return $resultado;
           
       }
       
       public function ListarArchivosParaAlumno($codigo){ //LISTA LOS ARCHIVOS DE LOS GRUṔOS DEL ALUMNO
           $consulta= $this->db->query('SELECT DISTINCT "Publicaciones"."CodigoPublicacion",
                        "Publicaciones"."UsuarioPublica", 
                        "Publicaciones"."FechaPublicacion", 
                        "Publicaciones"."Titulo",
                        "Publicaciones"."Contenido",
                        "Publicaciones"."ParticipantePublica",
                        "Publicaciones"."Estado",
                        "Publicaciones"."CodigoGrupoPeriodo",
                        "Publicaciones"."CodigoGrupoPeriodoUsuario",
                        "Publicaciones"."CodigoTipoPublicacion",
                        "Publicaciones"."CodigoCategoriaDiplomado",
                        "CategoriaDiplomados"."NombreCategoriaDiplomado",
                        "Archivos"."Extension",
                        "Archivos"."Ruta",
                        "Archivos"."Nombre",
                        "GruposParticipantes"."CodigoUsuario"
                        
                 FROM   
                         public."CategoriaDiplomados", 
                         public."Publicaciones",
                         public."Archivos",
                         public."GruposParticipantes"
                 WHERE  	
                         "Publicaciones"."CodigoGrupoPeriodo" = public."GruposParticipantes"."CodigoGrupoPeriodo"

                 AND
                         "GruposParticipantes"."CodigoUsuario" = '.$codigo.'

                 AND    
                         "Publicaciones"."CodigoTipoPublicacion" = '.TIPO_PUBLICACION_GRUPO.'
                 
                 AND
                         "Publicaciones"."Estado" = TRUE
                 
                 AND
                        "CategoriaDiplomados"."CodigoCategoriaDiplomado"  = public."Publicaciones"."CodigoCategoriaDiplomado"
          
                 AND
                        "Archivos"."CodigoPublicaciones" = public."Publicaciones"."CodigoPublicacion"

                 ORDER BY
                           "Publicaciones"."FechaPublicacion" DESC; ');
            
           $resultado = $consulta->result();
           return $resultado;
       }


    public function verificar_si_es_maestro($codigo, $nombre){
        $consulta = $this->db->query('SELECT COUNT(*) FROM public."Usuarios", public."UsuarioRoles"
                        WHERE "Usuarios"."CodigoUsuario" = '.$codigo.'
                        AND "Usuarios"."NombreUsuario" = '.$nombre.'
                        AND "Usuarios"."CodigoUsuario" = "UsuarioRoles"."CodigoUsuario"
                        AND "UsuarioRoles"."CodigoRol" = 4');
        $resultado = $consulta->result();
        return $resultado;
    }

    public function verificar_si_es_alumno($codigo, $carnet){
        $consulta = $this->db->query('SELECT COUNT(*) FROM public."Participantes"
                WHERE "Participantes"."CodigoParticipante" = '.$codigo.'
                AND "Participantes""CarnetAlumno" = '.$carnet.';');
        $resultado = $consulta->result();
        return $resultado;
    }
}
?>
