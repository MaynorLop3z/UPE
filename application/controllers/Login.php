
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//controlador de la pagina principal, permite logear a los usuarios
include './application/models/dto/UsuariosDTO.php';
include './application/controllers/Listar.php';

class Login extends CI_Controller {

    public $usuarioDTO;

    public function __construct() {
        parent::__construct();
        $this->usuarioDTO = new UsuariosDTO();
        $this->test = new Listar();
    }

    public function index() {
        $nombreUser = $this->usuarioDTO->getNombre();
        $this->load->model('publicaciones');
        $this->load->model('archivos');
        $user = $this->input->post('user');
        if ($user) {
            $this->load->model('usuario_model');
            $this->load->helper('url');

            $usuario = $this->usuario_model->login($_POST['user'], $_POST['password']);

            if ($usuario != null) {
                $usuario_data = array(
                    'codigoUserLogin' => $usuario->CodigoUsuario,
                    'nombreUserLogin' => $usuario->NombreUsuario,
                    'correoUserLogin' => $usuario->CorreoUsuario,
                    'nombreRealUserLogin' => $usuario->Nombre,
                    'temaUserLogin' => $usuario->codigoTemaVista,
                    'logueado' => TRUE);
                $this->session->set_userdata($usuario_data);
                redirect('Dashboard');
            } else {
                
            }
        } else {
            //aqui debe llamar usuarios

            $data['publicacionesMostrar'] = $this->listarPublicaciones();
            $data['publicacionesCargar'] = $this->mostrarPublicaciones();
            $this->load->view('login_vista', $data);
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

    public function mostrarPublicaciones() {
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
