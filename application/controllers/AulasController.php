<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class AulasController extends CI_Controller {

    private $final = 0;
    private $pagAct = 0;
    private $inicio = 0;
    public function __construct() {
        parent::__construct();
        $this->load->model('Aulas');
    }

    public function index() {
        $data['nada']='';
        $data['Aulas'] = $this->Aulas->listarAulas(ROWS_PER_PAGE);
        $data['totalAulas'] = count($this->Aulas->listarAulas());
        $data['totalPaginasAulas'] = $this->getTotalPaginas();
        $this->load->view('Aulas', $data);
    }
    
    private function getTotalPaginas() {
        return $result = intval(ceil(count($this->Aulas->listarAulas()) / ROWS_PER_PAGE));
    }
     
    private function getRowAula($respuesta){
        return '<tr id="Aula-'.$respuesta['IdAula'].'"><td >'.$respuesta['NombreAula'].'</td>'
                        . '<td >'.$respuesta['Descripcion'].'</td>'
                        . '<td class="Mail_Alumno">'.$respuesta['TipoAula'].'</td></td>
                            <td><button id="btnEditAula" onclick="editarAula(\''.$respuesta['NombreAula'].'\',\''.$respuesta['IdAula'].'\''.$respuesta['Descripcion'].'\',\''.$respuesta['IdAula'].'\')" title="Editar Aula" class="btnmoddi btn btn-success" class="btn btn-info btn-lg"><span class=" glyphicon glyphicon-pencil"></span></button>
                            <button id="btnDeleteAula" onclick="eliminarAula(\''.$respuesta['NombreAula'].'\',\''.$respuesta['IdAula'].'\')"  title="Eliminar Aula" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
                            </td></tr>';
    }

    public function agregarAula(){
        if($this->input->post()){
            $nombre=$this->input->post('Nombre');
            $descripcion=$this->input->post('Descripcion');
            $tipo=$this->input->post('Tipo');
            $respuesta=$this->Aulas->agregarAula($nombre, $descripcion, $tipo);
            if($respuesta){
                $cadena= $this->getRowAula($respuesta);
                echo $cadena;
            }
            return false;
        }
    }
    
    public function modificarAula(){
        if($this->input->post()){
            $nombre=$this->input->post('Nombre');
            $descripcion=$this->input->post('Descripcion');
            $tipo=$this->input->post('Tipo');
            $id=$this->input->post('Id');
            $respuesta=$this->Aulas->modificarAula($nombre, $descripcion, $tipo, $id);
            if($respuesta){
                $cadena= $this->getRowAula($respuesta);
                echo $cadena;
            }
            return false;
        }
    }
    
    public function eliminarAula(){
        if($this->input->post()){
            $id=$this->input->post('Id');
            $respuesta=$this->Aulas->eliminarAula($id);
            if($respuesta){
                echo 'Borrado';
            }
        }
    }
    
    public function buscarAulas(){
        try {
            if($this->input->post()){
                $nombre=$this->input->post('Nombre');
                $tipo=$this->input->post('Tipo');
                
                $Aulas = $this->Aulas->buscarAulas($nombre, $tipo);   
                $registro = $this->EncabezadoTabla();
                if(count($Aulas)>0){
                    foreach ($Aulas as $aula){
                          $registro .= $this->cuerpoTabla($aula);
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
    
    /*********PAGINACION DE AULAS EN DASHBOARD***/
    public function paginAulas($Auls= null) {
        try {
            
            $cadena = '';
            $filas = '';
            $Aulas = array();

            $this->AvRevPaginas();
            if ($Auls != null) {

                array_push($Aulas, $Auls);
            } else {
                $ini=$this->inicio;
                $fin=$this->final;
                if($ini==0){
                    $ini=ROWS_PER_PAGE;
                }
                if($fin<1){
                    $fin=null;
                }
                $Aulas = $this->Aulas->listarAulas($ini, $fin);
            }

//            $buttonsByUserRights = $this->analizarPermisosBotonesTablas("gestionUserBtn", $this->session->userdata('permisosUsuer'));

            $cadena .= $this->EncabezadoTabla();
            foreach ($Aulas as $aula) {
               $filas .= $this->cuerpoTabla($aula);
            }
            $cadena.=$filas;
            $cadena.= $this->PieTabla($Aulas);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if ($this->input->post('data_ini') || $this->input->post('data_inin') || $this->input->post('data_inip')) {
            echo ($cadena);
        } else {
            return $cadena;
        }
    }
    
    private function EncabezadoTabla(){
        $encabezado='<table border="1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Aula</th>
                        <th>Descripción</th>
                        <th>Tipo</th>
                        <th>Gestión</th>
                    </tr>
                </thead> 
                <tbody id="bodytablaAulas">';
        return $encabezado;
    }
    
    private function cuerpoTabla($aula){
        $filas='<tr id="Aula-'.$aula->IdAula.'">
                    <td >'.$aula->NombreAula.'</td>
                    <td >'.$aula->Descripcion.'</td>
                    <td class="Mail_Alumno">'.$aula->TipoAula.'</td>
                    </td>
                    <td><button id="btnEditAula'.$aula->IdAula.'" onclick="editarAula(\''.$aula->NombreAula.'\',\''.$aula->IdAula.'\',\''.$aula->Descripcion.'\',\''.$aula->TipoAula.'\')" title="Editar Aula" class="btnmoddi btn btn-success" class="btn btn-info btn-lg"><span class=" glyphicon glyphicon-pencil"></span></button>
                        <button id="btnDeleteAula'.$aula->IdAula.'" onclick="eliminarAula(\''.$aula->NombreAula.'\',\''.$aula->IdAula.'\')"  title="Eliminar Aula" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
                    </td>
                </tr>';
        return $filas;
    }
    
    private function PieTabla($aulas){
        $pie='</tbody></table> <div class="row">
            <ul class="pager" id="footpagerAulas">
               <li><button data-datainic="1" id="aFirstPagAulas" >&lt;&lt;</button></li>
                <li><button id="aPrevPagAulas" >&lt;</button></li>
                <li><input data-datainic="' . $this->pagAct . '" type="text" value="' . $this->pagAct . '" data-mask="000000000" class="onlyNumbers" id="txtPagingSearchAulas" name="txtNumberPag" size="5">/' . $this->getTotalPaginas() . '</li>
                 <li><button id="aNextPagAulas">&gt;</button></li>
                <li><button id="aLastPagAulas" data-datainic="' . $this->getTotalPaginas() . '" >&gt;&gt;</button></li>
                <li>[' . ($this->final + 1) . ' - ' . ($this->final + count($aulas)) . ' / ' . count($this->Aulas->listarAulas()) . ']</li></ul></div>';
    
        return $pie;
    }
    
    private function AvRevPaginas(){
         if ($this->input->post()) {
                if ($this->input->post('data_ini') != null) {
                    $this->pagAct = $this->input->post('data_ini');
                    $this->final = $this->input->post('data_ini');
                    
                    if ($this->pagAct <= 0) {
                        $this->pagAct = 1;
                        $this->final = 1;
                    }else if($this->pagAct > $this->getTotalPaginas()) {
                        $this->pagAct =$this->getTotalPaginas();
                        $this->final=$this->getTotalPaginas();
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
                    if ($this->pagAct > $this->getTotalPaginas()) {
                        $this->pagAct =$this->getTotalPaginas();
                        $this->final=$this->getTotalPaginas();
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
