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
        $this->load->view('GestionGrupos',$datos);
    }
    
    public function getDiplomados(){
        $codigoCat = $this->input->post('idCategoria');
//        $codigoGenerado = '';
        $diploma2 = $this->Diplomados->listarDiplomadosCategoria($codigoCat);
        foreach ($diploma2 as $diplo){
//            $codigoGenerado.='<option value="' . $diplo['CodigoDiplomado'] . '">' . $diplo['NombreDiplomado'] . '</option>';
//        }
//        return $codigoGenerado;
        ?>
	<option value="<?=$diplo->CodigoDiplomado ?>"><?=$diplo->NombreDiplomado ?></option>
	<?php
        }
    }
    
    public function getModulos(){
        if($this->input->post('idDiplomado')){
        $codigoDiplomado = $this->input->post('idDiplomado');
        $modulos = $this->Diplomados->listarModulos($codigoDiplomado);
        foreach ($modulos as $modul){
        ?>
	<option value="<?=$modul->CodigoModulo ?>"><?=$modul->NombreModulo ?></option>
	<?php
        }
        }
    }
    
    public function  insertPeriodo(){
        try {
        if($this->input->post('idModulo')){
        //$this->load->model('Periodos');
        $FechaInico = $this->input->post('FechaInicio');
        $FechaFin = $this->input->post('FechaFin');
        $Estado = $this->input->post('estadoPeriodo');
        $Modulo = $this->input->post('idModulo');
        $Comentarios = $this->input->post('ComentariosPeriodo');
        $data = $this->Diplomados->crearPeriodo($FechaInico,$FechaFin,$Estado,$Comentarios,$Modulo);
        echo json_decode($data);
        }
        }
        catch (Exception $ex) {
            echo json_encode($ex);
        }
    }
}
