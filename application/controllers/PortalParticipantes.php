<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class PortalParticipantes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Participantes');
        $this->load->helper('url');
    }
    
    public function index() {

        $user = $this->input->post('participante');
        $data = null;
        if ($user) {
                        
            if ($this->input->post()) {
                $nombre = $this->input->post('participante');
                $password = $this->input->post('password');
                $resultado = $this->Participantes->loginParticipante($nombre, $password);
                if (!$resultado == false & !$resultado == '') {

                    $permisos = $this->Participantes->permisosParticipantes();
                    $data['Permisos'] = $permisos;
                    $usuario_data = array(
                        'codigoUserLogin' => $resultado->CodigoParticipante,
                        'nombreUserLogin' => $nombre,
                        'correoUserLogin' => $resultado->CorreoElectronico,
                        'nombreRealUserLogin' => $resultado->Nombre,
                        // 'temaUserLogin' => $usuario->codigoTemaVista,
                        'permisosUsuer' => $permisos,
                        'logueado' => TRUE);
                    
                    $this->session->set_userdata($usuario_data);
                   echo '1';
                } else {

                    echo '0';
                }
            }
        } else {

            $this->load->view('PortalParticipantes', $data);

        }
    }
    
    
    
}
?>