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
        //  $this->load->model('CategoriaDiplomados');
    }

    public function index() {
        $data['allPublicaciones'] = $this->Publicaciones->listarPublicaciones();
        $data['listCategorias'] = $this->Publicaciones->listarCategoriasDiplomados();
        $data['listNombreCategoria']= $this->Publicaciones->listarCategoriasDiplomados(NULL);
        $this->load->view('Publicaciones', $data);
    }

    //Esta funcion sube la imagen o el archivo  a la carpeta destinada
    function do_upload() {
        try {
            //comprobamos que sea una petición ajax
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

                //obtenemos el archivo a subir
                $file = $_FILES['archivo']['name'];

                //comprobamos si existe un directorio para subir el archivo
                //si no es así, lo creamos
                //direccion de la carpeta donde se va a subir la imagen o archivo
                if (!is_dir("./bootstrap/images/publicaciones/"))
                    mkdir("./bootstrap/images/publicaciones/", 0777);

                //comprobamos si el archivo ha subido
                if ($file && move_uploaded_file($_FILES['archivo']['tmp_name'], "./bootstrap/images/publicaciones/" . $file)) {
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

//subir los datos de la publicacion de la base de datos            
    function subirBd() {
        try {
            if ($this->input->post()) {
                $usuarioPublica = $this->session->userdata("codigoUserLogin");
                $FechaPublicacion = date('Y-m-d');
                $tituloP = $this->input->post('Titulo');
                $contenidoP = $this->input->post('Contenido');
                $nambre = $this->input->post('Nombre');
                $categoria = $this->input->post('Categoria');

                //ingresar los datos del archivo a la bd
                $test = $nambre;
                $ext = $this->input->post('Extension');
                $Ruta = "/images/publicaciones/" . $test;
                $Estado = True;
                $CodigoUsuarios = $this->session->userdata("codigoUserLogin");
                $ipPublica = $this->session->userdata("ipUserLogin");
                
                //comprobacion de campos diferentes a NULL
                if ($tituloP != NULL && $contenidoP != NULL && $nambre != NULL) {
                    $arrayDataPublicacion = $this->Publicaciones->CrearPublicacion($usuarioPublica, $FechaPublicacion, $tituloP, $contenidoP, TRUE, null, null, null, TIPO_PUBLICACION_WEB, null, $categoria);
                    $CodigoPublicaciones = $arrayDataPublicacion['CodigoPublicacion'];
                    $this->Publicaciones->CrearArchivo($Ruta, $test, $ext, $Estado, $CodigoUsuarios, $CodigoPublicaciones, $usuarioPublica, $ipPublica, $FechaPublicacion);

                    echo json_encode($CodigoPublicaciones);
                } else {
                    echo "Error algunas de los campos son nulos" + "titulo = " + $tituloP + "contenido = " + $contenidoP + "nombre = " + $nambre + $ext;
                }
            }
        } catch (Exception $exc) {
            echo json_encode($exc);
        }
    }

    
    //este metodo borra una archivo o imagen  de la carpeta del servidor
    function borrarImgCarpeta() {
        $nombreImg = $this->input->post('Nombre');
        if ($nombreImg != NULL) {
            $nombreImg = "./bootstrap/images/publicaciones/" . $nombreImg; //ruta de la carpeta donde esta guardado el archivo o imagen
            if(file_exists($nombreImg)){unlink($nombreImg);}
        } else {
            return false;
        }
    }

    //begin of delete Publicaciones 
    //it works now :)
     public function eliminarPublicacion() {
        try {
            $codigoPublicacion =$this->input->post('Cod');
            if ($codigoPublicacion != null) {
                $archivo = $this->Publicaciones->ObtenerRutaArchivo($codigoPublicacion);
                $this->Publicaciones->EliminarArchivosPublicacion($codigoPublicacion);
                $ruta = "./bootstrap" . $archivo;
                if(file_exists($ruta)){unlink($ruta);}
                $arrayData = $this->Publicaciones->EliminarPublicacion($codigoPublicacion);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            $data = array(
                'Error' => $ex->getMessage()
            );
            echo json_encode($data);
        }
    }
    
    //para modificar se obtiene la publicacion
    public function obtenerPublicacion() {//obtiene publicacion para editar
        $id=$this->input->post('idpub');
        if($id!=null){
            $datos=$this->Publicaciones->obtenerDatosDePublicacionPorId($id);
            echo json_encode($datos);
        }
    }
    
    //Guarda los nuevos cambios
    public function editar(){
        try{
            if ($this->input->post()) {
                $id=$this->input->post('PId');
                $tituloP = $this->input->post('Titulo');
                $contenidoP = $this->input->post('Contenido');
                $nombre = $this->input->post('Nombre');
                $categoria = $this->input->post('Categoria');
                $ext = $this->input->post('Extension');
                $Ruta = "/images/publicaciones/" . $nombre;
                
                if ($tituloP != NULL && $contenidoP != NULL ) {
                    $archivoAntiguo=$this->Publicaciones->ObtenerRutaArchivo($id);
                    $this->Publicaciones->actualizaPublicacionWeb($id, $Ruta, $tituloP,$categoria, $contenidoP, $ext,$nombre);
                    $rutaAntigua = "./bootstrap" . $archivoAntiguo;
                    if($nombre!='' & $ext!='' & file_exists($rutaAntigua) & ($archivoAntiguo!=$Ruta)){
                        //si hay imagen nueva se borra la antigua
                        unlink($rutaAntigua);
                    }
                    echo json_encode($id);
                } else {
                    echo "Error algunas de los campos son nulos" + "titulo = " + $tituloP + "contenido = " + $contenidoP + "nombre = " + $nombre + $ext;
                }
            }
        } catch (Exception $ex) {
             echo json_encode($ex);
        }
    }

}
