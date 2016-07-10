<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

//include('ModeloBase.php');
class Participantes extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarParticipantes() {
        $this->db->select('T0.CodigoParticipante, '
                . 'T0.CorreoElectronico, '
                . 'T0.TelefonoFijo, '
                . 'T0.TelefonoCelular, '
                . 'T0.Direccion, '
                . 'T0.NumeroDUI, '
                . 'T0.Nombre, '
                . 'T0.FechaNacimiento, '
                . 'T0.CodigoUniversidadProcedencia, '
                . 'T0.Carrera, '
                . 'T0.NivelAcademico, '
                . 'T0.NombreEncargado, '
                . 'T0.Descripcion, '
                . 'T0.CodigoCategoriaParticipantes, '
                . 'T0.Comentarios, '
                . 'T0.Genero, '
                . 'T1.NombreCategoriaParticipante');
        $this->db->from('Participantes T0');
        $this->db->join("CategoriasParticipante T1","T0.CodigoCategoriaParticipantes = T1.CodigoCategoriaParticipantes");
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }
    public function listarDiplomados() {
        $this->db->select('CodigoDiplomado,' . 'NombreDiplomado');
        $this->db->from('Diplomados');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }
    public function listarGruposPeriodos($idDiplomado,$idParticipante) {
        try {
            $consulta = $this->db->query('select * from getgruposactualesbyalumno('.$idDiplomado.', '.$idParticipante.')');
//            $consulta = $this->db->query('SELECT d.CodigoDiplomado FROM Diplomados d');
            if ($consulta != null) {
                $resultado = $consulta->result();
            } else {
                
            }

            return $resultado;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }
    public function inscribirParticipante( $grupoperiodo, $participante, $usuario) {
        try {
            $consulta = $this->db->query('SELECT agregaralumnogrupo('.$grupoperiodo.','.$participante.','.$usuario.') AS "Inscripcion"');
//            $consulta = $this->db->query('select * from getgruposactuales('.$idDiplomado.')');
//            $consulta = $this->db->query('SELECT d.CodigoDiplomado FROM Diplomados d');
            if ($consulta != null) {
                $resultado = $consulta->result();
            } else {
                
            }

            return $resultado;
        } catch (Exception $exc) {
            return $exc->getTraceAsString();
        }
    }
    public function listarParticipantesByName($filtro) {
        $this->db->select('CodigoParticipante, '
                . 'CorreoElectronico, '
                . 'TelefonoFijo, '
                . 'TelefonoCelular, '
                . 'Direccion, '
                . 'NumeroDUI, '
                . 'Nombre, '
                . 'FechaNacimiento, '
                . 'CodigoUniversidadProcedencia, '
                . 'Carrera, '
                . 'NivelAcademico, '
                . 'NombreEncargado, '
                . 'Descripcion, '
                . 'CodigoCategoriaParticipantes, '
                . 'Comentarios, '
                . 'Genero');
        $this->db->from('Participantes');
        $this->db->like('Nombre',$filtro);
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function CrearParticipante($Nombre, $CorreoElectronico, $TelefonoFijo, $TelefonoCelular, $Direccion, $FechaNacimiento, $CodigoCategoriaParticipantes, $NumeroDUI, $CodigoUniversidadProcedencia, $Carrera, $NivelAcademico, $NombreEncargado, $Descripcion, $Comentarios, $genero) {
        try {
            $data = array(
//            'CodigoPermisos' => null,
                'Nombre' => $Nombre, 'CorreoElectronico' => $CorreoElectronico,
                'TelefonoFijo' => $TelefonoFijo, 'TelefonoCelular' => $TelefonoCelular,
                'FechaNacimiento' => $FechaNacimiento, 'Direccion' => $Direccion,
                'NumeroDUI' => $NumeroDUI, 'CodigoUniversidadProcedencia' => $CodigoUniversidadProcedencia,
                'Carrera' => $Carrera,'NivelAcademico' => $NivelAcademico,
                'NombreEncargado' => $NombreEncargado,
                'Descripcion' => $Descripcion,
                'CodigoCategoriaParticipantes' => $CodigoCategoriaParticipantes,
                'Comentarios' => $Comentarios,
                'Genero' => $genero
            );
            $this->db->insert('Participantes', $data);
            $insert_id = $this->db->insert_id();
            $data['CodigoParticipante'] = $insert_id;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        return $data;
    }

    public function EliminarParticipante($CodigoParticipante) {
        $eliminado = false;
        try {
        $this->db->delete('Participantes', array('CodigoParticipante' => $CodigoParticipante));
        if ($this->db->affected_rows() == 1){
            $eliminado = true;
        }
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        return $eliminado;
    }

//me dio error al crear un procedimiento con mas de 20 lineas $CodigoUniversidadProcedencia = null,
    public function ModificarParticipante($CodigoParticipante, $Nombre, $CorreoElectronico, $TelefonoFijo, $TelefonoCelular, $Direccion, $FechaNacimiento, $CodigoCategoriaParticipantes, $UsuarioModifica, $IPModifica, $FechaModifica, $CodigoUniversidadProcedencia, $genero, $NumeroDUI = null, $Carrera = null, $NivelAcademico = null, $NombreEncargado = null, $Descripcion = null, $Comentarios = null) {
        try {
            $data = array(
                'Nombre' => $Nombre, 'CorreoElectronico' => $CorreoElectronico,
                'TelefonoFijo' => $TelefonoFijo, 'TelefonoCelular' => $TelefonoCelular,
                'FechaNacimiento' => $FechaNacimiento, 'Direccion' => $Direccion,
                'NumeroDUI' => $NumeroDUI, 'Carrera' => $Carrera,
                'CodigoUniversidadProcedencia' => $CodigoUniversidadProcedencia, 
                'NivelAcademico' => $NivelAcademico,'NombreEncargado' => $NombreEncargado, 
                'Descripcion' => $Descripcion, 'CodigoCategoriaParticipantes' => $CodigoCategoriaParticipantes,
                'UsuarioModifica' => $UsuarioModifica, 'IPModifica' => $IPModifica,
                'FechaModifica' => $FechaModifica, 'Comentarios' => $Comentarios, 'Descripcion'=> $Descripcion, 'Genero' => $genero
            );
            $this->db->where('CodigoParticipante', $CodigoParticipante);
            $this->db->update('Participantes', $data);
            $data['CodigoParticipante'] = $CodigoParticipante;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
        return $data;
    }

    public function listarCategoriasParticipante() {
        $this->db->select('CodigoCategoriaParticipantes, '
                . 'NombreCategoriaParticipante'
        );
        $this->db->from('CategoriasParticipante');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

}
