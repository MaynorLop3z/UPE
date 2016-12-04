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
        
        if($nivel=='Participante'){ //Si es alumno se carga sus archivos
            $data['gruposAlumno'] = $this->Calificaciones->ListarGruposAlumno($login);
        }
        $permisos = $this->session->userdata('permisosUsuer');
//        $this->analizarPermisos('views/Archivos/ArchivosTab.php', 'views/Archivos/ArchivosTabTmp.php', $permisos, $nivel);
//        $this->analizarPermisos('views/Archivos/ArchivosModal.php', 'views/Archivos/ArchivosModalTmp.php', $permisos, $nivel);
        $this->load->view('Calificaciones',$data);
    }
}
