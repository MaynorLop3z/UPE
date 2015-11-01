<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class PublicacionesController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('publicaciones');
        $this->load->model('archivos');
    }

    public function index() {


        $this->load->view('Publicaciones');
    }

    function do_upload() {
        try {
            $config['upload_path'] = './bootstrap/images/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = '100';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('upload', $config);
            $dataImg = array();


            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                echo "error";
                return $error;
            } else {
                if ($this->input->post()) {
                    echo 'Entro al controller';
                    //ingresar los datos de una publicacion a la bd
                    $usuarioPublica = $this->session->userdata("codigoUserLogin");
                    $fechaPublica = date('Y-m-d');
                    $tituloP = $this->input->post('titulo');
                    $contenidoP = $this->input->post('contenido');
                    $arrayDataPublicacion = $this->publicaciones->CrearPublicacion($usuarioPublica, $fechaPublica, $tituloP, $contenidoP, TRUE, null, null, null, null, null);
                    $codigoPub = $arrayDataPublicacion['CodigoPublicacion'];

                    //ingresar los datos del archivo a la bd
                    $dataImg = $this->upload->data();
                    $ruta = "/images/" . $dataImg['file_name'];
                    $nombre = $dataImg['file_name'];
                    $extension = $dataImg['file_ext'];
                    $estado = 'True';
                    $codigoUsuario = $this->session->userdata("codigoUserLogin");
                    $arrayDataArchivo = $this->CrearArchivo($ruta, $nombre, $extension, $estado, $codigoUsuario, $codigoPub);


                    //echo json_encode();
                }


                return true;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}
