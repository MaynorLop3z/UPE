<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//include('ModeloBase.php');

class Usuarios extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function listarUsuarios() {
        $this->db->select('CodigoUsuario, Nombre, CorreoUsuario, NombreUsuario');
        $this->db->from('Usuarios');
        $consulta = $this->db->get();
        $resultado = $consulta->result();
        return $resultado;
    }

    public function guardarUsuario($codigoUsuario = null, $nombreUsuario, $contraseniaUsuario, $nombrePersonaUsuario, $correo, $userModifica, $ipModifica) {
        try {
            $data = array(
                'NombreUsuario' => $nombreUsuario,
                'ContraseniaUsuario' => $contraseniaUsuario,
                'Nombre' => $nombrePersonaUsuario,
                'CorreoUsuario' => $correo,
                'FechaModifica' => date("Y/m/d"),
                'UsuarioModifica' => $userModifica,
                'IPModifica' => $ipModifica
            );
            $this->db->insert('Usuarios', $data);
            $insert_id = $this->db->insert_id();
            $data['CodigoUsuario'] = $insert_id;
        } catch (Exception $e) {
            $e->getMessage();
        }
        return $data;
    }

    public function editarUsuario($codigoUsuario, $nombreUsuario, $contraseniaUsuario, $nombrePersonaUsuario, $correo) {
        try {
            try {
                /** $data = array(
                  'Nombre' => $Nombre, 'CorreoElectronico' => $CorreoElectronico,
                  'TelefonoFijo' => $TelefonoFijo, 'TelefonoCelular' => $TelefonoCelular,
                  'FechaNacimiento' => $FechaNacimiento, 'Direccion' => $Direccion,
                  'NumeroDUI' => $NumeroDUI, 'Carrera' => $Carrera,
                  'CodigoUniversidadProcedencia' => $CodigoUniversidadProcedencia,
                  'NivelAcademico' => $NivelAcademico,'NombreEncargado' => $NombreEncargado,
                  'Descripcion' => $Descripcion, 'CodigoCategoriaParticipantes' => $CodigoCategoriaParticipantes,
                  'UsuarioModifica' => $UsuarioModifica, 'IPModifica' => $IPModifica,
                  'FechaModifica' => $FechaModifica, 'Comentarios' => $Comentarios, 'Descripcion'=> $Descripcion
                  );
                  $this->db->where('CodigoParticipante', $CodigoParticipante);
                  $this->db->update('Participantes', $data);
                  $data['CodigoParticipante'] = $CodigoParticipante;
                 */
            } catch (Exception $ex) {

                $ex->getMessage();
            }
            return $data;
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    public function eliminarUsuario($codigoUsuario) {
        $this->db->where('CodigoUsuario', $codigoUsuario);
        $this->db->delete('Usuarios');
    }

    public function findUsuario($codigoUsuario) {
        $this->db->select('CodigoUsuario, Nombre, CorreoUsuario, NombreUsuario');
        $this->db->from('Usuarios');
        $this->db->where('CodigoUsuario', $id);
        $consulta = $this->db->get();
        $resultado = $consulta->row();
        return $resultado;
    }

}
