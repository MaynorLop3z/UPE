<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Wsite
 *
 * @author Grisshi
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//controlador de la pagina principal, permite logear a los usuarios
include './application/models/dto/UsuariosDTO.php';
include './application/controllers/Listar.php';

class Wsite extends CI_Controller {

    //put your code here
    public $usuarioDTO;

    public function __construct() {
        parent::__construct();
        $this->usuarioDTO = new UsuariosDTO();
    }

    public function index() {
        $this->load->view('wsite');
        $nombreUser = $this->usuarioDTO->getNombre();
        $this->load->model('publicaciones');
        $this->load->model('archivos');
        $user = $this->input->post('user');

        if ($user) {
            $this->load->model('usuario_model');
            $this->load->model('Usuarios');
            $this->load->helper('url');
            if($this->input->post()){
                $nombre= $this->input->post('Nombre');
                $Contrasenia= $this->input->post('Pass');
                $usuario = $this->usuario_model->login($nombre, $Contrasenia);
                if ($usuario != null) {

                $permisos = $this->Usuarios->listPermisosByUser($usuario->CodigoUsuario);
                $data['Permisos'] = $permisos;
                $usuario_data = array(
                    'codigoUserLogin' => $usuario->CodigoUsuario,
                    'nombreUserLogin' => $usuario->NombreUsuario,
                    'correoUserLogin' => $usuario->CorreoUsuario,
                    'nombreRealUserLogin' => $usuario->Nombre,
                    'ipUserLogin' => $this->input->ip_address(),
                    'permisosUsuer' => $permisos,
                    'logueado' => TRUE);
                $this->session->set_userdata($usuario_data);
                // redirect('Dashboard');
                $this->load->view('Dashboard', $data);
            }
        } else {
            $this->load->view('wsite');
        }
    }

         }

            

            
}
