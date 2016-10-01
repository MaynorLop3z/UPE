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
        $data['allPublicaciones'] = $this->Publicaciones->listarPubliWebDashboard(null, null);
        $data['listCategorias'] = $this->Publicaciones->listarCategoriasDiplomados();
        $data['listNombreCategoria']= $this->Publicaciones->listarCategoriasDiplomados(NULL);
        $data['ToTalRegistrosPubWeb'] = count($this->Publicaciones->listarPublicaciones());
        $data['PagInicialPubWeb'] = 1;
        $data['totalPaginasPubWeb'] = $this->getTotalPaginas();
        $this->load->view('Publicaciones', $data);
    }

    private function getTotalPaginas() {
        return $result = intval(ceil(count($this->Publicaciones->listarPublicaciones()) / ROWS_PER_PAGE));
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
    
    public function BuscarPublicaciones(){
        try {
            if($this->input->post()){
                $nombrePu = $this->input->post('FindPublicacion');
                $categoria = $this->input->post('Categoria');
                $Publicaciones = $this->Publicaciones->listarPublicacionesNombre($nombrePu, $categoria);   
                $registro = $this->EncabezadoTabla();
                if(count($Publicaciones)>0){
                    foreach ($Publicaciones as $pub){
                          $registro .= $this->cuerpoTabla($pub);
                    }
                }else{
                    $registro = $this->EncabezadoTabla()."<tr><td colspan=3>No se encontraron coincidencias</td></tr>";
                }
                echo $registro.'</tbody></table>';
            }    
        } catch (Exception $ex) {
           echo json_encode($ex);
        }
    }
    
     private function EncabezadoTabla(){
        $encabezado='<table id="tableTitulo"  class="table table-bordered table-striped table-hover table-responsive">
            <thead>
                <tr>
                <th>Titulo</th>
                <th>Categoria</th>
                <th>Gestionar</th>
                </tr>
            </thead> 
            <tbody>';
        return $encabezado;
    }
    
    private function cuerpoTabla($pub){
        $filas='';
        $filas.='<tr data-dipd="' . ($pub->CodigoPublicacion) . '" id="diplo' . $pub->CodigoPublicacion . '">';
        $filas.=' <td class="Titulo" id="TutuloPubTabla' . $pub->CodigoPublicacion . '">' . $pub->Titulo .'</td>';
        $filas.=' <td class="Categoria" id="CategoriaPubTabla'. $pub->CodigoPublicacion .'">'. $pub->NombreCategoriaDiplomado .'</td>';
        $filas.=' <td class="gestion_dip" >'
                . '<button id="editPublicacion'. $pub->CodigoPublicacion . '" onclick="editarPublicacion(\''.  $pub->CodigoPublicacion .'\')" title="Editar Publicacion" class="btnmoddi btn btn-success"><span class=" glyphicon glyphicon-pencil"></span></button>'
                . '<button id="delPub'. $pub->CodigoPublicacion .'" onclick="eliminarPublicacion(\''. $pub->CodigoPublicacion .'\',\''. $pub->Titulo .'\')" title="Eliminar Publicacion" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
            </td></tr>';
        return $filas;
    }
    
    public function paginPublicaciones($Pubs = null) {
        try {
            $final = 0;
            $pagAct = 0;
            $cadena = '';
            $filas = '';
            $Publicaciones = array();

            if ($this->input->post()) {
                if ($this->input->post('data_ini') != null) {
                    $pagAct = $this->input->post('data_ini');
                    $final = $this->input->post('data_ini');
                    
                    if ($pagAct <= 0) {
                        $pagAct = 1;
                        $final = 1;
                    }else if($pagAct > $this->getTotalPaginas()) {
                        $pagAct =$this->getTotalPaginas();
                        $final=$this->getTotalPaginas();
                    }
                    
                } else if ($this->input->post('data_inip') != null) {
                    $pagAct = $this->input->post('data_inip') - 1;
                    $final = $this->input->post('data_inip') - 1;
                    if ($pagAct <= 0) {
                        $pagAct = 1;
                        $final = 1;
                    }
                } else if ($this->input->post('data_inin') != null) {
                    $pagAct = $this->input->post('data_inin');
                    $pagAct+=1;
                    $final = $this->input->post('data_inin');
                    $final+=1;
                    if ($pagAct > $this->getTotalPaginas()) {
                        $pagAct =$this->getTotalPaginas();
                        $final=$this->getTotalPaginas();
                    }  else {
                        
                    }
                } else {
                    $pagAct = 1;
                    $final = 1;
                }
            }
            $inicio = ROWS_PER_PAGE;
            $final = ($final * ROWS_PER_PAGE) - ROWS_PER_PAGE;
            if ($Pubs != null) {

                array_push($Publicaciones, $Pubs);
            } else {
                $Publicaciones = $this->Publicaciones->listarPubliWebDashboard($inicio, $final);
            }

            //$buttonsByUserRights = $this->analizarPermisosBotonesTablas("gestionUserBtn", $this->session->userdata('permisosUsuer'));

            $cadena .= $this->EncabezadoTabla();
            foreach ($Publicaciones as $pub) {
                $filas .= $this->cuerpoTabla($pub);
            }
            $cadena.=$filas;
            $cadena.='</tbody></table>';
            $cadena.=' <div class="row">
            <ul class="pager">
               <li><button data-datainic="1" id="aFirstPagPubWeb" >&lt;&lt;</button></li>
                <li><button id="aPrevPagPubWeb" >&lt;</button></li>
                <li><input data-datainic="' . $pagAct . '" type="text" value="' . $pagAct . '" id="txtPagingSearchUsrPubWeb" name="txtNumberPag" data-mask="000000000" size="5">/' . $this->getTotalPaginas() . '</li>
                 <li><button id="aNextPagPubWeb">&gt;</button></li>
                <li><button id="aLastPagPubWeb" data-datainic="' . $this->getTotalPaginas() . '" >&gt;&gt;</button></li>
                <li>[' . ($final + 1) . ' - ' . ($final + count($Publicaciones)) . ' / ' . count($this->Publicaciones->listarPublicaciones()) . ']</li></ul></div>';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if ($this->input->post('data_ini') || $this->input->post('data_inin') || $this->input->post('data_inip')) {
            echo ($cadena);
        } else {
            return $cadena;
        }
    }


}
