<?php

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
                . 'CodigoCategoriaParticipantes');
        $this->db->from('Participantes');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function CrearParticipante($Nombre, $CorreoElectronico, $TelefonoFijo, $TelefonoCelular, $Direccion, $FechaNacimiento, $CodigoCategoriaParticipantes, $NumeroDUI = null, $CodigoUniversidadProcedencia = null, $Carrera = null, $NivelAcademico = null, $NombreEncargado = null, $Descripcion = null) {
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
            'CodigoCategoriaParticipantes' => $CodigoCategoriaParticipantes
        );
        $this->db->insert('Participantes', $data);
    }

    public function EliminarParticipante($CodigoParticipante) {
        $this->db->delete('Participantes', array('CodigoParticipante' => $CodigoParticipante));
    }

    public function ModificarParticipante($CodigoParticipante, $Nombre, $CorreoElectronico, $TelefonoFijo, $TelefonoCelular, $Direccion, $FechaNacimiento, $CodigoCategoriaParticipantes, $UsuarioModifica, $IPModifica, $FechaModifica, $NumeroDUI = null, $CodigoUniversidadProcedencia = null, $Carrera = null, $NivelAcademico = null, $NombreEncargado = null, $Descripcion = null) {
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
            'UsuarioModifica' => $UsuarioModifica,
            'IPModifica' => $IPModifica,
            'FechaModifica' => $FechaModifica
        );
        $this->db->where('CodigoParticipante', $CodigoParticipante);
        $this->db->update('Participantes', $data);
    }
}
