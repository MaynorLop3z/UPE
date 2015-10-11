
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
            if ($this->usuario_model->login($_POST['user'], $_POST['password'])) {

                redirect('Dashboard');
            } else {
                
            }
        } else {
            //aqui dene llamar usuarios

            $data['publicacionesMostrar'] = $this->listarPublicaciones();
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

}
