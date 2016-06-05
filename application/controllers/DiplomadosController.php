<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class DiplomadosController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Diplomados');
        $this->load->model('Modulos');
    }

    public function index() {
        $data['Diplomados'] = $this->Diplomados->listarDiplomados();
        $data['CategoriasDi'] = $this->Diplomados->listarCategoriasDiplomados();
        $data['Turno'] = $this->Modulos->listarTurnos();
       // $data['Modulos']=  $this->Modulos->listarModulosByDiplomado();
        $this->load->view('Diplomados', $data);
       // $this->load->view('Modulos/ModulosModal',$data);
    }

    public function guardarDiplomado() {
        try {
            if ($this->input->post()) { //Estos son los nombres de los input del Form
                $nombreDiplomado = $this->input->post('DiplomadoNombre');
                $descripcionDiplomado = $this->input->post('DiplomadoDescripcion');
                $Estado = $this->input->post('Estado');
                $categoriaDi = $this->input->post('CatgoriaDiplomado');
                $comentarioDi = $this->input->post('ComentarioDiplomado');
                $ip = $this->session->userdata('ipUserLogin'); // La ip del usuario que modifica   $userModi
                $userModi = $this->session->userdata('codigoUserLogin'); //codigo del usuario qeumodifica  $ip,
                $this->load->model('Diplomados');
                $arrayData = $this->Diplomados->crearDiplomado($nombreDiplomado, $descripcionDiplomado, $Estado, $categoriaDi, $comentarioDi, $ip, $userModi);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    public function editarDiplomado() {
        try {
            if ($this->input->post('CodigoDiplomado')) {
                $codigoDi = $this->input->post('CodigoDiplomado');
                $NombreDiplomado = $this->input->post('DiplomadoNombre');
                $Descripcion = $this->input->post('DiplomadoDescripcion');
                $Estado = $this->input->post('Estado');
                $NombreCategoriaDiplomad = $this->input->post('CatgoriaDiplomado');
                $Comentarios = $this->input->post('ComentarioDiplomado');
                $ip = $this->session->userdata('ipUserLogin'); // La ip del usuario que modifica   $userModi
                $userModi = $this->session->userdata('codigoUserLogin'); //codigo del usuario qeumodifica  $ip,

                $this->load->model('Diplomados');
                $arrayData = $this->Diplomados->ModificarDiplomado($codigoDi, $NombreDiplomado, $Descripcion, $Estado, $NombreCategoriaDiplomad, $Comentarios, $ip, $userModi);
                echo json_encode($arrayData);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

    public function eliminarDiplomado() {
        //$eliminar = false;
        try {
            if ($this->input->post()) {
                $codigoDiplomado = $this->input->post('CodigoDiplomado');
                if ($codigoDiplomado != null) {
//                 $ip = $this->session->userdata('ipUserLogin');
//                $userModifica = $this->session->userdata('codigoDiplomado');
                    $arrayData = $this->Diplomados->inactivarDiplomado($codigoDiplomado);
                    // $ip,$userModifica
                    echo json_encode($arrayData);
                }
//                $eliminar = $this->Diplomados->EliminarDiplomado($codigo);
//                echo $eliminar;
            }
        } catch (Exception $ex) {
            $data = array(
                'Error' => $ex->getMessage()
            );
            echo json_encode($data);
        }
    }
    
    

    public function ModViewDip() {
        try {
            if ($this->input->post()) {
                $codigoDiplomado = $this->input->post('DipViewMod');
                if ($codigoDiplomado != null) {
                    $arrayData = $this->Modulos->listarModulosByDiplomado($codigoDiplomado);
                    echo json_encode($arrayData);
                }
            }
        } catch (Exception $ex) {
            
        }
    }

    public function BuscarDiplomados() {
        try {
            if ($this->input->post()) {
                $nombreDip = $this->input->post('FindDiplomado');
                $Diplomados = json_decode(json_encode($this->Diplomados->listarDiplomadosNombre($nombreDip)), true);
                $registro = "";
                foreach ($Diplomados as $dip) {
                    $registro .= '\t<tr id="' . $dip['CodigoDiplomado'] . '">\n';
                    $registro .= '<td class="nombre_Diplomado">' . $dip['NombreDiplomado'] . '</td>\n';
                    $registro .= '<td class="descripcionDiplomado">' . $dip['Descripcion'] . '</td>\n';
                    $registro .= '<td class="estado">' . $dip['Estado'] . '</td>\n';
                    $registro .= '<td class="categoriaDi">' . $dip['CodigoCategoriaDiplomado'] . '</td>\n';
                    $registro .= '<td class="comentarioDi">' . $dip['Comentarios'] . '</td>\n';
                    $registro.= '<td class=gestion_dip>';
                    $registro .= '<button id="btnmo' . $dip['CodigoDiplomado'] . '" onclick="editaDiplomado(this)" title="Editar Diplomado" class="btnmoddi btn btn-success"><span class="glyphicon glyphicon-pencil"></span></button>';
                    $registro .= '<button id="DELDiplomado' . $dip['CodigoDiplomado'] . '" onclick="eliminarDiplomado(this)" title="Eliminar Diplomado" class="btndeldip btn btn-danger"><span class="glyphicon glyphicon-trash"></span></button>';
                    $registro .= '</td>\n';
                    $registro .= '</tr>\n';
                }
                echo $registro;
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

}
