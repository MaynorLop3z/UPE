<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ParticipantesController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Participantes');
    }

    public function index() {

//        if ($this->input->post('Aceptar')) {
//            $data['creacion'] = agregar();
//            if ($data['creacion']) {
//                $data['Mensaje'] = 'Alumno Agregado Exitosamente';
//            } else {
//                $data['Mensaje'] = 'Error al Agregar al alumno';
//            }
//        } else {
//            $data['creacion'] = false;
//        }
        $data['Alumnos'] = $this->Participantes->listarParticipantes();
        //$this->load->model('CategoriasParticipante');
        $data['CategoriasP'] = $this->Participantes->listarCategoriasParticipante();
        $this->load->view('Participantes', $data);
    }

    public function agregar() {
        try {
            if ($this->input->post()) {
                $nombre = $this->input->post('AlumnoNombre');
                $mail = $this->input->post('AlumnoMail');
                $tfijo = $this->input->post('AlumnoFijo');
                $tcel = $this->input->post('AlumnoMovil');
                $direccion = $this->input->post('AlumnoDir');
                $DUI = $this->input->post('AlumnoDUI');
                $nacimiento = $this->input->post('AlumnoFNac');
                $carrera = $this->input->post('AlumnoCarrera');
                $nivelAcad = $this->input->post('AlumnoNivel');
                $encargado = $this->input->post('AlumnoNEncargado');
                $categoria = $this->input->post('AlumnoCategoria');
                $descripcion = $this->input->post('AlumnoDescripcion');
                $comentarios = $this->input->post('AlumnoComentario'); 
                $universidad = 0;
                $arrayData = $this->Participantes->CrearParticipante($nombre, $mail, $tfijo, $tcel, $direccion, $nacimiento, $categoria, $DUI, $universidad, $carrera, $nivelAcad, $encargado, $descripcion, $comentarios);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) { echo json_encode($ex); }
    }

    
    public function modificar() {
        try {
            if ($this->input->post()) {
                $codigo = $this->input->post('AlumnoCodigo');
                $nombre = $this->input->post('AlumnoNombre');
                $mail = $this->input->post('AlumnoMail');
                $tfijo = $this->input->post('AlumnoFijo'); $tcel = $this->input->post('AlumnoMovil');
                $direccion = $this->input->post('AlumnoDir'); $DUI = $this->input->post('AlumnoDUI');
                $nacimiento = $this->input->post('AlumnoFNac'); $carrera = $this->input->post('AlumnoCarrera');
                $nivelAcad = $this->input->post('AlumnoNivel');
                $encargado = $this->input->post('AlumnoNEncargado');
                $categoria = $this->input->post('AlumnoCategoria');
                $descripcion = $this->input->post('AlumnoDescripcion');
                $comentarios = $this->input->post('AlumnoComentario');
                $universidad = 0; $umodifica = 0; $ipModifica = '192.168.1.1'; $fechaModifica = date('d/m/Y');
                $arrayData = $this->Participantes->ModificarParticipante($codigo, $nombre, $mail, $tfijo, $tcel, $direccion, $nacimiento, $categoria, $umodifica, $ipModifica, $fechaModifica, $universidad, $DUI, $carrera, $nivelAcad, $encargado, $descripcion, $comentarios);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }
     public function eliminar() {
         $eliminado = false;
         try {
             if ($this->input->post()) {
                 $codigo = $this->input->post('AlumnoCodigo');
                 $eliminado = $this->Participantes->EliminarParticipante($codigo);
                 echo $eliminado;
             }
         } catch (Exception $ex) {
            echo json_encode($ex);
         }
     }
     
     public function buscar(){
         try {
             if ($this->input->post()) {
                 $nombre = $this->input->post('NombreBuscado');
                 $result = $this->Participantes->listarParticipantesByName($nombre);
                 //echo $result;
                 $registros = "";
                 foreach($req as $result){
                 $registros .= '\t<tr id="'.$req['CodigoParticipante'].'">\n';
                 $registros .= '\t\t<td class="Mail_Alumno">'.$req['CorreoElectronico'].'</td>\n';
                 $registros .= '<td class="TelefonoFijo_Alumno" style="display: none">'.$req['TelefonoFijo'].'</td>\n';
                 $registros .= '<td class="TelefonoMovil_Alumno" style="display: none">'.$req['TelefonoCelular'].'</td>\n';
                 $registros .= '<td class="Direccion_Alumno" style="display: none">'.$req['Direccion'].'</td>\n';
                 $registros .= '<td class="DUI_Alumno" style="display: none">'.$req['NumeroDUI'].'</td>\n';
                 $registros .= '<td class="Nombre_Alumno">'.$req['Nombre'].'</td>\n';
                 $registros .= '<td class="FechaNac_Alumno" style="display: none">'.$req['FechaNacimiento'].'</td>\n';
                 $registros .= '<td class="CodU_Alumno" style="display: none">'.$req['CodigoUniversidadProcedencia'].'</td>\n';
                 $registros .= '<td class="Carrera_Alumno" style="display: none">'.$req['Carrera'].'</td>\n';
                 $registros .= '<td class="NivelAcad_Alumno" style="display: none">'.$req['NivelAcademico'].'</td>\n';
                 $registros .= '<td class="NombreEncargado_Alumno" style="display: none">'.$req['NombreEncargado'].'</td>\n';
                 $registros .= '<td class="CodCat_Alumno">'.$req['CodigoCategoriaParticipantes'].'</td>\n';
                 $registros .= '<td class="Descripcion_Alumno">'.$req[''].'</td>\n';
                 $registros .= '<td class="Comentarios_Alumno" style="display: none">'.$req['Descripcion'].'</td>\n';
                 $registros .= '<td class="gestion_Alumno">\n';
                 $registros .= '<button id="alumE'.$req['CodigoParticipante'].'"  title="Editar Alumno" class="btn_modificar_alum btn btn-success"><span class="glyphicon glyphicon-pencil"></span> </button>\n';
                 $registros .= '<button id="alumDEL'.$req['CodigoParticipante'].'" title="Eliminar Alumno" class="btn_eliminar_alum btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>\n';
                 $registros .= '</td>\n';
                 $registros .= '</tr>\n';
                 }
                 echo $registros;
             }
         } catch (Exception $ex) {
            echo json_encode($ex);
         }
     }
}
