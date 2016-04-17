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
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
//controlador de la pagina principal, permite logear a los usuarios
include './application/models/dto/UsuariosDTO.php';
include './application/controllers/Listar.php';

class Wsite extends CI_Controller {

    //put your code here
    public $usuarioDTO;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        // $this->load->view('wsite');
        $this->load->model('publicaciones');
        $this->load->model('archivos');
        $user = $this->input->post('user');

        if ($user) {
            $this->load->model('usuario_model');
            $this->load->model('Usuarios');
            $this->load->helper('url');
            if ($this->input->post()) {
                $nombre = $this->input->post('user');
                $Contrasenia = $this->input->post('password');
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
//                    $this->load->view('Dashboard', $data);
                    Redirect('Dashboard');
                }
            }
        } else {
            $data['publicacionesMostrar'] = $this->listarPublicaciones();
//            $data['publicacionesCargar'] = $this->mostrarPublicaciones();
//            $data['mostrarUnaPublicacion']=  $this->mostrarPublicacion($id);
            $this->load->view('wsite', $data);
        }
    }

    public function listarPublicaciones() {
        try {
            $listaPublicacionesArchivos = array();
            $iterador = 0;
            $listaPublicaciones = array();
            $listaPublicaciones = $this->publicaciones->listarPublicaciones();
            foreach ($listaPublicaciones as $publicacion) {

                $archivos = $this->archivos->listarArchivosPublicacion($publicacion->CodigoPublicacion);
                foreach ($archivos as $archivo) {
                    $publicacionArchivo = array(
                    'CodigoPublicacion' => $publicacion->CodigoPublicacion,
                    'Titulo' => $publicacion->Titulo,
                    'Ruta' => $archivo->Ruta,
                    'Contenido' => $publicacion->Contenido,
                    'FechaPublicacion' => $publicacion->FechaPublicacion);
                }
                array_push($listaPublicacionesArchivos, $publicacionArchivo);
                $iterador ++;
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }

        return $listaPublicacionesArchivos;
    }

    public function mostrarPublicaciones() {
        try {
            $listaPublicacionesArchivos2 = array();
            $iterador = 0;
            $listaPublicaciones = array();
            $listaPublicaciones = $this->publicaciones->listarPublicaciones();
            foreach ($listaPublicaciones as $publicacion) {
                $archivos2 = $this->archivos->listarArchivosPublicacion($publicacion->CodigoPublicacion);
                foreach ($archivos2 as $archivo) {
                    $publicacionArchivo = array(
                        'CodigoPublicacion' => $publicacion->CodigoPublicacion,
                        'Titulo' => $publicacion->Titulo,
                        'Ruta' => $archivo->Ruta,
                        'Contenido' => $publicacion->Contenido,
                        'FechaPublicacion' => $publicacion->FechaPublicacion);
                }
                array_push($listaPublicacionesArchivos2, $publicacionArchivo);
                $iterador ++;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $listaPublicacionesArchivos2;
    }

    // funcion para listar una publicacion segun su id
//    public function mostrarPublicacion($id) {
//        $iterador = 0;
//        $camposPublicacion = array();
//        $listaPublicaciones = $this->publicaciones->MostrarDatosPublicacion($id);
//        try {
//             $camposPublicacion = array(
//                        'CodigoPublicacion' => $publicacion->CodigoPublicacion,
//                        'Titulo' => $publicacion->Titulo,
//                        'Ruta' => $archivo->Ruta,
//                        'Contenido' => $publicacion->Contenido,
//                        'FechaPublicacion' => $publicacion->FechaPublicacion);
//                
//                array_push($camposPublicacion,$camposPublicacion);
//            
//        } catch (Exception $exc) {
//            echo $exc->getTraceAsString();
//        }
//    }
}
