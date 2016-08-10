<?php
if (!defined('BASEPATH')){
    exit('No direct script access allowed');
}
include(APPPATH . 'libraries/simple_html_dom.php');

class ArchivosController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Publicaciones');
        $this->load->library('utilidadesWeb');
        $this->load->helper(array('download', 'file', 'url', 'html', 'form'));
    }
    
    public function index() {
        $login=$this->session->userdata("codigoUserLogin");
        $nombre=$this->session->userdata("nombreUserLogin");
        $carnet=$this->session->userdata("nombreUserLogin"); //FALTA CARNET
        //$data['allArchivos'] = $this->Publicaciones->listarPublicacionesParaArchivo();
        
        //if($this->Publicaciones->verificar_si_es_alumno($login, $carnet)==1){
            $data['gruposAlumno'] = $this->Publicaciones->ListarGruposAlumno($login);
            $data['archivosAlumno'] = $this->Publicaciones->ListarArchivosParaAlumno($login);
        //}else if($this->Publicaciones->verificar_si_es_maestro($login,$nombre)==1){
            $data['gruposMaestro'] = $this->Publicaciones->GruposPorMaestro($login);
            $data['archivosMaestro'] = $this->Publicaciones->ListarArchivosDelMaestro($login);
        //}
        $permisos = $this->session->userdata('permisosUsuer');
        $this->analizarPermisos('views/Archivos/ArchivosTab.php', 'views/Archivos/ArchivosTabTmp.php', $permisos);
        $this->load->view('Archivos',$data);
    }
    
     function analizarPermisos($pathView, $pathViewTmp, $permisos) {
        $pathView = APPPATH . $pathView;
        $pathViewTmp = APPPATH . $pathViewTmp;

        $html = file_get_html($pathView, $use_include_path = false, $context = null, $offset = -1, $maxLen = -1, $lowercase = true, $forceTagsClosed = true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN = false, $defaultBRText = DEFAULT_BR_TEXT);
        $elemsWithRights = $html->find(DEFINE_RIGHT_ALLOWED);
        $encontrado = 0;
        foreach ($elemsWithRights as $elem) {
            foreach ($permisos as $right) {
                if ($elem->id == $right->NombrePermiso) {
                    $encontrado = 1;
                    break;
                } else {
                    
                }
            }
            if ($encontrado == 1) {
                $encontrado = 0;
                continue;
            } else {
                $elem->outertext = '';
            }
        }
        $html->save($pathViewTmp);
    }

    function analizarPermisosBotonesTablas($idBtnsGestion, $permisos) {
        $pathView = APPPATH . 'views/VistaAyudaView.php';
        $html = file_get_html($pathView);
        //param=gestionUserBtn
        $elemsWithRights = $html->getElementById($idBtnsGestion);
        $encontrado = 0;

        foreach ($elemsWithRights->find('button') as $key) {
            foreach ($permisos as $right) {
//                $key = $elemsWithRights->find('button[class="' . $right->NombrePermiso . '"]');
                if (explode(" ", $key->class)[0] == $right->NombrePermiso) {
                    $encontrado = 1;
                    break;
                } else {
                    
                }
            }
            if ($encontrado == 1) {
                $encontrado = 0;
                continue;
            } else {
                $key->outertext = '';
            }
        }
        //}
        return str_get_html($elemsWithRights);
    }


  //sube el archivo  a la carpeta de publicaciones
    function do_upload() {
        try {
            //comprobamos que sea una petición ajax
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
                    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

                //obtenemos el archivo a subir
                $file = $_FILES['archivoArchivo']['name'];
                $fileNom =$this->input->post('nombremodArchivo');

                //direccion de la carpeta donde se va a subir la imagen o archivo
                if (!is_dir("./bootstrap/images/publicaciones/"))
                    mkdir("./bootstrap/images/publicaciones/", 0777);

                //comprobamos si el archivo ha subido
                if ($fileNom && move_uploaded_file($_FILES['archivoArchivo']['tmp_name'],
                                        "./bootstrap/images/publicaciones/" . $fileNom)) {
                    sleep(3);
                    echo $file;
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
                $categoria = $this->input->post('CCategoria');
                
                $codigoGrupoPeriodo = $this->input->post('CodGruPe');
                $codigoGrupoPeriodoUsuario = $this->input->post('CodGruPeUs');

            //ingresar los datos del archivo a la bd
                $test = $nambre;
                $ext = $this->input->post('Extension');
                $Ruta = "/images/publicaciones/" . $test;
                $Estado = True;
                $CodigoUsuarios = $this->session->userdata("codigoUserLogin");
                $ipPublica = $this->session->userdata("ipUserLogin");
                
            //comprobacion de campos diferentes a NULL
                if ($tituloP != NULL && $contenidoP != NULL && $nambre != NULL) {
                    $arrayDataPublicacion = $this->Publicaciones->CrearPublicacion(
                                            $usuarioPublica, $FechaPublicacion, $tituloP, $contenidoP, TRUE, 
                                            $codigoGrupoPeriodo, $codigoGrupoPeriodoUsuario, null, 
                                            TIPO_PUBLICACION_GRUPO, null, $categoria);
                    
                    $CodigoPublicaciones = $arrayDataPublicacion['CodigoPublicacion'];
                    $this->Publicaciones->CrearArchivo($Ruta, $test, $ext, $Estado, $CodigoUsuarios, 
                                          $CodigoPublicaciones, $usuarioPublica, $ipPublica, $FechaPublicacion);

                    echo json_encode($CodigoPublicaciones);
                } else {
                    echo "Error algunas de los campos son nulos" . "titulo = " . $tituloP 
                            . "contenido = " . $contenidoP . "nombre = " . $nambre . $ext;
                }
            }
        } catch (Exception $exc) {
            echo json_encode($exc);
        }
    }
    
    //borra una archivo de la carpeta del servidor
    function borrarArchCarpeta() {
        $archivo = $this->input->post('Nombre');
        if ($archivo  != NULL) {
            $archivo  = "./bootstrap/images/publicaciones/" . $archivo;
            unlink($archivo);
        } else {
            return false;
        }
    }

    //************ ELIMINA PUBLICACION DE ARCHIVOS ***********************
    public function eliminarPublicacion() {
        try {
            //$codigoPublicacion = $cod;
            $codigoPublicacion =$this->input->post('Cod');
            if ($codigoPublicacion != null) {
                $archivo = $this->Publicaciones->ObtenerRutaArchivo($codigoPublicacion);
                $this->Publicaciones->EliminarArchivosPublicacion($codigoPublicacion);
                $arrayData = $this->Publicaciones->EliminarPublicacion($codigoPublicacion);
                $ruta = "./bootstrap" . $archivo;
                unlink($ruta);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            $data = array(
                'Error' => $ex->getMessage()
            );
            echo json_encode($data);
        }
    }


    //************ DESCARGA DE ARCHIVOS ***********************

    public function downloads($name){
           $data = file_get_contents(base_url().'/bootstrap/images/publicaciones/'.$name);
           force_download($name,$data);
    }
    
    /************ CALCULA SIZE DE ARCHIVO EN BYTES, KB O MB*******/
    public function get_tamanio($tamar){
        if($tamar>=1024 & $tamar<1048576){
                 $tamar = round($tamar/1024, 0)." Kb";
             }  else if($tamar >= 1048576) {
                 $tamar = round($tamar/1048576, 2)." Mb";
             }else{
                 $tamar = $tamar." B";
             }
        echo $tamar;
    }
    
}