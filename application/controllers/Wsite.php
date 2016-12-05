<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Wsite
 *
 * @author Grisshi
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
//controlador de la pagina principal, permite logear a los usuarios
include './application/models/dto/UsuariosDTO.php';

//include './application/controllers/Listar.php';
//
class Wsite extends CI_Controller {

    public $usuarioDTO;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
// $this->load->view('wsite');
        $this->load->model('publicaciones');
//        $this->load->model('archivos');

        $user = $this->input->post('user');

        if ($user) {
            $this->load->model('usuario_model');
            $this->load->model('Usuarios');
            $this->load->helper('url');
            if ($this->input->post()) {
                $nombre = $this->input->post('user');
                $Contrasenia = $this->input->post('password');
                $usuario = $this->usuario_model->login($nombre, $Contrasenia);

                if ($usuario != null) {

                    $permisos = $this->Usuarios->listPermisosByUser($usuario->CodigoUsuario);
                    $data['Permisos'] = $permisos;
                    $usuario_data = array(
                        'codigoUserLogin' => $usuario->CodigoUsuario,
                        'nombreUserLogin' => $usuario->NombreUsuario,
                        'correoUserLogin' => $usuario->CorreoUsuario,
                        'nombreRealUserLogin' => $usuario->Nombre,
                        'ipUserLogin' => $this->input->ip_address(),
                        'permisosUsuer' => $permisos,
                        'logueado' => TRUE,
                        'nivel' => ''); //el nivel es auxiliar para diferenciar del login del PortalParticipante
                    $this->session->set_userdata($usuario_data);
// redirect('Dashboard');
//                    $this->load->view('Dashboard', $data);
                    Redirect('Dashboard');
                } else {

                    $data['publicacionesMostrar'] = count($this->listarPublicaciones2());
                    $data['PagInicial'] = 1;
                    $data['PubporPag'] = PUBLICACIONES_X_PAG;
                    $data['TotalPaginacion'] = $this->publicaciones->ListarPublicacionesPaginacion(NULL);
                    $data['PagCategoria'] = $this->publicaciones->listarPublicacionesPaginacionCategoria(NULL, null, 4);
                    $data['listCategorias'] = $this->publicaciones->listarCategoriasDiplomados();

//            $data['publicacionesCargar'] = $this->mostrarPublicaciones();
//            $data['mostrarUnaPublicacion']=  $this->mostrarPublicacion($id);
                    $this->load->view('wsite', $data);
                }
            }
        } else {
            $data['publicacionesMostrar'] = count($this->listarPublicaciones2());
            $data['PagInicial'] = 1;
            $data['PubporPag'] = PUBLICACIONES_X_PAG;
            $data['TotalPaginacion'] = $this->publicaciones->ListarPublicacionesPaginacion(NULL);
            $data['PagCategoria'] = $this->publicaciones->listarPublicacionesPaginacionCategoria(NULL, NULL, 4);
            $data['listCategorias'] = $this->publicaciones->listarCategoriasDiplomados();

//            $data['publicacionesCargar'] = $this->mostrarPublicaciones();
//            $data['mostrarUnaPublicacion']=  $this->mostrarPublicacion($id);
            $this->load->view('wsite', $data);
        }
    }

    public function listarPublicaciones2() {
        try {
            $contadora = 0;
            $listaPublicacionesArchivos = array();
            $iterador = 0;
            $listaPublicaciones = array();
            $listaPublicaciones = $this->publicaciones->listarPublicaciones();
            foreach ($listaPublicaciones as $publicacion) {

                $archivos = $this->publicaciones->listarArchivosPublicacion($publicacion->CodigoPublicacion);
//$categoria = $this->categoriadiplomado->listarCategoriasDiplomados();
                foreach ($archivos as $archivo) {
                    $publicacionArchivo = array(
                        'CodigoPublicacion' => $publicacion->CodigoPublicacion,
                        'Titulo' => $publicacion->Titulo,
                        'Ruta' => $archivo->Ruta,
                        'Contenido' => $publicacion->Contenido,
                        'FechaPublicacion' => $publicacion->FechaPublicacion,
                        'Categoria' => $publicacion->CodigoCategoriaDiplomado);
                }
                array_push($listaPublicacionesArchivos, $publicacionArchivo);
                $iterador ++;
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }

        return $listaPublicacionesArchivos;
    }

    public function listarPublicacionesCAT($idcat) {
        try {
            $contadora = 0;
            $listaPublicacionesArchivos = array();
            $iterador = 0;
            $listaPublicaciones = array();
            $listaPublicaciones = $this->publicaciones->ListarPublicacionesCategoria($idcat);
            foreach ($listaPublicaciones as $publicacion) {

                $archivos = $this->publicaciones->listarArchivosPublicacion($publicacion->CodigoPublicacion);
//$categoria = $this->categoriadiplomado->listarCategoriasDiplomados();
                foreach ($archivos as $archivo) {
                    $publicacionArchivo = array(
                        'CodigoPublicacion' => $publicacion->CodigoPublicacion,
                        'Titulo' => $publicacion->Titulo,
                        'Ruta' => $archivo->Ruta,
                        'Contenido' => $publicacion->Contenido,
                        'Categoria' => $publicacion->CodigoCategoriaDiplomado);
                }
                array_push($listaPublicacionesArchivos, $publicacionArchivo);
                $iterador ++;
            }
        } catch (Exception $ex) {
            echo $ex->getTraceAsString();
        }

        return $listaPublicacionesArchivos;
    }

    public function listarCategoriaPubli($idPublicacion) {
        try {
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function mostrarPublicaciones() {
        try {
            $listaPublicacionesArchivos2 = array();
            $iterador = 0;
            $listaPublicaciones = array();
            $listaPublicaciones = $this->publicaciones->listarPublicaciones();
            foreach ($listaPublicaciones as $publicacion) {
                $archivos2 = $this->publicaciones->listarArchivosPublicacion($publicacion->CodigoPublicacion);
                foreach ($archivos2 as $archivo) {
                    $publicacionArchivo = array(
                        'CodigoPublicacion' => $publicacion->CodigoPublicacion,
                        'Titulo' => $publicacion->Titulo,
                        'Ruta' => $archivo->Ruta,
                        'Contenido' => $publicacion->Contenido,
                        'FechaPublicacion' => $publicacion->FechaPublicacion,
                        'Categoria' => $publicacion->CodigoCategoriaDiplomado);
                }
                array_push($listaPublicacionesArchivos2, $publicacionArchivo);
                $iterador ++;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        return $listaPublicacionesArchivos2;
    }

// funcion para listar una publicacion segun su id
//    public function mostrarPublicacion($id) {
//        $iterador = 0;
//        $camposPublicacion = array();
//        $listaPublicaciones = $this->publicaciones->MostrarDatosPublicacion($id);
//        try {
//             $camposPublicacion = array(
//                        'CodigoPublicacion' => $publicacion->CodigoPublicacion,
//                        'Titulo' => $publicacion->Titulo,
//                        'Ruta' => $archivo->Ruta,
//                        'Contenido' => $publicacion->Contenido,
//                        'FechaPublicacion' => $publicacion->FechaPublicacion);
//                
//                array_push($camposPublicacion,$camposPublicacion);
//            
//        } catch (Exception $exc) {
//            echo $exc->getTraceAsString();
//        }
//    }
    public function listarPublicacionesPaginacion() {
        try {
            if ($this->input - post()) {
                $final = $this->input->post('data_ini');
                $inicio = PUBLICACIONES_X_PAG;
                if ($final != null) {
                    $final = ($final * PUBLICACIONES_X_PAG) - PUBLICACIONES_X_PAG;
                }
                $Response = array();
                $Publicaciones = $this->publicaciones->ListarPublicacionesPaginacion($inicio, $final);
                foreach ($Publicaciones as $publicacion) {
                    array_push($Response, $publicacion);
                }
                $responseDef = json_encode($Response);
            }
            echo ($responseDef);
        } catch (Exception $exc) {
            $data = array('Error' => $ex->getMessage());
            echo json_encode($data);
        }
    }

    private function getTotalPaginas() {
        return $result = intval(ceil(count($this->Publicaciones->listarPublicaciones()) / PUBLICACIONES_X_PAG));
    }

    public function listarFecha() {
        $this->load->model('publicaciones');
        try {

            $result = '';
            if ($this->input->post()) {
                $final = $this->input->post('data_ini');
                $start = $this->input->post('Start');
                $end=$this->input->post('End');
                $inicio = PUBLICACIONES_X_PAG;
                if ($final != null) {
                    $final = ($final * PUBLICACIONES_X_PAG) - PUBLICACIONES_X_PAG;
                }
                $Response = array();
                $Publicaciones = $this->publicaciones-> listarPublicacionesFecha($inicio, $final, $start, $end);
                if ($Publicaciones != NULL) {
                    foreach ($Publicaciones as $publicacion) {
                        $result .='<div class="col-sm-4 portfolio-item" >

                                         <a  id="a' . $publicacion->CodigoPublicacion . '" data-dimg=\'' .  json_encode($publicacion). '\' class=" portfolio-link callModalPublicacion"  >
                                           
<div class="caption">
                                                <div class="caption-content" >
                                                    <i class="fa fa-search-plus fa-3x"></i>
                                                </div>
                                            </div>
                                            <img  src="' . 'bootstrap' . $publicacion->Ruta . '" class="img-responsive" alt="" style="height:500px; width: 500px;">
                                        </a> </div>  ';
                    }

                    $result .=
                            '<div class="row" id="paginacionDivcat">'
                            . '<ul class="pager">'
                            . '<li><a  id="btnpaginicio">&laquo;</a></li>';
                    $contador = 1;

                    $totalpag2 = $this->listarPublicacionesCAT($categoriaSlt);
                    $totalpag = count($totalpag2);
                    if ((($totalpag % PUBLICACIONES_X_PAG) != 0) && (($totalpag / PUBLICACIONES_X_PAG) >= 1)) {
                        $totalpag = intval(($totalpag / PUBLICACIONES_X_PAG) + 1);
                    } else {
                        $totalpag = intval(ceil(($totalpag / PUBLICACIONES_X_PAG)));
                    }
                    while ($contador <= $totalpag) {
//                        $result .= '<li><a id="' . $contador . '"' . $contador . '</a></li>';
                        $contador ++;
                    }
//                    $result .='<li><a id="btnpagfin">&raquo;</a></li> '
//                            . '</ul>'
//                            . ' </div>';
//
//                    //
                    /////
                } else {
                    $result = '<h3 align="center">No existen Publicaciones en ese Rango de Fecha</h3>';
                }
            }
            echo $result;
        } catch (Exception $exc) {
            $data = array('Error' => $ex->getMessage());
        }
    }
    
    
    //listar Fechas
    
     public function listar() {
        $this->load->model('publicaciones');
        try {

            $result = '';
            if ($this->input->post()) {
                $final = $this->input->post('data_ini');
                $categoriaSlt = $this->input->post('Categoria');
                $inicio = PUBLICACIONES_X_PAG;
                if ($final != null) {
                    $final = ($final * PUBLICACIONES_X_PAG) - PUBLICACIONES_X_PAG;
                }
                $Response = array();
                $Publicaciones = $this->publicaciones->ListarPublicacionesPaginacionCategoria($inicio, $final, $categoriaSlt);
                if ($Publicaciones != NULL) {
                    foreach ($Publicaciones as $publicacion) {
                        $result .='<div class="col-sm-4 portfolio-item" >

                                         <a  id="a' . $publicacion->CodigoPublicacion . '" data-dimg=\'' .  json_encode($publicacion). '\' class=" portfolio-link callModalPublicacion"  >
                                           
<div class="caption">
                                                <div class="caption-content" >
                                                    <i class="fa fa-search-plus fa-3x"></i>
                                                </div>
                                            </div>
                                            <img  src="' . 'bootstrap' . $publicacion->Ruta . '" class="img-responsive" alt="" style="height:500px; width: 500px;">
                                        </a> </div>  ';
                    }

//                    $result .=
//                            '<div class="row" id="paginacionDivcat">'
//                            . '<ul class="pager">'
//                            . '<li><a  id="btnpaginicio">&laquo;</a></li>';
                    $contador = 1;

                    $totalpag2 = $this->listarPublicacionesCAT($categoriaSlt);
                    $totalpag = count($totalpag2);
                    if ((($totalpag % PUBLICACIONES_X_PAG) != 0) && (($totalpag / PUBLICACIONES_X_PAG) >= 1)) {
                        $totalpag = intval(($totalpag / PUBLICACIONES_X_PAG) + 1);
                    } else {
                        $totalpag = intval(ceil(($totalpag / PUBLICACIONES_X_PAG)));
                    }
                    while ($contador <= $totalpag) {
//                        $result .= '<li><a id="' . $contador . '"' . $contador . '</a></li>';
                        $contador ++;
                    }
//                    $result .='<li><a id="btnpagfin">&raquo;</a></li> '
//                            . '</ul>'
//                            . ' </div>';
//
//                    //
//                    /////
                } else {
                    $result = '<h3 align="center">No existen Publicaciones en esta categoria</h3>';
                }
            }
            echo $result;
        } catch (Exception $exc) {
            $data = array('Error' => $ex->getMessage());
        }
    }
    
    public function ListarName() {
           $this->load->model('publicaciones');
        try {

            $result = '';
            if ($this->input->post()) {
                $final = $this->input->post('data_ini');
                $nameP = $this->input->post('nameP');
                $nameP2= '';
                $inicio = PUBLICACIONES_X_PAG;
                if ($final != null) {
                    $final = ($final * PUBLICACIONES_X_PAG) - PUBLICACIONES_X_PAG;
                }
                $Response = array();
                $Publicaciones = $this->publicaciones->listarPublicacionesNames($nameP);
                if ($Publicaciones != NULL) {
                    foreach ($Publicaciones as $publicacion) {
                        $result .='<div class="col-sm-4 portfolio-item" >

                                         <a  id="a' . $publicacion->CodigoPublicacion . '" data-dimg=\'' .  json_encode($publicacion). '\' class=" portfolio-link callModalPublicacion"  >
                                           
<div class="caption">
                                                <div class="caption-content" >
                                                    <i class="fa fa-search-plus fa-3x"></i>
                                                </div>
                                            </div>
                                            <img  src="' . 'bootstrap' . $publicacion->Ruta . '" class="img-responsive" alt="" style="height:500px; width: 500px;">
                                        </a> </div>  ';
                    }

//                    $result .=
//                            '<div class="row" id="paginacionDivcat">'
//                            . '<ul class="pager">'
//                            . '<li><a  id="btnpaginicio">&laquo;</a></li>';
                    $contador = 1;

//                    $totalpag2 = $this->listarPublicacionesCAT($categoriaSlt);
                    $totalpag = 3;
//                            count($totalpag2);
                    if ((($totalpag % PUBLICACIONES_X_PAG) != 0) && (($totalpag / PUBLICACIONES_X_PAG) >= 1)) {
                        $totalpag = intval(($totalpag / PUBLICACIONES_X_PAG) + 1);
                    } else {
                        $totalpag = intval(ceil(($totalpag / PUBLICACIONES_X_PAG)));
                    }
                    while ($contador <= $totalpag) {
//                        $result .= '<li><a id="' . $contador . '"' . $contador . '</a></li>';
                        $contador ++;
                    }
//                    $result .='<li><a id="btnpagfin">&raquo;</a></li> '
//                            . '</ul>'
//                            . ' </div>';
//
//                    //
//                    /////
                } else {
                    $result = '<h3 align="center">No existen Publicaciones con este nombre</h3>';
                }
            }
            echo $result;
        } catch (Exception $exc) {
            $data = array('Error' => $ex->getMessage());
        }
    }
    }


