<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class PublicacionesController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
//$this->load->helper(array('form', 'url'));
        $this->load->model('Publicaciones');
        ///$this->load->model('archivos');
    }

    public function index() {
        $data['TituloN'] = $this->Publicaciones->listarPublicaciones();
        $this->load->view('Publicaciones', $data);
    }

    //Esta funcion sube la imagen a la carpeta destinada
    function do_upload() {

        try {
            $this->load->library('upload', $config);
            $file = $_FILES['archivo']['name'];
//comprobamos si existe un directorio para subir el archivo
//si no es así, lo creamos
            if (!is_dir("./bootstrap/images/publicaciones/")) {
                mkdir("./bootstrap/images/publicaciones/", 0777);
            }

//comprobamos si el archivo ha subido
            if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'], "./bootstrap/images/publicaciones/" . $file)) {
//ingresar los datos de una publicacion a la bd
                sleep(3); //retrasamos la petición 3 segundos
            }
             else {
                throw new Exception("Error Processing Request", 1);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    function subirBd() {
        try {
            if ($this->input->post()) {
                $usuarioPublica = $this->session->userdata("codigoUserLogin");
                $FechaPublicacion = date('Y-m-d');
                $tituloP = $this->input->post('Titulo');
                $contenidoP = $this->input->post('Contenido');
                $nambre = $this->input->post('Nombre');
                $arrayDataPublicacion = $this->Publicaciones->CrearPublicacion($usuarioPublica, $FechaPublicacion, $tituloP, $contenidoP, TRUE, null, null, null, 1, null);
                $CodigoPublicaciones = $arrayDataPublicacion['CodigoPublicacion'];
//ingresar los datos del archivo a la bd
                $test = $nambre;
                $ext = $this->input->post('Extension');
                $Ruta = "/images/publicaciones/" . $test;
                $Estado = True;
                $CodigoUsuarios = $this->session->userdata("codigoUserLogin");
                $ipPublica = $this->session->userdata("ipUserLogin");
                $this->Publicaciones->CrearArchivo($Ruta, $test, $ext, $Estado, $CodigoUsuarios, $CodigoPublicaciones, $usuarioPublica, $ipPublica, $FechaPublicacion);
            }
        } catch (Exception $exc) {
        }
    }

    public function eliminarDiplomado() {
        $eliminar = false;

        try {
            if ($this->input->post()) {
                $codigo = $this->input->post('CodigoPublicacion');
                $eliminar = $this->publicaciones->EliminarPublicacion($codigo);
                echo $eliminar;
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

}
