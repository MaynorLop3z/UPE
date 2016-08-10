<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//Controlador de la pagina para el login de participantes

include(APPPATH . 'libraries/simple_html_dom.php');
class LoginParticipanteController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function index() {
//        $nombreUser = $this->usuarioDTO->getNombre();
//        $this->load->model('publicaciones');
//        $this->load->model('archivos');
        $user = $this->input->post('user');
        $data = '';
        if ($user) {
            $this->load->model('usuario_model');
            $this->load->model('Usuarios');
            $this->load->helper('url');

            $usuario = $this->usuario_model->login($_POST['user'], $_POST['password']);

            if ($usuario != null) {

                $permisos = $this->Usuarios->listPermisosByUser($usuario->CodigoUsuario);
                $data['Permisos'] = $permisos;
                $usuario_data = array(
                    'codigoUserLogin' => $usuario->CodigoUsuario,
                    'nombreUserLogin' => $usuario->NombreUsuario,
                    'correoUserLogin' => $usuario->CorreoUsuario,
                    'nombreRealUserLogin' => $usuario->Nombre,
                    // 'temaUserLogin' => $usuario->codigoTemaVista,
                    'ipUserLogin' => $this->input->ip_address(),
                    'permisosUsuer' => $permisos,
                    'logueado' => TRUE);
                $this->session->set_userdata($usuario_data);
                // redirect('Dashboard');
                $this->load->view('Dashboard', $data);
            } else {
                
            }
        } else {
            //aqui debe llamar usuarios

//            $data['publicacionesMostrar'] = $this->listarPublicaciones();
//            $data['publicacionesCargar'] = $this->mostrarPublicaciones();
            $this->load->view('LoginParticipante', $data);
        }
    }

    public function verificarLogin() {
        try {
            $listaPublicacionesArchivos = array();
            $iterador = 0;
            $listaPublicaciones = array();
            $listaPublicaciones = $this->publicaciones->listarPublicaciones();
            foreach ($listaPublicaciones as $publicacion) {

                $archivos = $this->archivos->listarArchivosPublicacion($publicacion->CodigoPublicacion);
                foreach ($archivos as $archivo) {
                    $publicacionArchivo = array('Titulo' => $publicacion->Titulo,
                        'Ruta' => $archivo->Ruta);
                }
                array_push($listaPublicacionesArchivos, $publicacionArchivo);
                $iterador ++;
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }

        return $listaPublicacionesArchivos;
    }

    /*
     * La siguiente funcion mostrara las publicaciones en el login
     */

    public function enter($usuario, $password) {
        try {
            $listaPublicacionesArchivos2 = array();
            $iterador = 0;
            $listaPublicaciones = array();
            $listaPublicaciones = $this->publicaciones->listarPublicaciones();
            foreach ($listaPublicaciones as $publicacion) {

                $archivos2 = $this->archivos->listarArchivosPublicacion($publicacion->CodigoPublicacion);
                foreach ($archivos2 as $archivo) {
                    $publicacionArchivo = array('Titulo' => $publicacion->Titulo,
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

}
