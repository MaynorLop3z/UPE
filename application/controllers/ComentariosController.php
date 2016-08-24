<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ComentariosController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
//        $this->load->database();
        $this->load->model('Comentarios');
    }

    public function index() {
        try {
           
        } catch (Exception $exc) {
          
        }
    }
    
    public function comentar() {
        $codigo=$this->session->userdata("codigoUserLogin");
        $correo=$this->session->userdata("correoUserLogin");
        $nombre=$this->session->userdata("nombreRealUserLogin");
        $nivel=$this->session->userdata("nivel");
        $sesion=$this->session->userdata("logueado");
        $ip=$this->session->userdata("ipUserLogin");
        
        if($this->input->post() & $sesion){
            $comentario=$this->input->post('Comentario');
            $pub=$this->input->post('IdC');
            if($nivel=="Participante"){
                participanteComenta($pub, date('Y-m-d'), $correo, $comentario, $nombre, TRUE, $ip, $codigo, 2, date('H:i:s'));
            }else{
                $this->maestroComenta($pub, date('Y-m-d'), $correo, $comentario, $nombre, TRUE, $ip, $codigo,1,date('H:i:s'));
            }
        }
    }
    
    public function participanteComenta($idpub, $fecha, $cor, $com, $nom, $estado, $ip, $usr, $nivel){
            //Comentario del participante
            
    }
    
    public function maestroComenta($idpub, $fecha, $cor, $com, $nom, $estado, $ip, $usr, $nivel, $time){
            //Inserta comentario del profe
        try{
            $this->Comentarios->CrearComentarios($idpub, $fecha, $cor, $com, $nom, $estado, $ip, $usr, $nivel, $time);
            echo 'Comente';
        }catch(Exception $e){
            echo $e;
        }
    }
    
    public function obtenerComentarios() {
        $data['PComentarios']=array();
        if($this->input->post()){
            $publicacion=$this->input->post('publicacion');
            try {
                $result=$this->Comentarios->listarComentarios($publicacion);
                $data['PComentarios']=$result;
                echo json_encode($result);
            } catch (Exception $ex) {
                echo "error al listar los comentarios";
            }
        }
    }
    
}