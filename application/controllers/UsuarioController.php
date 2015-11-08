<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuariocontroller extends CI_Controller {

    public function __construct() {
        try {
            parent::__construct();
            $this->load->database();
            $this->load->model('Usuarios');
            $this->load->library('utilidadesWeb');
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function index() {
        try {
            $data['Usuarios'] = $this->Usuarios->listarUsuarios();
//            $datau = 
            $this->load->view('Usuario', $data);
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function guardarUsuario($codigoUsuario = null) {
        try {
            if ($this->input->post()) {
                $nombrePersonaUsuario = $this->input->post('UsuarioNombreReal');
                $contraseniaUsuario = $this->input->post('UsuarioPassword');
                $comentarios = $this->input->post('Comentarios');
                $correo = $this->input->post('UsuarioEmail');
                $nombreUsuario = $this->input->post('UsuarioNombre');
                $ip = $this->session->userdata('ipUserLogin');
                $userModifica = $this->session->userdata('codigoUserLogin');
                //La fecha de modificaciòn del registro se coloca en el modelo para evitar enviar mas parametros.
                $this->load->model('Usuarios');

                $arrayData = $this->Usuarios->guardarUsuario(null, $nombreUsuario, $contraseniaUsuario, $nombrePersonaUsuario, $correo, $userModifica, $ip, $comentarios);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            $data = array(
                'Error' => $ex->getMessage(),
            );
            echo json_encode($data);
        }
    }

    public function editarUsuario() {
        try {
            if ($this->input->post()) {
                $codigoUser=$this->input->post('CodigoUsuario');
                if ($codigoUser!=null) {
                    $codigoUsuario = $codigoUser;
                    $nombrePersonaUsuario = $this->input->post('UsuarioNombreReal');
                    $contraseniaUsuario = $this->input->post('UsuarioPassword');
                    $comentarios = $this->input->post('Comentarios');
                    $correo = $this->input->post('UsuarioEmail');
                    $nombreUsuario = $this->input->post('UsuarioNombre');
                    $ip = $this->session->userdata('ipUserLogin');
                    $userModifica = $this->session->userdata('codigoUserLogin');
                    //La fecha de modificaciòn del registro se coloca en el modelo para evitar enviar mas parametros.
                    $this->load->model('Usuarios');
                    $arrayData = $this->Usuarios->editarUsuario($codigoUsuario, $nombreUsuario, $contraseniaUsuario, $nombrePersonaUsuario, $correo, $userModifica, $ip, $comentarios);
                    echo json_encode($arrayData);
                }
            }
        } catch (Exception $e) {
            $data = array(
                'Error' => $ex->getMessage()
            );
            echo json_encode($data);
        }
    }
    
      public function eliminarUsuario() {
         $eliminado = false;
         try {
             if ($this->input->post()) {
                 $codigo = $this->input->post('CodigoUsuario');
                 $eliminado = $this->Usuarios->eliminarUsuario($codigo);
                 echo $eliminado;
             }
         } catch (Exception $ex) {
            echo json_encode($ex);
         }
     }
     

}
