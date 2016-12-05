<?php
if (!defined('BASEPATH')){
    exit('No direct script access allowed');
}
include(APPPATH . 'libraries/simple_html_dom.php');

class CalificacionesController extends CI_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Calificaciones');
        $this->load->helper(array('download', 'file', 'url', 'html', 'form'));
    }
    
    public function index() {
        $login=$this->session->userdata("codigoUserLogin");
        $nivel=$this->session->userdata("nivel"); //nivel comprueba si el login viene del portal de alumnos -> Participante
        $permisos = $this->session->userdata('permisosUsuer');
        
        if($nivel=='Participante'){ //Si es alumno se carga sus sus grupos con sus notas
            $data['gruposAlumno'] = $this->Calificaciones->ListarGruposAlumno($login);
            $this->analizarPermisos('views/Calificaciones/CalificacionesTab.php', 'views/Calificaciones/CalificacionesTabTmp.php', $permisos, $nivel);
        }
        else if($nivel==''){//Si es maestro carga los grupos para seleccionar
            $data['gruposMaestro'] = $this->Calificaciones->ListarGruposMaestro($login);
            $data['alumnosMaestro'] = $this->Calificaciones->ListarAlumnosMaestro($login);
            $this->analizarPermisos('views/Calificaciones/CalificacionesTab.php', 'views/Calificaciones/CalificacionesTabTmp.php', $permisos, $nivel);
        }

        $this->load->view('Calificaciones',$data);
    }
    
    function analizarPermisos($pathView, $pathViewTmp, $permisos, $nivel) {
        $pathView = APPPATH . $pathView;
        $pathViewTmp = APPPATH . $pathViewTmp;
        
        $html = file_get_html($pathView, $use_include_path = false, $context = null, $offset = -1, $maxLen = -1, $lowercase = true, $forceTagsClosed = true, $target_charset = DEFAULT_TARGET_CHARSET, $stripRN = false, $defaultBRText = DEFAULT_BR_TEXT);
        $elemsWithRights = $html->find(DEFINE_RIGHT_ALLOWED);
//        if($part!=null){
//            $elemsWithRights = $html->find("HistoricoCalificacionesAlumno");
//        }
//        
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
               
                    $elem->outertext = '';
                
            }
        }
        $html->save($pathViewTmp);
    }

    public function guardarCalificacion() {
        if($this->input->post()){
            $calificacion=$this->input->post('Calif');
            $parti=$this->input->post('Parti');
            $this->Calificaciones->guardarCalificacion($parti,$calificacion);
            echo 'Guardada';
        }
    }
}