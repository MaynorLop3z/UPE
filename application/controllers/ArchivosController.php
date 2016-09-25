<?php
if (!defined('BASEPATH')){
    exit('No direct script access allowed');
}
include(APPPATH . 'libraries/simple_html_dom.php');

class ArchivosController extends CI_Controller {
    private $final = 0;
    private $pagAct = 0;
    private $inicio = 0;
    private $grupo = '';
    private $paginas = '';
    private $totalArchivos = '';
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Publicaciones');
        $this->load->model('Archivos');
        $this->load->model('Comentarios');
        $this->load->helper(array('download', 'file', 'url', 'html', 'form'));
    }
    
    public function index() {
        $login=$this->session->userdata("codigoUserLogin");
        $nivel=$this->session->userdata("nivel"); //nivel comprueba si el login viene del portal de alumnos
        
        if($nivel=='Participante'){ //Si es alumno se carga sus archivos
            $data['gruposAlumno'] = $this->Archivos->ListarGruposAlumno($login);
            $data['archivosAlumno'] = $this->Archivos->ListarArchivosParaAlumno($login);
        }else if($nivel==''){//Si es maestro
            $data['gruposMaestro'] = $this->Archivos->GruposPorMaestro($login);
            $data['archivosMaestro'] = $this->Archivos->ListarArchivosDelMaestro($login);
        }
        $permisos = $this->session->userdata('permisosUsuer');
        $this->analizarPermisos('views/Archivos/ArchivosTab.php', 'views/Archivos/ArchivosTabTmp.php', $permisos, $nivel);
        $this->analizarPermisos('views/Archivos/ArchivosModal.php', 'views/Archivos/ArchivosModalTmp.php', $permisos, $nivel);
        $this->load->view('Archivos',$data);
    }
    
     function analizarPermisos($pathView, $pathViewTmp, $permisos, $nivel) {
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
                if($elem->id == "HisArchivosAlumno" & $nivel == 'Participane'){
                    $encontrado = 0;
                    continue;
                }else{
                    $elem->outertext = '';
                }
            }
        }
        $html->save($pathViewTmp);
    }

    function analizarPermisosHistorial($idBtnsGestion, $permisos) {
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
                    echo "Error algunos de los campos son nulos" . "titulo = " . $tituloP 
                            . "contenido = " . $contenidoP . "nombre = " . $nambre . $ext;
                }
            }
        } catch (Exception $exc) {
            echo json_encode($exc);
        }
    }
    
    //borra un archivo de la carpeta del servidor
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
        return $tamar;
    }
    
    ////////////////////////////LISTAR ARCHIVOS POR GRUPO PARA ALUMNOS///////////////////////
   public function ArchivosGrupoAlumno(){
       try{
           if($this->input->post('opcion') != null){
                $grupo=$this->input->post('opcion');
                $Archivos=$this->Archivos->listarArchivosPorGrupoAlumnoLimited($grupo, null,null);
                $totalArchivos=count($this->Archivos->listarArchivosPorGrupoAlumno($grupo));
                $this->paginas =  intval(ceil($totalArchivos / ROWS_PER_PAGE));
                $this->AvRevPaginas(null, "Alumno");
                $paginas = $this->paginas;
                $registro = "";
                foreach ($Archivos as $arch){//Lista cada archivo como row
                    $registro.=$this->filaArchivo($arch, "Alumno", $grupo);
                }        
                if( $totalArchivos > ROWS_PER_PAGE ){//Agrega paginador si es necesario
                    $registro.=$this->piePaginador($grupo, count($Archivos), $totalArchivos, $paginas, 'Alumno');
                }
            echo $registro;
           }echo "No hay archivos en este grupo";
       } catch (Exception $ex) {
           echo "nada";
       }
   }
    //crea una fila por cada archivo para mostrar en tabla de cada grupo(maestro o alumno)
    private function filaArchivo($arch, $nivel, $grupo){
        $btnEliminar='';
        if($nivel!="Alumno" && $nivel!=null){
            $btnEliminar='<button id="deleArc'.$arch->CodigoPublicacion .'" onclick="delArchivo(\''.$arch->CodigoPublicacion.'\',\''. $arch->Titulo.'\',\''. $grupo.'\')"  title="Eliminar Archivo" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>';
        }
        $registro='';
        if(file_exists('bootstrap'.$arch->Ruta)){
                        $tam=filesize('bootstrap'.$arch->Ruta); 
                        $tamar=$this->get_tamanio($tam);//Formatea el size del archivo
                     }else{$tamar="Indeterminado";}
                    $registro .= '<tr  data-dipd=\''.json_encode($arch).'\' id="dip'.$arch->CodigoPublicacion.'" onclick="cargarComentarios(\'dip'.$arch->CodigoPublicacion.'\')" title="Ver Comentarios" class="comment-toggler" >
                                    <td class="Archivo">'.$arch->Titulo.'</td>
                                    <td class="Descripcion">'. ($arch->Contenido!= NULL ? $arch->Contenido: "No hay descripción") .'</td>
                                    <td class="Publicado" >'. $arch->FechaPublicacion .'</td>
                                    <td class="TipoArchivo">'. strtoupper($arch->Extension).'</td>
                                    <td class="TamArchivo" style="width:100px;">'.$tamar .'</td>
                                    <td class="gestion_dip" style="width:150px;">
                                        <button id="downArc'.$arch->CodigoPublicacion.'" onclick="goArchivo(\''.base_url().'index.php/ArchivosController/downloads/'.$arch->Nombre.'\')"  title="Descargar Archivo" class="btndeldip btn btn-warning" class="btn btn-info btn-lg"><span class=" glyphicon glyphicon-download-alt"></span></button>'
                                        .$btnEliminar.
                                    '</td>
                            </tr>
                            <tr id="comment-dip'.$arch->CodigoPublicacion.'" class="comment">
                                <td class="form-group" colspan="6"> <label for="usr">Comentarios:</label>
                                <input type="text" class="form-control inputComment" placeholder="Escribe un comentario...">
                                <div class="list-group" id="comment-'.$arch->CodigoPublicacion.'"></div>
                                </td>
                            </tr>';
                    return $registro;
    }
    
    /////////// Paginador para los archivos de cada grupo (para alumnos o profesor)///////////
    private function piePaginador($grupo, $numArchivos, $totalArchivos, $paginas, $user){
        $pag='<tr id="pagerArchivos'.$user.'Grupo'.$grupo.'"><td colspan=6>'
                                . ' <div class="row">
                    <ul class="pager" id="footpagerArchivos'.$user.'Grupo'.$grupo.'">
                    <li><button data-datainic="1" id="aFirstPagArchivos'.$user.'Grupo'.$grupo.'" onclick="goFirstPagin'.$user.'('.$grupo.')" >&lt;&lt;</button></li>
                    <li><button id="aPrevPagArchivos'.$user.'Grupo'.$grupo.'" onclick="goBackPagin'.$user.'('.$grupo.')">&lt;</button></li>
                    <li><input data-datainic="'.$this->pagAct.'" type="text" class="onlyNumbers" value="'.$this->pagAct.'" id="txtPagingSearchArchivos'.$user.'Grupo'.$grupo.'" onkeypress="'.$user.'GoTo(event, \''.$grupo.'\')" name="txtNumberPag" size="5">/' . $paginas . '</li>
                    <li><button id="aNextPagArchivos'.$user.'Grupo'.$grupo.'" onclick="goNextPagin'.$user.'('.$grupo.')">&gt;</button></li>
                    <li><button id="aLastPagArchivos'.$user.'Grupo'.$grupo.'" data-datainic="' . $paginas . '" onclick="goLastPagin'.$user.'('.$grupo.')">&gt;&gt;</button></li>
                    <li>['.($this->final + 1).' - ' . ($this->final + $numArchivos) . ' / ' . $totalArchivos . ']</li></ul></div>'
                    . '</td></tr>';
        return $pag;
    }
    /*********PAGINACION DE Archivos por Grupo (para alumnos o profesor)***/
    public function paginArchivosGrupo($Archs= null) {
        try {
            $cadena = '';
            $filas = '';
            $Archivos = array();
            $user = '';
            if ($Archs != null) {
                array_push($Archivos, $Archs);
            } 
            else {
                $levelAccess = $this->input->post('la');
                if($levelAccess=='prof'){
                    $user = 'Maestro';
                    $this->AvRevPaginas(1, 'Maestro');
                    $Archivos = $this->Archivos->listarArchivosPorGrupoMaestroLimited(
                            $this->session->userdata("codigoUserLogin"),$this->grupo, $this->inicio, $this->final);
                    foreach ($Archivos as $archivo) {
                        $filas .= $this->filaArchivo($archivo, 'Maestro', $this->grupo);
                    }
                }else if($levelAccess==='a'){
                    $user = 'Alumno';
                    $this->AvRevPaginas(1, "Alumno");
                    $Archivos = $this->Archivos->listarArchivosPorGrupoAlumnoLimited($this->grupo, $this->inicio, $this->final);
                    foreach ($Archivos as $archivo) {
                        $filas .= $this->filaArchivo($archivo, "Alumno", $this->grupo);
                    }
                }
//                $cadena = "Grupo: ". $this->grupo. " Inicio: ". $this->inicio. " Final: ". $this->final. " Paginas: ".$this->paginas; 
            }
//            $cadena=  json_encode($Archivos);
            $cadena.=$filas;
            $cadena.= $this->piePaginador($this->grupo, count($Archivos), $this->totalArchivos, $this->paginas, $user);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if ($this->input->post('data_ini') || $this->input->post('data_inin') || $this->input->post('data_inip')) {
            echo ($cadena);
        } else {
            return $cadena;
        }
    }
 
///////////  
   private function AvRevPaginas($paginado, $levelAccess){
         if ($this->input->post()) {
             $this->grupo = $this->input->post('grupo');
             $grupo=$this->grupo;
             
                if($paginado!==null && $levelAccess==='Alumno'){//SI ES UN ALUMNO
                    $totalArchivos=count($this->Archivos->listarArchivosPorGrupoAlumno($grupo));
                    $this->totalArchivos=$totalArchivos;
                    $this->paginas =  intval(ceil($totalArchivos / ROWS_PER_PAGE));
                }
                else if($paginado!==null && $levelAccess==='Maestro'){ ///SI ES UN MAESTRO
                    $totalArchivos=count($this->Archivos->listarArchivosPorGrupoMaestro($this->session->userdata("codigoUserLogin"), $grupo));
                    $this->totalArchivos=$totalArchivos;
                    $this->paginas =  intval(ceil($totalArchivos / ROWS_PER_PAGE));
                }
                
                if ($this->input->post('data_ini') != null) {
                    $this->pagAct = $this->input->post('data_ini');
                    $this->final = $this->input->post('data_ini');
                    
                    if ($this->pagAct <= 0) {
                        $this->pagAct = 1;
                        $this->final = 1;
                    }else if($this->pagAct > $this->paginas) {
                        $this->pagAct =$this->paginas;
                        $this->final=$this->paginas;
                    }
                    
                } else if ($this->input->post('data_inip') != null) {
                    $this->pagAct = $this->input->post('data_inip') - 1;
                    $this->final = $this->input->post('data_inip') - 1;
                    if ($this->pagAct <= 0) {
                        $this->pagAct = 1;
                        $this->final = 1;
                    }
                } else if ($this->input->post('data_inin') != null) {
                    $this->pagAct = $this->input->post('data_inin');
                    $this->pagAct+=1;
                    $this->final = $this->input->post('data_inin');
                    $this->final+=1;
                    if ($this->pagAct > $this->paginas) {
                        $this->pagAct =$this->paginas;
                        $this->final=$this->paginas;
                    }  else {
                        
                    }
                } else {
                    $this->pagAct = 1;
                    $this->final = 1;
                }
            }
            $this->inicio = ROWS_PER_PAGE;
            $this->final = ($this->final * ROWS_PER_PAGE) - ROWS_PER_PAGE;
    }
           
}
