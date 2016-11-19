<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class HorariosController extends CI_Controller {
    private $final = 0;
    private $pagAct = 0;
    private $inicio = 0;
    private $turno = null;
    private $dias=array("Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
    public function __construct() {
        parent::__construct();
        $this->load->model('Horarios');
        $this->load->model('Periodos');
        $this->load->model('Aulas');
    }

    public function index() {
        $data['Aulas'] = $this->Aulas->listarAulas();
        $data['Turnos'] = $this->Horarios->cargarTurnos();
        $data['Grupos'] = $this->Horarios->listarHorariosxTurno(null,null,ROWS_PER_PAGE);
        $data['total']=count($this->Horarios->listarHorariosxTurno());
        $data['Dias'] = $this->dias;
        $data['GruposPëriodo'] = $this->Horarios->cargarGruposPeriodos();
        $data['totalPaginasHorarios'] = $this->getTotalPaginas();
        $data['HxGrupos'] = $this->Horarios->listarHorariosxTurno(null,$this->Horarios->cargar1GrupoPeriodo());
        $this->load->view('Horarios', $data);
    }

    private function getTotalPaginas($turno=null) {
        return $result = intval(ceil(count($this->Horarios->listarHorariosxTurno($turno)) / ROWS_PER_PAGE));
    }
    public function buscarxTurno() {
        if($this->input->post()){
            $turno=$this->input->post('Turno');
            if($turno=="NULL"){$turno=null;}
            $this->turno=$turno;
            $Horarios = $this->Horarios->listarHorariosxTurno($turno,null,ROWS_PER_PAGE);
            if(count($Horarios)>0){
                $cadena='';
                foreach($Horarios as $h){
                    $cadena.=$this->cuerpoTabla($h);
                }
                if(count($this->Horarios->listarHorariosxTurno($turno))>ROWS_PER_PAGE){
                    $this->inicio=1;
                    $this->pagAct =1;
                    $cadena.=$this->PieTabla($Horarios, $turno);
                }
                echo $cadena;
            }else{
                return null;
            }
        }
    }
    
    public function comprobarHorario() {
        if($this->input->post()){
            $aula=$this->input->post('Aula'); 
            $jornada=$this->input->post('Turno');
            $grupo=$this->input->post('Grupo');
            $dia=$this->input->post('Dia');
            $H1=$this->input->post('H1');
            $H2=$this->input->post('H2');
            $FI=$this->input->post('FI');
            $FF=$this->input->post('FF');
            $Horarios = $this->Horarios->verificarHorario($dia,$H1,$H2,$aula,$grupo,$jornada, $FI, $FF);
            if(count($Horarios)>0){
                $cadena=  json_encode($Horarios);
                echo $cadena;
            }else{
                echo "";
            }
        }
    }
    
    public function agregarHorario() {
        if($this->input->post()){
            $hEntrada=$this->input->post('Entrada');
            $hSalida=$this->input->post('Salida'); 
            $aula=$this->input->post('Aula'); 
            $jornada=$this->input->post('Turno');
            $grupo=$this->input->post('Grupo');
            $dia=$this->input->post('Dia');
            $h = $this->Horarios->agregarHorario($hEntrada,$hSalida,$aula,$jornada,$grupo,$dia);
            $del='eliminarHorario';
            $grupoA=$this->input->post('GA');//si proviene de adminGrupos
            if($grupoA=="GA"){$del='eliminarHorarioGrupo';}
            if(count($h)>0){
                $cadena='';
                $cadena.='<tr id="horario'.$h['IdHorario'].'"><td >'.$this->dias[$h['Dia']-1].'</td>
                          <td >'.$this->input->post('naula').'</td>
                          <td >'.$h['HoraEntrada'].'</td>
                          <td >'.$h['HoraSalida'].'</td>
                          <td>
                          <button id="DELH'.$h['IdHorario'].'" onclick="'.$del.'('.$h['IdHorario'].')"  title="Eliminar Horario" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
                          </td></tr>';
//                    $cadena.='<tr id="HorarioFila">
//                              <td id="grHorario" >'.$Horarios['CodigoGrupoPeriodo'].'</td>
//                              <td >'.$Horarios['HoraEntrada'].'</td>
//                              <td >'.$Horarios['HoraSalida'].'</td>
//                              <td >'.$Horarios['NombreAula'].'</td>
//                              <td >'.$this->dias[$Horarios['Dia']-1].'</td>
//                              <td >'.$Horarios['NombreTurno'].'</td>
//                              <!--<td >'.$Horarios['FechaInicioPeriodo'].' - '.$Horarios['FechaFinPeriodo'].'</td>-->
//                              <td><button id="btnmo" onclick="" title="Editar Horario" class="btnmoddi btn btn-success" class="btn btn-info btn-lg"><span class=" glyphicon glyphicon-pencil"></span></button>
//                                <button id="DELD" onclick=""  title="Eliminar Horario" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
//                              </td></tr>';
                echo $cadena;
            }else{
                echo "";
            }
        }
    }
    
    public function eliminarHorario() {
        if($this->input->post()){
            $id=$this->input->post('Id');
            if($id>0){
                $res = $this->Horarios->eliminarHorario($id);
                if($res){
                    echo "Eliminado";
                }
            }else{
                return null;
            }
        }
    }
    
    public function cargarxGrupo() {
        if($this->input->post()){
            $turno=$this->input->post('Turno');
            $grupo=$this->input->post('Grupo');
            $grupoA=$this->input->post('GA');//si proviene de adminGrupos
            $del='eliminarHorario';
            if($turno=="NULL"){$turno=null;}
            if($grupoA=="GA"){$del='eliminarHorarioGrupo';}
            $Horarios = $this->Horarios->listarHorariosxTurno($turno,$grupo);
            if(count($Horarios)>0){
                $cadena='';
                foreach($Horarios as $h){
                    $cadena.='<tr id="horario'.$h->IdHorario.'"><td >'.$this->dias[$h->Dia-1].'</td>
                          <td >'.$h->NombreAula.'</td>
                          <td >'.$h->HoraEntrada.'</td>
                          <td >'.$h->HoraSalida.'</td>
                          <td><button id="DELH'.$h->IdHorario.'" onclick="'.$del.'('.$h->IdHorario.')"  title="Eliminar Horario" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
                          </td></tr>';
                }
                echo $cadena;
            }else{
                return null;
            }
        }
    }
    
    public function cargarAulas(){
        if($this->input->post()){
            $cadena='';
            $aulas = $this->Aulas->listarAulas();
            if($this->input->post('Aulas')){
                foreach ($aulas as $aula) {
                    $cadena.='<option value="'.$aula->IdAula.'">
                    '.$aula->NombreAula.'</option>';
                }
            }
            echo $cadena;
        }
    }
    

    
    private function cuerpoTabla($h){
        $filas='<tr id="horario'.$h->IdHorario.'">
                              <td >'.$h->CodigoGrupoPeriodo.'</td>
                              <td >'.$h->HoraEntrada.'</td>
                              <td >'.$h->HoraSalida.'</td>
                              <td >'.$h->NombreAula.'</td>
                              <td >'.$this->dias[$h->Dia-1].'</td>
                              <td >'.$h->NombreTurno.'</td>
                              <!--<td >'.$h->FechaInicioPeriodo.' - '.$h->FechaFinPeriodo.'</td>-->
                              <td><button id="DELH'.$h->IdHorario.'" onclick="eliminarHorario('.$h->IdHorario.')"  title="Eliminar Horario" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
                              </td></tr>';
        return $filas;
    }
    
    private function PieTabla($Horarios, $turno){
        $pie='<tr><td colspan="7">
                <ul class="pager" id="footpagerHorarios">
                <li><button data-datainic="1" id="aFirstPagHorarios" >&lt;&lt;</button></li>
                <li><button id="aPrevPagHorarios" >&lt;</button></li>
                <li><input data-datainic="' . $this->pagAct . '" type="text" value="' . $this->pagAct . '" data-mask="000000000" class="onlyNumbers" id="txtPagingSearchHorarios" name="txtNumberPag" size="5">/' . intval(ceil(count($this->Horarios->listarHorariosxTurno($turno)) / ROWS_PER_PAGE)) . '</li>
                <li><button id="aNextPagHorarios" >&gt;</button></li>
                <li><button id="aLastPagHorarios" data-datainic="'.$this->getTotalPaginas($turno).'" >&gt;&gt;</button></li>
                <li>[' . ($this->final + 1) . ' - ' . ($this->final + count($Horarios)) . ' / ' . count( $this->Horarios->listarHorariosxTurno($turno)) . ']</li>
                </ul></td>
                </tr>';
        return $pie;
    }
    /*********PAGINACION DE HORARIOS EN DASHBOARD***/
    public function paginHorarios($Hors= null) {
        try {
            $turno=$this->input->post('Turno');
            
            if($turno=="NULL"){$turno=null;}
            $this->turno==$turno;
            $cadena = '';
            $filas = '';
            $Horarios = array();

            $this->AvRevPaginas($turno);
            if ($Horarios != null) {

                array_push($Horarios, $Hors);
            } else {
                $ini=$this->inicio;
                $fin=$this->final;
                if($ini==0){
                    $ini=ROWS_PER_PAGE;
                }
                if($fin<1){
                    $fin=null;
                }
                $Horarios = $this->Horarios->listarHorariosxTurno($turno,null,$ini,$fin);
            }

//            $buttonsByUserRights = $this->analizarPermisosBotonesTablas("gestionUserBtn", $this->session->userdata('permisosUsuer'));

            foreach ($Horarios as $h) {
               $filas .= $this->cuerpoTabla($h);
            }
            $cadena.=$filas;
            $cadena.= $this->PieTabla($Horarios,$turno);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if ($this->input->post('data_ini') || $this->input->post('data_inin') || $this->input->post('data_inip')) {
            echo ($cadena);
        } else {
            return $cadena;
        }
    }
    
    private function AvRevPaginas($turno=null){
         if ($this->input->post()) {
                if ($this->input->post('data_ini') != null) {
                    $this->pagAct = $this->input->post('data_ini');
                    $this->final = $this->input->post('data_ini');
                    
                    if ($this->pagAct <= 0) {
                        $this->pagAct = 1;
                        $this->final = 1;
                    }else if($this->pagAct > $this->getTotalPaginas($turno)) {
                        $this->pagAct =$this->getTotalPaginas($turno);
                        $this->final=$this->getTotalPaginas($turno);
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
                    if ($this->pagAct > $this->getTotalPaginas($turno)) {
                        $this->pagAct =$this->getTotalPaginas($turno);
                        $this->final=$this->getTotalPaginas($turno);
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
