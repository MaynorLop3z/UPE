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
                . 'Comentarios');
        $this->db->from('Participantes');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function CrearParticipante($Nombre, $CorreoElectronico, $TelefonoFijo, $TelefonoCelular, $Direccion, $FechaNacimiento, $CodigoCategoriaParticipantes, $NumeroDUI, $CodigoUniversidadProcedencia, $Carrera, $NivelAcademico, $NombreEncargado, $Descripcion, $Comentarios) {
        $data = array(
//            'CodigoPermisos' => null,
            'Nombre' => $Nombre,
            'CorreoElectronico' => $CorreoElectronico,
            'TelefonoFijo' => $TelefonoFijo,
            'TelefonoCelular' => $TelefonoCelular,
            'FechaNacimiento' => $FechaNacimiento,
            'Direccion' => $Direccion,
            'NumeroDUI' => $NumeroDUI,
            'CodigoUniversidadProcedencia' => $CodigoUniversidadProcedencia,
            'Carrera' => $Carrera,
            'NivelAcademico' => $NivelAcademico,
            'NombreEncargado' => $NombreEncargado,
            'Descripcion' => $Descripcion,
            'CodigoCategoriaParticipantes' => $CodigoCategoriaParticipantes,
            'Comentarios' => $Comentarios,
        );
        if ($this->db->insert('Participantes', $data)){return true;
        } else {
            return false;
        }
        
    }

    public function EliminarParticipante($CodigoParticipante) {
        $this->db->delete('Participantes', array('CodigoParticipante' => $CodigoParticipante));
    }
//me dio error al crear un procedimiento con mas de 20 lineas $CodigoUniversidadProcedencia = null,
    public function ModificarParticipante($CodigoParticipante, $Nombre, $CorreoElectronico, $TelefonoFijo, $TelefonoCelular, $Direccion, $FechaNacimiento, $CodigoCategoriaParticipantes, $UsuarioModifica, $IPModifica, $FechaModifica, $NumeroDUI = null, $Carrera = null, $NivelAcademico = null, $NombreEncargado = null, $Comentarios=null,$Descripcion = null) {
        $data = array(
            'Nombre' => $Nombre,
            'CorreoElectronico' => $CorreoElectronico,
            'TelefonoFijo' => $TelefonoFijo,
            'TelefonoCelular' => $TelefonoCelular,
            'FechaNacimiento' => $FechaNacimiento,
            'Direccion' => $Direccion,
            'NumeroDUI' => $NumeroDUI,
            'Carrera' => $Carrera,
            'NivelAcademico' => $NivelAcademico,
            'NombreEncargado' => $NombreEncargado,
            'Descripcion' => $Descripcion,
            'CodigoCategoriaParticipantes' => $CodigoCategoriaParticipantes,
            'UsuarioModifica' => $UsuarioModifica,
            'IPModifica' => $IPModifica,
            'FechaModifica' => $FechaModifica,
            'Comentarios' => $Comentarios
        );
        $this->db->where('CodigoParticipante', $CodigoParticipante);
        $this->db->update('Participantes', $data);
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
