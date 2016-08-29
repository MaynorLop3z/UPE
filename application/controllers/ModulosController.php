<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class ModulosController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Modulos');
       // $this->load->model('Diplomados'); 
        //$this->load->model('Turnos');
        
    }
    public function index() {
        $data['Modulos'] = $this->Modulos->listarModulosLimited(null,null);
        $data['Diplomados'] = $this->Modulos->listarDiplomados(); //ESto lo acabo de escribir
        $data['Turno'] = $this->Modulos->listarTurnos(); // Seleccionar el Modulo
        $data['ToTalRegistrosModulos'] = count($this->Modulos->listarModulos());
        $data['PagInicialModulos'] = 1;
        $data['totalPaginasModulos'] = $this->getTotalPaginas();
        $this->load->view('Modulos',$data);

    }
    private function getTotalPaginas() {
        return $result = intval(ceil(count($this->Modulos->listarModulos()) / ROWS_PER_PAGE));
    }

    public function guardarModulo()
    {
        try {
        if($this->input->post()){
            if ($this->input->post('ModuloNombre')) {$NombreModulo = $this->input->post('ModuloNombre');
           }else {               $NombreModulo = 'TEST';}
            $OrdenModulo= $this->input->post('ModuloOrden');
            $Estado = $this->input->post('Estado');
            $CodigoTurno = $this->input->post('Turno');
            $CodigoDiplomado = $this->input->post('CodDiplomado');//--->
            $Comentarios  = $this->input->post('ComentarioMod');
            $ip = $this->session->userdata('ipUserLogin');// La ip del usuario que modifica   $userModi
            $userModi = $this->session->userdata('codigoUserLogin'); //codigo del usuario qeumodifica  $ip,


//       $pathView = APPPATH . 'views/VistaAyudaView.php';                    //ESto
//                $html = file_get_html($pathView);                          //lo puse 
//                $elemsWithRights = $html->getElementById('gestion_Mod');//30 marzo 216



          $arrayData = $this->Modulos->crearModulo($NombreModulo, $OrdenModulo, $CodigoTurno, $Estado,$CodigoDiplomado, $Comentarios,$ip,$userModi);
          echo json_encode($arrayData);

        }   

        } catch (Exception $ex) {
             echo json_encode($ex);
        }

    }
    public function  editarModulo(){
        try {
           if($this->input->post('CodigoModulo')){
               $codigoMo = $this->input->post('CodigoModulo');
               if ($this->input->post('ModuloNombre')) {$NombreModulo = $this->input->post('ModuloNombre');
               }else {               $NombreModulo = 'TEST';}

                    $OrdenModulo = $this->input->post('ModuloOrden');
                    $Estado = $this->input->post('Estado');
                    $CodigoTurno = $this->input->post('Turno');
                    $CodigoDiplomado = $this->input->post('CodDiplomado');
                    $Comentarios = $this->input->post('ComentarioMod');
                    $ip = $this->session->userdata('ipUserLogin'); // La ip del usuario que modifica   $userModi
                    $userModi = $this->session->userdata('codigoUserLogin'); //codigo del usuario qeumodifica  $ip,

                   // $this->load->model('Modulos');

                    $arrayData = $this->Modulos->ModificarModulo($codigoMo, $NombreModulo,$OrdenModulo,$Estado,$CodigoTurno,$CodigoDiplomado,$Comentarios,$ip,$userModi);
               echo json_encode($arrayData);



           } 
        } catch (Exception $ex) {
            echo json_encode($ex);
        }   
    }
    public function  EliminarModulo(){
        try {
            if($this->input->post()){
                $codigoModulo = $this->input->post('CodigoModulo');
                if($codigoModulo !=null){
                    $ip = $this->session->userdata('ipUserLogin');
                    $userModifica = $this->session->userdata('codigoModulo');
                    $arrayData = $this->Modulos->inactivarModulo($codigoModulo,$ip,$userModifica);
                    echo json_encode($arrayData);




                    }


            }

        } catch (Exception $exc) {
            $data = array(

                'Error'=> $ex->getMessage()
            );
        echo json_encode($data);
    }}
    //    $eliminado = false;
    //
    //    try{
    //        if($this->input->post()){
    //         $codigo = $this->input->post('CodigoModulo');
    //         $eliminado = $this->Modulos->EliminarModulos($codigo);
    //         echo $eliminado;

    public function BuscarModulos(){
        try {
        if($this->input->post()){
            $nombreMo = $this->input->post('FindModulo');
            $Modulos = json_decode(json_encode($this->Modulos->listarModulosNombre($nombreMo)),true);     
            $registro = $this->EncabezadoTabla();
            foreach ($Modulos as $mod){
                $registro .= '<tr id="mod' . $mod['CodigoModulo'] . '">';
                $registro .= '<td class="NombreMod">' . $mod['NombreModulo'] . '</td>';
                $registro .= '<td class="ordenMo">' . $mod['OrdenModulo'] . '</td>';
                $registro .= '<td class="Estado">' . $mod['Estado'] . '</td>';
                $registro .= '<td class="TurnoM">' . $mod['CodigoTurno'] .'</td>';
                $registro .= '<td class="DipName">' . $mod['CodigoDiplomado'] .'</td>';
                $registro .= '<td class="ComenMo">' . $mod['Comentarios'] .'</td>';
                $registro.= '<td class=gestion_Mod>';
                $registro .= '<button id="btnModiM' .$mod['CodigoModulo'] . '" onclick="editModulo(this)" title="Editar Modulo" class="btn_modificar_Mod btn btn-success"><span class="glyphicon glyphicon-pencil"></span></button>';
                $registro .= '<button id="btnDELM' .$mod['CodigoModulo'] . '" onclick="delMo(this)" title="Eliminar Modulo" class="btn_eliminar_Mod btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
                $registro .= '</td>';
                $registro .= '</tr>';

            }
            $registro .='</tbody></table>';
            echo $registro;

        }    
        } catch (Exception $ex) {
           echo json_encode($ex);
        }

    }
    
    /*********PAGINACION DE MODULOS EN DASHBOARD***/
    public function paginModulos($Mods= null) {
        try {
            $final = 0;
            $pagAct = 0;
            $cadena = '';
            $filas = '';
            $Modulos = array();

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
            if ($Mods != null) {

                array_push($Modulos, $Mods);
            } else {
                $Modulos = $this->Modulos->listarModulosLimited($inicio, $final);
            }

//            $buttonsByUserRights = $this->analizarPermisosBotonesTablas("gestionUserBtn", $this->session->userdata('permisosUsuer'));

            $cadena .= $this->EncabezadoTabla();
            foreach ($Modulos as $mod) {
                $filas.='<tr id="mod' . $mod->CodigoModulo . '">';
                $filas.='<td class="NombreMod">'. $mod->NombreModulo .'</td>';
                $filas.='<td class="ordenMo">'. $mod->OrdenModulo .'</td>';
                $filas.='<td class="Estado">'.  $mod->Estado .'</td> ';
                $filas.='<td class="TurnoM">'. $mod->CodigoTurno .'</td>';
                $filas.='<td class="DipName">'. $mod->CodigoDiplomado .'</td>';
                $filas.='<td class="ComenMo">'. $mod->Comentarios .'</td>';
                $filas.='<td class="gestion_Mod">
                             <button id="btnModiM'. $mod->CodigoModulo .'" onclick="editModulo(this)" title="Editar Modulo" class="btn_modificar_Mod btn btn-success" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-pencil"></span> </button>
            <button id="btnDELM'. $mod->CodigoModulo .'" onclick="delMo(this)" title="Eliminar Modulo" class="btn_eliminar_Mod btn btn-danger"><span class="glyphicon glyphicon-trash" class="btn btn-info btn-lg"></span></button>
                        </td></tr>';
//                $filas.=' <td style="text-align:center"  class="gestion_User">' . $buttonsByUserRights . '</td> </tr>';
            }
            $cadena.=$filas;
            $cadena.='</tbody></table>';
            $cadena.=' <div class="row">
            <ul class="pager" id="footpagerModulos">
               <li><button data-datainic="1" id="aFirstPagModulos" >&lt;&lt;</button></li>
                <li><button id="aPrevPagModulos" >&lt;</button></li>
                <li><input data-datainic="' . $pagAct . '" type="text" value="' . $pagAct . '" id="txtPagingSearchModulos" name="txtNumberPag" size="5">/' . $this->getTotalPaginas() . '</li>
                 <li><button id="aNextPagModulos">&gt;</button></li>
                <li><button id="aLastPagModulos" data-datainic="' . $this->getTotalPaginas() . '" >&gt;&gt;</button></li>
                <li>[' . ($final + 1) . ' - ' . ($final + count($Modulos)) . ' / ' . count($this->Modulos->listarModulos()) . ']</li></ul></div>';
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if ($this->input->post('data_ini') || $this->input->post('data_inin') || $this->input->post('data_inip')) {
            echo ($cadena);
        } else {
            return $cadena;
        }
    }
    
     ///ENCABEZADO DE LA TABLA MODULOS(para busqueda y paginado)
    private function EncabezadoTabla(){
        $encabezado='<table id="tableModulos" class="table table-bordered table-striped table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>Modulo</th>
                            <th>Correlativo</th>
                            <th>Estado</th>
                            <th>Turno</th>
                            <th>Diplomado</th>
                            <th>Comentario</th>
                            <th>Gestion</th>
                        </tr>
                    </thead> 
                    <tbody>';
        return $encabezado;
    }
           
}