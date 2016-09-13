<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ComentariosController extends CI_Controller {
    private $final = 0;
    private $pagAct = 0;
    private $inicio = 0;
    private $publicacion='';
    private $usuario;
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
                $this->registrarComentario($pub, date('Y-m-d'), $correo, $comentario, $nombre, TRUE, $ip, $codigo,2,date('H:i:s'));
            }else{
                $this->registrarComentario($pub, date('Y-m-d'), $correo, $comentario, $nombre, TRUE, $ip, $codigo,1,date('H:i:s'));
            }
        }
    }
    
    public function registrarComentario($idpub, $fecha, $cor, $com, $nom, $estado, $ip, $usr, $nivel, $time){
            //Inserta comentario a la base
        try{
            $this->Comentarios->CrearComentarios($idpub, $fecha, $cor, $com, $nom, $estado, $ip, $usr, $nivel, $time);
            echo 'Comente';
        }catch(Exception $e){
            echo $e;
        }
    }
    
    public function obtenerComentarios() {
        $data['PComentarios']=array();
        $data['CComentarios']=array();
        $data['MComentarios']=array();
        if($this->input->post()){
            $publicacion=$this->input->post('publicacion');
            try {
                $this->usuario=$this->session->userdata("nivel");
                $result=$this->Comentarios->listarComentariosLimited($publicacion, null, null,$this->usuario);
                $totalActual=count($result);
                $totalComentarios = count($this->Comentarios->listarComentarios($publicacion,$this->usuario));
                $totalPaginas = $this->getTotalPaginas($publicacion);
                $this->AvRevPaginas();
                $data['PComentarios']=$result;
                $contadores=array("totalcom"=>$totalComentarios, "totalpag"=>$totalPaginas, "totact"=>$totalActual, "top"=>COMMENTS_PER_PUB);
                if($this->usuario!=='Participante'){
                    array_push($data['MComentarios'], array("actions"=>'<span class="btn btn-info admincom dropdown-toggle" style="float:right;" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span></span></span>',
                        "f1"=>'<ul style="top:20px;right:0;" class="dropdown-menu">',
                        "f2"=>'<li class="aprobCom"><a onclick="MaestroAdminCom(1)">Aprobar comentario</a></li>',
                        "f3"=>'<li class="elimCom"><a  onclick="MaestroAdminCom(2)">Eliminar comentario</a></li>',
                        "f4"=>'<li class="bloqUsu"><a onclick="MaestroAdminCom(3)">Bloquear comentarios para este alumno</a></li>',
                        "f5"=>'</ul>'));
                }
                array_push($data['CComentarios'],$contadores, $data['MComentarios']);
                echo json_encode($data);
            } catch (Exception $ex) {
                echo "error al listar los comentarios";
            }
        }
    }
    
    private function getTotalPaginas($publicacion) {
        return $result = intval(ceil(count($this->Comentarios->listarComentarios($publicacion, $this->usuario)) / COMMENTS_PER_PUB));
    }
    
    public function eliminarComentario(){
        if($this->input->post()){
            $idComentario=$this->input->post('id');
            try{
                $this->Comentarios->EliminarComentario($idComentario);
                echo "Eliminado";
            }  catch (Exception $e){
                return null;
            }
        }
    }
    
    public function aprobarComentario(){
        if($this->input->post()){
            $idComentario=$this->input->post('id');
            try{
                $this->Comentarios->AprobarComentario($idComentario);
                echo "Aprobado";
            }  catch (Exception $e){
                return null;
            }
        }
    }
    
    public function paginComentarios($Coms= null) {
        try {
            $this->usuario=$this->session->userdata("nivel");
            $data['PComentarios']=array();
            $data['CComentarios']=array();
            $data['MComentarios']=array();
            $Comentarios= array();

            $this->AvRevPaginas();
            if ($Coms != null) {

                array_push($Comentarios, $Coms);
            } else {
                $Comentarios= $this->Comentarios->listarComentariosLimited($this->publicacion, $this->inicio, $this->final, $this->usuario);
            }

//            $buttonsByUserRights = $this->analizarPermisosBotonesTablas("gestionUserBtn", $this->session->userdata('permisosUsuer'));

//            $cadena .= $this->EncabezadoTabla();
            $data['PComentarios']=$Comentarios;
                $contadores=array("totalcom"=>count($this->Comentarios->listarComentarios($this->publicacion, $this->usuario)), "totalpag"=>$this->getTotalPaginas($this->publicacion), 
                    "totact"=>count($Comentarios), "top"=>COMMENTS_PER_PUB);
                if($this->session->userdata("nivel")!=='Participante'){
                    array_push($data['MComentarios'], array("actions"=>'<span class="btn btn-info admincom dropdown-toggle" style="float:right;" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span></span></span>',
                        "f1"=>'<ul style="top:20px;right:0;" class="dropdown-menu">',
                        "f2"=>'<li class="aprobCom"><a onclick="MaestroAdminCom(1)">Aprobar comentario</a></li>',
                        "f3"=>'<li class="elimCom"><a  onclick="MaestroAdminCom(2)">Eliminar comentario</a></li>',
                        "f4"=>'<li class="bloqUsu"><a onclick="MaestroAdminCom(3)">Bloquear comentarios para este alumno</a></li>',
                        "f5"=>'</ul>'));
                    
                }
                array_push($data['CComentarios'],$contadores, $data['MComentarios']);
               
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        if ($this->input->post('data_ini') || $this->input->post('data_inin') || $this->input->post('data_inip')) {
            echo json_encode($data);
        } else {
            return $data;
        }
    }
    
    private function AvRevPaginas(){
         if ($this->input->post()) {
             $this->publicacion=$this->input->post('pub');
                if ($this->input->post('data_inin') != null) {
                    $this->pagAct = $this->input->post('data_inin');
                    $this->pagAct+=1;
                    $this->final = $this->input->post('data_inin');
                    $this->final+=1;
                    if ($this->pagAct > $this->getTotalPaginas($this->publicacion)) {
                        $this->pagAct =$this->getTotalPaginas($this->publicacion);
                        $this->final=$this->getTotalPaginas($this->publicacion);
                    }  else {
                        
                    }
                } else {
                    $this->pagAct = 1;
                    $this->final = 1;
                }
            }
            $this->inicio = COMMENTS_PER_PUB;
            $this->final = ($this->final * COMMENTS_PER_PUB) - COMMENTS_PER_PUB;
    }
}