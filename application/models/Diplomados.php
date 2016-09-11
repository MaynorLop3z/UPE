<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Diplomados extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function listarModulosByDiplomado($codigoDiplomado=null) {
        $this->db->select('NombreModulo, '
                .'OrdenModulo,'
                . 'Comentarios');
        $this->db->from('Modulos');
        $this->db->order_by("OrdenModulo", "asc");
        $this->db->where('CodigoDiplomado', $codigoDiplomado);
        //$this->db->where('Estado', TRUE); // Aqui puse esto 
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }
    
     public function listarDiplomadosNombre($filtro) {
        $this->db->select('D.CodigoDiplomado, '
                . 'D.NombreDiplomado,'
                . 'D.Descripcion, '
                . 'D.Estado, '
                . 'D.CodigoCategoriaDiplomado, '
                . 'D.Comentarios, '
                . 'CD.NombreCategoriaDiplomado');
        $this->db->from('Diplomados D');
        $this->db->join("CategoriaDiplomados CD","D.CodigoCategoriaDiplomado = CD.CodigoCategoriaDiplomado");
        $this->db->like('LOWER("NombreDiplomado")', strtolower($filtro));
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }
    public function listarDiplomados() {
        try {
            $consulta = $this->db->query('SELECT "d"."CodigoDiplomado", "d"."NombreDiplomado", "d"."Descripcion", "d"."Estado", "cd"."NombreCategoriaDiplomado", "d"."Comentarios" FROM "Diplomados" "d" JOIN "CategoriaDiplomados" "cd" ON "d"."CodigoCategoriaDiplomado" = "cd"."CodigoCategoriaDiplomado" WHERE "d"."Estado" = TRUE');
            // $consulta = $this->db->query('SELECT d.CodigoDiplomado FROM Diplomados d');
            if ($consulta != null) {
                $resultado = $consulta->result();
            } else {
                
            }
            return $resultado;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
//        $this->db->select('CodigoDiplomado,'
//                . 'NombreDiplomado'
//                . 'Descripcion,'
//                . 'Estado,'
//                . 'CodigoCategoraDiplomado,'
//                . 'Comentarios');
//        $this->db->from('Diplomados');
//        $this->db->where('Estado', TRUE);
//        $consultaD = $this->db->get();
//        $resultadoD = $consultaD->result();
//        return $resultadoD;
    }
    
    public function listarDiplomadosLimited($limit, $offset) {
        try {
            if ($limit == null && $offset == null) {
                $limit = ROWS_PER_PAGE;
                $offset = 0;
            }
            $consulta = $this->db->query('SELECT "d"."CodigoDiplomado", '
                    . '"d"."NombreDiplomado", "d"."Descripcion", "d"."Estado", '
                    . '"cd"."NombreCategoriaDiplomado", "d"."Comentarios" '
                    . 'FROM "Diplomados" "d" JOIN "CategoriaDiplomados" "cd" '
                    . 'ON "d"."CodigoCategoriaDiplomado" = "cd"."CodigoCategoriaDiplomado" '
                    . 'WHERE "d"."Estado" = TRUE '
                    . 'LIMIT '. $limit . ' OFFSET ' . $offset . ';');
            if ($consulta != null) {
                $resultado = $consulta->result();
            } else {
                
            }
            return $resultado;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }
    
    public function listarModulos($codigoDiplomado) {
        $this->db->select('CodigoModulo, '
                . 'NombreModulo, '
                . 'OrdenModulo, '
                . 'Estado, '
                . 'CodigoDiplomado, '
                . 'CodigoTurno, '
                . 'Comentarios'
        );
        $this->db->from('Modulos');
        $this->db->where('CodigoDiplomado', $codigoDiplomado);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }
    public function listarPeriodosByModuloLimited($idModulo, $offset) {
        if ($offset == null) {
               $offset = 0;
            }
        $limit = ROWS_PER_PAGE;
        $this->db->select('CodigoPeriodo, '
                . 'FechaInicioPeriodo, '
                . 'FechaFinPeriodo, '
                . 'Estado, '
                . 'Comentario, '
                . 'CodigoModulo'
        );
        $this->db->from('Periodos');
        $this->db->where('CodigoModulo', $idModulo);
        $this->db->limit($limit, $offset);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }
    public function listarPeriodosByModulo($idModulo) {
        $this->db->select('CodigoPeriodo, '
                . 'FechaInicioPeriodo, '
                . 'FechaFinPeriodo, '
                . 'Estado, '
                . 'Comentario, '
                . 'CodigoModulo'
        );
        $this->db->from('Periodos');
        $this->db->where('CodigoModulo', $idModulo);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }
    public function listarDiplomadosCategoria($idCategoria) {
        $this->db->select('CodigoDiplomado,' . 'NombreDiplomado');
        $this->db->from('Diplomados');
        $this->db->where('CodigoCategoriaDiplomado', $idCategoria);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }
    public function crearDiplomado($NombreDiplomado, $Descripcion, $Estado, $CodigoCategoriaDiplomado, $Comentarios,$IpUserModifica,$UserModifica) {
        try {
            $data = array(
                'NombreDiplomado' => $NombreDiplomado,
                'Descripcion' => $Descripcion,
                'Estado' => $Estado,
                'CodigoCategoriaDiplomado' => $CodigoCategoriaDiplomado,
                'Comentarios' => $Comentarios,
                'UsuarioModifica'=>$UserModifica,
                'IpModifica'=>$IpUserModifica,
                'FechaModifica'=>date("Y/m/d"), 
                
                
            );
            //$this->db->insert('Modulos', $data
            $this->db->insert('Diplomados', $data);
            $insert_id = $this->db->insert_id();
            $data['CodigoDiplomado'] = $insert_id; //Acabo de quitarle una s 
        } catch (Exception $exe) {
            $exe->getMessage();
        }
        return $data;
    }
    public function EliminarDiplomado($CodigoDiplomado) {
        $eliminar = false;
        try {
            $this->db->delete('Diplomados', array('CodigoDiplomado' => $CodigoDiplomado));
            if ($this->db->affected_rows() == 1) {
                $eliminar = true;
            }
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        return $eliminar;
    }
    public function ModificarDiplomado($CodigoDiplomado, $NombreDiplomado, $Descripcion, $Estado, $CodigoCategoriaDiplomado, $Comentarios,$IPModifica,$UsuarioModifica) {
        try {
            $data = array(
                'NombreDiplomado' => $NombreDiplomado,
                'Descripcion' => $Descripcion,
                'Estado' => $Estado,
                'CodigoCategoriaDiplomado' => $CodigoCategoriaDiplomado,
                'Comentarios' => $Comentarios,
                'UsuarioModifica' => $UsuarioModifica,
                'IpModifica' => $IPModifica,
                'FechaModifica' => date("Y/m/d"),
            );
            $this->db->where('CodigoDiplomado', $CodigoDiplomado);
            $this->db->update('Diplomados', $data);
            $data['CodigoDiplomado'] = $CodigoDiplomado;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        return $data;
    }
//Funcion para encontrar los diplomados Arreglarlo 
    // public function buscarDiplomado($CodigoDiplomado){
    //   $this->db->select('CodigoDiplomado,NombreDiplomado,Descripcion,Estado,Comentarios');
    // $this->db->from('NombreDiplomado');
    //$this->db->where('NombreDiplomado',$id);
    // $consultaDiplomado = $this->db->get();
    //$resultadoDiplomado = $consultaDiplomado->row();
    //return $resultadoDiplomado;
    // }
    public function EliminarDiplomados($CodigoDiplomado) {  //
        $this->db->delete('Diplomados', array('CodigoDiplomado' => $CodigoDiplomado));
    }
    public function inactivarDiplomado($CodigoDiplomado) {
        try {
            $data = array(
                'Estado' => FALSE,
//                'UsuarioModifica'=>$usuarioModifica,
//                'IpModifica' =>$ipModifica,
//                'FechaModifica' =>date("Y/m/d")
            );
            $this->db->where('CodigoDiplomado', $CodigoDiplomado);
            $this->db->update('Diplomados', $data);
            $data['CodigoDiplomado'] = $CodigoDiplomado;
            return $data;
        } catch (Exception $exc) {
            $exc->getMessage();
        }
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
    //    public function listarDiplomados() {
//      $query =  $this->db->query("SELECT d.CodigoDiplomado, d.NombreDiplomado, d.Descripcion, d.Estado, cd.NombreCategoriaDiplomado, d.Comentarios FROM Diplomados d JOIN CategoriaDiplomados cd ON d.CodigoCategoriaDiplomado = cd.CodigoCategoriaDiplomado") ;
//        $resultado =  $query->result();
//        echo "Talcosa";
//        return $resultado;
//        
//    }
//    public function listarDiplomados() {
//        $this->db->select('CodigoDiplomado, '
//                . 'NombreDiplomado, '
//                . 'Descripcion, '
//                . 'Estado, '
//                . 'CodigoCategoriaDiplomado,'
//                . 'Comentarios'
//                
//                
//        );
//        $this->db->from('Diplomados');
//        $consulta = $this->db->get();
//        $resultado = $consulta->result();
//        return $resultado;
//    }
    
    //FUNCIONES PARA PAGINACION DE PERIODOS
    public function countAllPeriodos($di) {
//        $num_rows = $this->db->count_all_results('Periodos');
        $num_rows = count($this->listarPeriodosByModulo($di));
        return $num_rows;
    }
}