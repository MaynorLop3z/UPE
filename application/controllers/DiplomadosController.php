<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class DiplomadosController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Diplomados');
        $this->load->model('Modulos');
    }

    public function index() {
        $data['Diplomados'] =  $this->Diplomados->listarDiplomadosLimited(null, null);
        $data['CategoriasDi'] = $this->Diplomados->listarCategoriasDiplomados();
        $data['Turno'] = $this->Modulos->listarTurnos();
        $data['Modulos']= $this->Diplomados->listarModulosByDiplomado();
        $data['ToTalRegistrosDiplomados'] = count($this->Diplomados->listarDiplomados());
        $data['PagInicialDiplomados'] = 1;
        $data['totalPaginasDiplomados'] = $this->getTotalPaginas();
        $this->load->view('Diplomados', $data);
       // $this->load->view('Modulos/ModulosModal',$data);
    }
    
    private function getTotalPaginas() {
        return $result = intval(ceil(count($this->Diplomados->listarDiplomados()) / ROWS_PER_PAGE));
    }

    public function guardarDiplomado() {
        try {
            if ($this->input->post()) { //Estos son los nombres de los input del Form
                $nombreDiplomado = $this->input->post('DiplomadoNombre');
                $descripcionDiplomado = $this->input->post('DiplomadoDescripcion');
                $Estado = $this->input->post('Estado');
                $categoriaDi = $this->input->post('CatgoriaDiplomado');
                $comentarioDi = $this->input->post('ComentarioDiplomado');
                $ip = $this->session->userdata('ipUserLogin'); // La ip del usuario que modifica   $userModi
                $userModi = $this->session->userdata('codigoUserLogin'); //codigo del usuario qeumodifica  $ip,
                $this->load->model('Diplomados');
                $arrayData = $this->Diplomados->crearDiplomado($nombreDiplomado, $descripcionDiplomado, $Estado, $categoriaDi, $comentarioDi, $ip, $userModi);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    public function editarDiplomado() {
        try {
            if ($this->input->post('CodigoDiplomado')) {
                $codigoDi = $this->input->post('CodigoDiplomado');
                $NombreDiplomado = $this->input->post('DiplomadoNombre');
                $Descripcion = $this->input->post('DiplomadoDescripcion');
                $Estado = $this->input->post('Estado');
                $NombreCategoriaDiplomad = $this->input->post('CatgoriaDiplomado');
                $Comentarios = $this->input->post('ComentarioDiplomado');
                $ip = $this->session->userdata('ipUserLogin'); // La ip del usuario que modifica   $userModi
                $userModi = $this->session->userdata('codigoUserLogin'); //codigo del usuario qeumodifica  $ip,

                $this->load->model('Diplomados');
                $arrayData = $this->Diplomados->ModificarDiplomado($codigoDi, $NombreDiplomado, $Descripcion, $Estado, $NombreCategoriaDiplomad, $Comentarios, $ip, $userModi);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    public function eliminarDiplomado() {
        //$eliminar = false;
        try {
            if ($this->input->post()) {
                $codigoDiplomado = $this->input->post('CodigoDiplomado');
                if ($codigoDiplomado != null) {
//                 $ip = $this->session->userdata('ipUserLogin');
//                $userModifica = $this->session->userdata('codigoDiplomado');
                    $arrayData = $this->Diplomados->inactivarDiplomado($codigoDiplomado);
                    // $ip,$userModifica
                    echo json_encode($arrayData);
                }
//                $eliminar = $this->Diplomados->EliminarDiplomado($codigo);
//                echo $eliminar;
            }
        } catch (Exception $ex) {
            $data = array(
                'Error' => $ex->getMessage()
            );
            echo json_encode($data);
        }
    }
    
    

    public function ModViewDip() {
        try {
            if ($this->input->post()) {
                $codigoDiplomado = $this->input->post('DipViewMod');
                if ($codigoDiplomado != null) {
                    $arrayData = $this->Modulos->listarModulosByDiplomado($codigoDiplomado);
                    echo json_encode($arrayData);
                }
            }
        } catch (Exception $ex) {
            
        }
    }

    public function BuscarDiplomados() {
        try {
            if ($this->input->post()) {
                $nombreDip = $this->input->post('FindDiplomado');
                $Diplomados = json_decode(json_encode($this->Diplomados->listarDiplomadosNombre($nombreDip)), true);
                $registro = $this->EncabezadoTabla();
                foreach ($Diplomados as $dip) {
                    $registro .= '<tr id="' . $dip['CodigoDiplomado'] . '">';
                    $registro .= '<td class="nombre_Diplomado">' . $dip['NombreDiplomado'] . '</td>';
                    $registro .= '<td class="descripcionDiplomado">' . $dip['Descripcion'] . '</td>';
                    $registro .= '<td class="estado">' . $dip['Estado'] . '</td>';
                    $registro .= '<td class="categoriaDi">' . $dip['CodigoCategoriaDiplomado'] . '</td>';
                    $registro .= '<td class="comentarioDi">' . $dip['Comentarios'] . '</td>';
                    $registro .= '<td class=gestion_dip>';
                    $registro .= '<button id="btnmo' . $dip['CodigoDiplomado'] . '" onclick="editaDiplomado(this)" title="Editar Diplomado" class="btnmoddi btn btn-success"><span class="glyphicon glyphicon-pencil"></span></button>';
                    $registro .= '<button id="DELDiplomado' . $dip['CodigoDiplomado'] . '" onclick="eliminarDiplomado(this)" title="Eliminar Diplomado" class="btndeldip btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
                    $registro .= '<button id="Addmod'. $dip['CodigoDiplomado'] .'"onclick="AddModDip(this)"  title="Agregar Modulos" class="btnAddMod btn btn-info" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span></button>';
                    $registro .= '<button id="ModViewphp' . $dip['CodigoDiplomado'] . '"onclick="ViewModDip(this)"  title="Ver modulos" class="btnVIewMod btn btn-warning" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-eye-open" ></span></button>'; 
                    $registro .= '</td>';
                    $registro .= '</tr>';
                }
                $registro .= '</tbody></table></div>';
                echo $registro;
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    ///////PAGINACION DE DIPLOMADOS////////////////////
    public function paginDiplomados($Diplos = null) {
        try {
            $final = 0;
            $pagAct = 0;
            $cadena = '';
            $filas = '';
            $Diplomados = array();

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
            if ($Diplos != null) {

                array_push($Diplomados, $Diplos);
            } else {
                $Diplomados = $this->Diplomados->listarDiplomadosLimited($inicio, $final);
            }

//            $buttonsByUserRights = $this->analizarPermisosBotonesTablas("gestionUserBtn", $this->session->userdata('permisosUsuer'));

            $cadena .= $this->EncabezadoTabla();
            foreach ($Diplomados as $dip) {
                $filas.='<tr id="dip' . $dip->CodigoDiplomado . '">';
                $filas.='<td class="nombre_Diplomado" >' . $dip->NombreDiplomado . '</td>';
                $filas.='<td class="descripcionDiplomado" >' . $dip->Descripcion . '</td>';
                $filas.='<td class="estado" >' . $dip->Estado . '</td>';
                $filas.='<td class="categoriaDi" >' . $dip->NombreCategoriaDiplomado. '</td>';
                $filas.='<td class="comentarioDi" >' . $dip->Comentarios . '</td>';
                $filas.='<td class="gestion_dip" >
            <button id="btnmo'. $dip->CodigoDiplomado .'" onclick="editaDiplomado(this)" title="Editar Diplomado" class="btnmoddi btn btn-success" class="btn btn-info btn-lg"><span class=" glyphicon glyphicon-pencil"></span></button>
            <button id="DELDiplomado'. $dip->CodigoDiplomado .'" onclick="eliminarDiplomado(this)"  title="Eliminar Diplomado" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
            <button id="Addmod'. $dip->CodigoDiplomado .'" onclick="AddModDip('.$dip->CodigoDiplomado .')"  title="Agregar Modulos" class="btnAddMod btn btn-info" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span></button>
            <button id="ModView'. $dip->CodigoDiplomado .'" onclick="ViewModDip(this)"  title="Ver modulos" class="btnVIewMod btn btn-warning" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-eye-open" ></span></button>       
                    </td></tr>';
//                $filas.=' <td style="text-align:center"  class="gestion_User">' . $buttonsByUserRights . '</td> </tr>';
            }
            $cadena.=$filas;
            $cadena.='</tbody></table>';
            $cadena.=' <div class="row">
            <ul class="pager" id="footpagerDiplomados">
               <li><button data-datainic="1" id="aFirstPagDiplomados" >&lt;&lt;</button></li>
                <li><button id="aPrevPagDiplomados" >&lt;</button></li>
                <li><input data-datainic="' . $pagAct . '" type="text" value="' . $pagAct . '" id="txtPagingSearchDiplomados" name="txtNumberPag" size="5">/' . $this->getTotalPaginas() . '</li>
                 <li><button id="aNextPagDiplomados">&gt;</button></li>
                <li><button id="aLastPagDiplomados" data-datainic="' . $this->getTotalPaginas() . '" >&gt;&gt;</button></li>
                <li>[' . ($final + 1) . ' - ' . ($final + count($Diplomados)) . ' / ' . count($this->Diplomados->listarDiplomados()) . ']</li></ul></div>';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if ($this->input->post('data_ini') || $this->input->post('data_inin') || $this->input->post('data_inip')) {
            echo ($cadena);
        } else {
            return $cadena;
        }
    }
    
    ///ENCABEZADO DE LA TABLA (Se usa para busqueda y paginado)
    private function EncabezadoTabla(){
        $encabezado='<table id=' . '"tableDiplomados"' . 'class="table table-bordered table-striped table-hover table-responsive"' . '>
                <thead>
                <tr>
                    <th style="text-align:center">Diplomado</th> <!-- Nombre de diplomado, Ponerlo que vaya al centro -->
                    <th style="text-align:center">Descripcion</th><!-- Coordinador del  diplomado -->
                    <th style="text-align:center">Estado</th> <!-- Descripcion del modulo -->
                    <th style="text-align:center">Categoria</th>
                   <th style="text-align:center">Comentarios</th>  <!-- Comentarios  sobre los diplomados  --> 
                   <th style="text-align:center">Gestionar</th>
                </tr>
            </thead> 
            <tbody>';
        return $encabezado;
    }
}
