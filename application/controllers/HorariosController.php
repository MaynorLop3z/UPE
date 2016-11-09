<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class HorariosController extends CI_Controller {
    var $dias=array("Lunes","Martes","Miércoles","Jueves","Viernes","Sábado","Domingo");
    public function __construct() {
        parent::__construct();
        $this->load->model('Horarios');
        $this->load->model('Periodos');
        $this->load->model('Aulas');
    }

    public function index() {
        $data['Aulas'] = $this->Aulas->listarAulas();
        $data['Turnos'] = $this->Horarios->cargarTurnos();
        $data['Grupos'] = $this->Horarios->listarHorariosxTurno();
        $data['Dias'] = $this->dias;
        $data['GruposPëriodo'] = $this->Horarios->cargarGruposPeriodos();
        
        $data['HxGrupos'] = $this->Horarios->listarHorariosxTurno(null,$this->Horarios->cargar1GrupoPeriodo());
        $this->load->view('Horarios', $data);
    }

    public function buscarxTurno() {
        if($this->input->post()){
            $turno=$this->input->post('Turno');
            if($turno=="NULL"){$turno=null;}
            $Horarios = $this->Horarios->listarHorariosxTurno($turno);
            if(count($Horarios)>0){
                $cadena='';
                foreach($Horarios as $h){
                    $cadena.='<tr id="horario'.$h->IdHorario.'">
                              <td >'.$h->CodigoGrupoPeriodo.'</td>
                              <td >'.$h->HoraEntrada.'</td>
                              <td >'.$h->HoraSalida.'</td>
                              <td >'.$h->NombreAula.'</td>
                              <td >'.$this->dias[$h->Dia-1].'</td>
                              <td >'.$h->NombreTurno.'</td>
                              <!--<td >'.$h->FechaInicioPeriodo.' - '.$h->FechaFinPeriodo.'</td>-->
                              <td><button id="DELH'.$h->IdHorario.'" onclick="eliminarHorario('.$h->IdHorario.')"  title="Eliminar Horario" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
                              </td></tr>';
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
            $Horarios = $this->Horarios->verificarHorario($dia,$H1,$H2,$aula,$grupo,$jornada);
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
}
