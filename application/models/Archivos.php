<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//include('ModeloBase.php');
class Archivos extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarTodos(){
        $this->db->select('Nombre, Ruta');
        $this->db->from('Archivos');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
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

    public function listarArchivosUsuario($CodigoUsuarios) {
        $this->db->select('CodigoArchivos, '
                . 'Ruta, '
                . 'Nombre, '
                . 'Extension, '
                . 'Estado, '
                . 'CodigoPublicaciones'
        );
        $this->db->from('Archivos');
        $this->db->where('CodigoUsuarios', $CodigoUsuarios);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
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

    public function EliminarArchivo($CodigoArchivos) {
        $this->db->delete('Archivos', array('CodigoArchivos' => $CodigoArchivos));
    }

    public function EliminarArchivosPublicacion($CodigoPublicaciones) {
        $this->db->delete('Archivos', array('CodigoPublicaciones' => $CodigoPublicaciones));
    }

    public function EliminarArchivosUsuario($CodigoUsuarios) {
        $this->db->delete('Archivos', array('CodigoUsuarios' => $CodigoUsuarios));
    }

    public function ModificarArchivo($CodigoArchivos, $Ruta, $Nombre, $Extension, $Estado, $UsuarioModifica, $IPModifica, $FechaModifica) {
        $data = array(
            'Ruta' => $Ruta,
            'Nombre' => $Nombre,
            'Extension' => $Extension,
            'Estado' => $Estado,
            'UsuarioModifica' => $UsuarioModifica,
            'IPModifica' => $IPModifica,
            'FechaModifica' => $FechaModifica
        );
        $this->db->where('CodigoArchivos', $CodigoArchivos);
        $this->db->update('Archivos', $data);
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
                            "Periodos"."FechaFinPeriodo",
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
                           
                           "Periodos"."FechaInicioPeriodo" DESC;  
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

        public function listarArchivosPorGrupoAlumno($grupo){
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
                        "Archivos"."Nombre"
                        
                 FROM   
                         public."CategoriaDiplomados", 
                         public."Publicaciones",
                         public."Archivos"
                 WHERE  	
                         
                         "Publicaciones"."CodigoGrupoPeriodo" = '.$grupo.'

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
        
        public function listarArchivosPorGrupoAlumnoLimited($grupo, $limit, $offset){
            if ($limit == null && $offset == null) {
                $limit = ROWS_PER_PAGE;
                $offset = 0;
            }
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
                        "Archivos"."Nombre"
                        
                 FROM   
                         public."CategoriaDiplomados", 
                         public."Publicaciones",
                         public."Archivos"
                 WHERE  	
                         
                         "Publicaciones"."CodigoGrupoPeriodo" = '.$grupo.'

                 AND    
                         "Publicaciones"."CodigoTipoPublicacion" = '.TIPO_PUBLICACION_GRUPO.'
                 
                 AND
                         "Publicaciones"."Estado" = TRUE
                 
                 AND
                        "CategoriaDiplomados"."CodigoCategoriaDiplomado"  = public."Publicaciones"."CodigoCategoriaDiplomado"
          
                 AND
                        "Archivos"."CodigoPublicaciones" = public."Publicaciones"."CodigoPublicacion"

                 ORDER BY
                           "Publicaciones"."FechaPublicacion" DESC
                           
                  LIMIT '. $limit . ' OFFSET ' . $offset . '; ');
            
           $resultado = $consulta->result();
           return $resultado;
        }

}
