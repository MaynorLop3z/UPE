<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class PublicacionesController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->load->model('publicaciones');
        $this->load->model('archivos');
    }

    public function index() {


        $data['TituloN'] = $this->publicaciones->listarPublicaciones();
        $this->load->view('publicaciones', $data);
    }

    function do_upload() {
        try {
//        
            $this->load->library('upload', $config);
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

                //obtenemos el archivo a subir
                $file = $_FILES['archivo']['name'];


                //comprobamos si existe un directorio para subir el archivo
                //si no es así, lo creamos
                if (!is_dir("./bootstrap/images/publicaciones/")){
                mkdir("./bootstrap/images/publicaciones/", 0777);}

                //comprobamos si el archivo ha subido
                if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'], "./bootstrap/images/publicaciones/" . $file)) {
                    //ingresar los datos de una publicacion a la bd
                    sleep(3); //retrasamos la petición 3 segundos
                    echo $file; //devolvemos el nombre del archivo para pintar la imagen
                }
            } else {
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
                $tituloP = $this->input->post('titulo');
                $contenidoP = $this->input->post('contenido');
                $arrayDataPublicacion = $this->publicaciones->CrearPublicacion($usuarioPublica, $FechaPublicacion, $tituloP, $contenidoP, TRUE, null, null, null, 1, null);
//                    //codigo de publicacion = 1 publicacioin de apag d inicio
//                    //public function CrearPublicacion($UsuarioPublica, $FechaPublicacion, $Titulo, $Contenido, $Estado, $CodigoGrupoPeriodo, $CodigoGrupoPeriodoUsuario, $CodigoGrupoParticipantes, $CodigoTipoPublicacion, $ParticipantePublica)
                $CodigoPublicaciones = $arrayDataPublicacion['CodigoPublicacion'];
                echo "datos Publicaciones ";
//                    //ingresar los datos del archivo a la bd
                $dataImg = $this->upload->data();
                    $Ruta = "/images/publicaciones/" . $file;
                    $ext = $file;
                $Estado = True;
                $CodigoUsuarios = $this->session->userdata("codigoUserLogin");
                $ipPublica = $this->session->userdata("ipUserLogin");
                $this->archivos->CrearArchivo($Ruta, $file, $ext, $Estado, $CodigoUsuarios, $CodigoPublicaciones, $usuarioPublica, $ipPublica, $FechaPublicacion);
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
  }
}

        
        
        