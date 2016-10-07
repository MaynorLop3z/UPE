<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class HorariosController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Horarios');
        $this->load->model('Periodos');
    }

    public function index() {
        $data['nada']='';
        $data['Turnos'] = $this->Horarios->cargarTurnos();
        $data['Grupos'] = $this->Horarios->listarHorarios();
        $this->load->view('Horarios', $data);
    }

    public function buscarxTurno() {
        if($this->input->post()){
            $turno=$this->input->post('Turno');
            $Grupos = $this->Horarios->listarHorariosGruposxTurno($turno);
            if(count($Grupos)>0){
                $cadena='';
                foreach($Grupos as $grupo){
                    $cadena.='<tr id="grHor">'
                            . '<td class="Mail_Alumno">'.$grupo->CodigoGrupoPeriodo.'</td>'
                            . '<td class="Mail_Alumno">'.$grupo->NombreModulo.'</td>
                                </td>
                              <td class="Mail_Alumno">'.$grupo->HoraEntrada.'</td>
                              </td>
                              <td class="Mail_Alumno">'.$grupo->HoraSalida.'</td>
                              </td><td class="Mail_Alumno">'.$grupo->Aula.'</td>
                              </td><td class="Mail_Alumno">'.$grupo->FechaInicioPeriodo.' - '.$grupo->FechaFinPeriodo.'</td>
                              </td><td><button id="btnmo" onclick="" title="Editar Horario" class="btnmoddi btn btn-success" class="btn btn-info btn-lg"><span class=" glyphicon glyphicon-pencil"></span></button>
                                <button id="DELD" onclick=""  title="Eliminar Horario" class="btndeldip btn btn-danger" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-trash"></span></button>
                                </td>';
                }
                echo $cadena;
            }else{
                return null;
            }
        }
    }
}
