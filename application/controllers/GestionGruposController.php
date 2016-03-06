<?php
/**
 * Description of GestionGrupos
 *
 * @author maynorlop3z
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class GestionGruposController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Diplomados');
//        $this->load->model('usuarios');
    }

    public function index() {
        $datos['Categorias'] = $this->Diplomados->listarCategoriasDiplomados();
        $cats = (array) $datos['Categorias'][0];
        $idCategoria = $cats['CodigoCategoriaDiplomado'];
        $datos['Diplomados'] = $this->Diplomados->listarDiplomadosCategoria($idCategoria);
        $dips = (array) $datos['Diplomados'][0];
        $idDiplomado = $dips['CodigoDiplomado'];
        $datos['Modulos'] = $this->Diplomados->listarModulos($idDiplomado);
        $mods = (array) $datos['Modulos'][0];
        $idModulo = $mods['CodigoModulo'];
        $datos['Periodos'] = $this->Diplomados->listarPeriodosByModulo($idModulo);
        $this->load->view('GestionGrupos', $datos);
    }

    public function getDiplomados() {
        $codigoCat = $this->input->post('idCategoria');
        //$diploma2 = $this->Diplomados->listarDiplomadosCategoria($codigoCat);
        $data = array(
            "diplomados" =>$this->Diplomados->listarDiplomadosCategoria($codigoCat)
        );
        if (count($data["diplomados"]) > 0) {
            $temp = (array)$data["diplomados"][0];
            //$data["test"] = $temp["CodigoDiplomado"];
            $data["modulos"] = $this->Diplomados->listarModulos($temp["CodigoDiplomado"]);
            if (count($data["modulos"]) > 0) {
                $temp = (array)$data["modulos"][0];
                $data["periodos"] = $this->Diplomados->listarPeriodosByModulo($temp["CodigoModulo"]);
            }
        }
        
        echo json_encode($data);
    }

    public function getModulos() {
        if ($this->input->post('idDiplomado')) {
            $codigoDiplomado = $this->input->post('idDiplomado');
            $modulos = $this->Diplomados->listarModulos($codigoDiplomado);
            foreach ($modulos as $modul) {
                ?>
                <option value="<?= $modul->CodigoModulo ?>"><?= $modul->NombreModulo ?></option>
                <?php
            }
        }
    }

    public function insertPeriodo() {
        try {
            if ($this->input->post('idModulo')) {
                //$this->load->model('Periodos');
                $FechaInico = $this->input->post('FechaInicio');
                $FechaFin = $this->input->post('FechaFin');
                $Estado = $this->input->post('estadoPeriodo');
                $Modulo = $this->input->post('idModulo');
                $Comentarios = $this->input->post('ComentariosPeriodo');
                $data = $this->Diplomados->crearPeriodo($FechaInico, $FechaFin, $Estado, $Comentarios, $Modulo);
                echo json_decode($data);
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
        }
    }

}
